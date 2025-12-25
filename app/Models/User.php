<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


    protected $fillable = ['name', 'email', 'password', 'default_panel'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'default_panel' => 'string',
        ];
    }



    public function canAccessPanel(Panel $panel): bool
    {
        // هذا السطر يضمن أن الـ Super Admin يدخل على كل شيء دائماً
        if ($this->hasRole('super_admin')) {
            return true;
        }

        return match ($panel->getId()) {
            'admin'    => $this->hasRole('admin'),
            'hr'       => $this->hasRole('hr') || $this->hasRole('admin'),
            'manager'  => $this->hasRole('manager') || $this->hasRole('admin'),
            'employee' => $this->hasRole('employee') || $this->hasRole('admin'),
            default    => false,
        };
    }
    // public function canAccessPanel(Panel $panel): bool
    // {
    //     return true;
    // }

    public function employee()
    {
        return $this->hasOne(\App\Models\Employee::class);
    }
}
