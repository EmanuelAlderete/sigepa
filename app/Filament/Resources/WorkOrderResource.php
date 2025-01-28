<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkOrderResource\Pages;
use App\Filament\Resources\WorkOrderResource\RelationManagers;
use App\Models\WorkOrder;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

class WorkOrderResource extends Resource
{
    protected static ?string $model = WorkOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $pluralModelLabel = 'Ordens de Serviço';
    protected static ?string $modelLabel = 'Ordem de Serviço';
    protected static ?string $slug = 'ordens-servico';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('location')
                            ->label('Localização')
                            ->hint('Informe o nome da seção.')
                            ->placeholder('Formação Sanitária')
                            ->required()
                            ->datalist([
                                'Lanternagem',
                                'Alojamento Cb/Sd - Cia Mnt',
                                'Alojamento Cb/Sd - Cia Sup',
                                'Alojamento Cb/Sd - Cia Cmdo Ap',
                                'Rancho',
                                'Formação Sanitária'
                            ])
                            ->autocomplete(false)
                            ->minLength(2)
                            ->maxLength(255)
                            ->filled()
                    ]),

                Section::make()
                    ->schema([
                        Select::make('category')
                            ->label('Categoria')
                            ->hint('Escolha uma categoria de acordo com seu problema.')
                            ->required()
                            ->options([
                                'Construção' => 'Construção',
                                'Elétrica' => 'Elétrica',
                                'Hidráulica' => 'Hidráulica',
                                'Limpeza' => 'Limpeza',
                                'Manutenção Corretiva' => 'Manutenção Corretiva',
                                'Manutenção Preventiva' => 'Manutenção Preventiva',
                                'Pintura' => 'Pintura',
                                'Segurança' => 'Segurança',
                            ])
                    ]),
                Section::make()
                    ->schema([
                        RichEditor::make('description')
                            ->hint('Descreva o problema de maneira clara e objetiva, incluindo todos os detalhes que considerar importantes.')
                            ->label('Descrição')
                            ->required()
                    ]),
            ]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                if (auth()->user()->hasRole('super_admin')) {
                    return $query;
                } else {
                    return $query->where('user_id', auth()->user()->id);
                }

            })
            ->columns([
                TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable()
                    ->html(),
                TextColumn::make('location')
                    ->label('Localização')
                    ->searchable(),
                TextColumn::make('priority')
                    ->label('Prioridade')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'baixa' => 'gray',
                        'média' => 'warning',
                        'alta' => 'danger',
                    }),
                TextColumn::make('status')
                    ->label('Status da OS'),
                TextColumn::make('created_at')
                    ->label('Data de Criação')
                    ->since()

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageWorkOrders::route('/'),
        ];
    }
}
