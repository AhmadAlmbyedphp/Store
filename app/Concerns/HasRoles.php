<?php
namespace App\Concerns;

use App\Models\Role;

trait HasRoles
{
    public function roles()
    {
        return $this->morphToMany(Role::class,'users','role_user');
    }
    public function hasAbility($ability)
    {
       $deny= $this->roles()->whereHas('abilities',function($query) use ($ability){
            $query->where('ability',$ability)
                   ->where('type','=','deny');
                })->exists();
      if($deny){
        return false ;
      }{
       return $this->roles()->whereHas('abilities',function($query) use ($ability){
            $query->where('ability',$ability)
                   ->where('type','=','allow');

       })->exists();
    }
    }
}
