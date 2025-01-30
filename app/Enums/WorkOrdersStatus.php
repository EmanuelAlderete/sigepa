<?php

namespace App\Enums;

use Mokhosh\FilamentKanban\Concerns\IsKanbanStatus;

enum WorkOrdersStatus: string
{
    use IsKanbanStatus;

    case Aberta = 'aberta';
    case EmAndamento = 'em_andamento';
    case Finalizada = 'finalizada';
    case Cancelada = 'cancelada';
}
