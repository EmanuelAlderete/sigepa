<?php

namespace App\Filament\Pages;

use App\Enums\WorkOrdersStatus;
use App\Models\WorkOrder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Collection;
use Mokhosh\FilamentKanban\Pages\KanbanBoard;

class WorkOrdersBoard extends KanbanBoard
{
    protected static string $model = WorkOrder::class;
    protected static string $statusEnum = WorkOrdersStatus::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $recordTitleAttribute = 'location';
    protected static ?string $title = 'Quadro de Ordens de Serviço';
    protected string $editModalTitle = 'Editar';
    protected string $editModalSaveButtonLabel = 'Salvar';

    protected string $editModalCancelButtonLabel = 'Cancelar';

    protected function getEditModalFormSchema(null|int $recordId): array
    {
        return [
            TextInput::make('location')
                ->label('Localização')
                ->readOnly(),
            TextInput::make('description')
                ->label('Descrição')
                ->readOnly(),
            Select::make('category')
                ->label('Categoria')
                ->hint('Você pode editar a categoria.')
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
                ]),
            Select::make('priority')
                ->label('Prioridade')
                ->hint('Você pode alterar a prioridade.')
                ->options([
                    'baixa' => 'Baixa',
                    'média' => 'Média',
                    'alta' => 'Alta',
                ]),

        ];
    }

}
