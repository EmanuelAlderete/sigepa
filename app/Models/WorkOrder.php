<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class WorkOrder extends Pivot
{
    use HasFactory;
    protected $fillable = [
        'description',
        'location',
        'priority',
        'status',
        'category',
        'feedback',
        'feedback_note',
        'user_id',
    ];

    /**
     * Get the user that owns the WorkOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
