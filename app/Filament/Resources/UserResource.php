<?php

namespace App\Filament\Resources;

use App\Filament\Imports\UserImporter;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ImportAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $pluralModelLabel = 'Usuários';
    protected static ?string $modelLabel = 'Usuário';
    protected static ?string $slug = 'usuarios';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nome'),
                Forms\Components\TextInput::make('idt')
                    ->label('Identidade Militar')
                    ->mask('999.999.999-9')
                    ->required(),
                Forms\Components\Select::make('posto')
                    ->label('Posto / Graduação')
                    ->options([
                        'Sd EV' => 'Sd EV',
                        'Sd EP' => 'Sd EP',
                        'Cb' => 'Cb',
                        '3º Sgt' => '3º Sgt',
                        '2º Sgt' => '2º Sgt',
                        '1º Sgt' => '1º Sgt',
                        'ST' => 'ST',
                        'Asp' => 'Asp',
                        '2º Ten' => '2º Ten',
                        '1º Ten' => '1º Ten',
                        'Cap' => 'Cap',
                        'Maj' => 'Maj',
                        'Ten Cel' => 'Ten Cel',
                        'Cel' => 'Cel',
                        'Gen Bda' => 'Gen Bda',
                        'Gen Div' => 'Gen Div',
                        'Gen Ex' => 'Gen Ex',
                        'Mal' => 'Mal'
                    ])
                    ->required(),
                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ImportAction::make()
                    ->importer(UserImporter::class)
            ])
            ->columns([
                Tables\Columns\TextColumn::make('posto')
                    ->searchable()
                    ->label('Posto'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nome'),
                Tables\Columns\TextColumn::make('idt')
                    ->searchable()
                    ->label('Identidade Militar'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make('Editar')
                        ->icon('heroicon-o-pencil-square'),
                    Tables\Actions\Action::make('Resetar Senha')
                        ->action(function ($record) {
                            $record->resetPassword();
                        })
                        ->requiresConfirmation()
                        ->icon('heroicon-o-arrow-path'),
                ])
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
