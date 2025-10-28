<?php

namespace Modules\Quotes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Quotes\Database\Factories\QuoteFactory;
use Modules\Clients\Models\Client;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'client_id',
        'quote_status_id',
        'quote_number',
        'quote_date_created',
        'quote_total',
    ];

    protected $casts = [
        'quote_date_created' => 'datetime',
        'quote_total' => 'decimal:2',
    ];

    protected static function newFactory(): QuoteFactory
    {
        return QuoteFactory::new();
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
