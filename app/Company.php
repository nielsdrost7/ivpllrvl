<?php

namespace App;

use Filament\Models\Contracts\HasName;
use Filament\Models\Contracts\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Company extends Model implements Tenant, HasName
{
    protected $fillable = [
        'name',
        'slug',
        'address',
        'email',
        'phone',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function members(): HasMany
    {
        return $this->users();
    }

    public function getFilamentName(): string
    {
        return $this->name;
    }
}
