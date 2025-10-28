<?php

namespace Modules\Core\src\Models;

use Filament\Models\Contracts\HasCurrentTenantLabel;
use Filament\Models\Contracts\HasDefaultTenant;
use Filament\Models\Contracts\HasName;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Company extends Model implements HasName, HasTenants, HasDefaultTenant, HasCurrentTenantLabel
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

    public function getCurrentTenantLabel(): string
    {
        // TODO: Implement getCurrentTenantLabel() method.
        return '';
    }

    public function getDefaultTenant(Panel $panel): ?Model
    {
        // TODO: Implement getDefaultTenant() method.
        return null;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        // TODO: Implement canAccessTenant() method.
        return true;
    }

    public function getTenants(Panel $panel): array|Collection
    {
        // TODO: Implement getTenants() method.
        return [];
    }
}
