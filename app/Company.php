<?php

namespace App;

use Filament\Models\Contracts\HasName;
use Filament\Models\Contracts\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Modules\Core\Models\User;

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

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function members(): BelongsToMany
    {
        return $this->users();
    }

    public function getFilamentName(): string
    {
        return $this->name;
    }
}
