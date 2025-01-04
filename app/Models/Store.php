<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
class Store extends Model
{
    use HasFactory ,Notifiable;

    protected $fillable = [
     'name','slug','description','iogo_image','cover_image','status'
      ];


      public function products()
      {
           return $this->hasMany(Product::class,'store_id','id');
      }
       // local scope
     public function scopeFilter(Builder $builder,$filters)
     {
        if($filters['name']?? false){
                $builder->where('stores.name','LIKE',"%{$filters['name']}%");
            }
                if($filters['status']?? false){
                $builder->where('stores.status',$filters['status']);
            }
     }
     public static function rules($id = 0)
     {
      return[
             'name'=>[
                     'required','string','min:3','max:35',
                     Rule::unique('categories','name')->ignore($id),
                     'filter :: php ,laravel,html,Css',
             ],
             'description'=>[
                'required','string','min:20','max:5000',
             ],
             'iogo_image'=>[
                     'image','mimes:jpg,png','max:1048576',
                     'dimensions:min_width=100,min_height=100'
             ],
             'cover_image'=>[
                'image','mimes:jpg,png','max:1048576',
                'dimensions:min_width=100,min_height=100'
        ],
             'status'=>'in:active,archived'
          ];
     }



}
