<?php

declare(strict_types=1);

namespace Modules\Core\Models;

use App\Company;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable implements FilamentUser, HasTenants
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'user_name', 'user_email', 'user_password', 'user_active',
        'user_type', 'user_company', 'user_language', 'user_psalt',
        'user_passwordreset_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'user_password', 'user_psalt',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    /**
     * Get user_id attribute (alias for id for backward compatibility).
     */
    public function getUserIdAttribute()
    {
        return $this->id;
    }

    /**
     * Set user_id attribute (alias for id for backward compatibility).
     */
    public function setUserIdAttribute($value)
    {
        $this->attributes['id'] = $value;
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true; // For now, allow all users
    }

    public function getTenants(Panel $panel): Collection
    {
        return $this->companies;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->companies->contains($tenant);
    }
}
