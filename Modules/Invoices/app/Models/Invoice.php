<?php

namespace Modules\Invoices\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Invoices\Database\Factories\InvoiceFactory;
use Modules\Clients\Models\Client;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'client_id',
        'invoice_status_id',
        'invoice_number',
        'invoice_date_created',
        'invoice_date_due',
        'invoice_balance',
        'invoice_total',
        'invoice_sign',
        'invoice_is_recurring',
        'is_read_only',
        'sumex_id',
        'total',
    ];

    protected $casts = [
        'invoice_date_created' => 'datetime',
        'invoice_date_due' => 'datetime',
        'invoice_balance' => 'decimal:2',
        'invoice_total' => 'decimal:2',
        'total' => 'decimal:2',
        'invoice_sign' => 'integer',
        'invoice_is_recurring' => 'boolean',
        'is_read_only' => 'boolean',
    ];

    protected static function newFactory(): InvoiceFactory
    {
        return InvoiceFactory::new();
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function getIsOverdueAttribute(): bool
    {
        if (!$this->invoice_date_due) {
            return false;
        }
        
        return $this->invoice_status_id == 2 && $this->invoice_date_due->isPast();
    }
}
