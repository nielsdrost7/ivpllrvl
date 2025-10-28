<?php

namespace Modules\Clients\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Clients\Database\Factories\ClientFactory;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'client_name',
        'client_email',
        'client_phone',
        'client_address',
        'client_city',
        'client_state',
        'client_zip',
        'client_country',
    ];

    protected static function newFactory(): ClientFactory
    {
        return ClientFactory::new();
    }
}
