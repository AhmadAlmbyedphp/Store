<?php

namespace App\Models;

use App\Concerns\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;

class Admin extends User
{
    use HasFactory ,Notifiable ,HasRoles ;
    protected $fillable =
    [
        'name','email','username','password','phone_number','super_admin','status',
    ];
    public function scopeFilter(Builder $builder,$filters)
    {
        if($filters['name']?? false)
        {
            $builder->where('admins.name','LIKE',"%{$filters['name']}%");
        }
        if($filters['status']?? false)
        {
            $builder->where('admins.status',$filters['status']);
        }
    }
    public function isAdmin()
    {
        return $this->super_admin === 1;
    }
}
