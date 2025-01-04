<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
       'name','slug','description','image','category_id','store_id',
       'price','compare_price','status',
    ];
     // local scope
     public function scopeFilter(Builder $builder,$filters)
     {
        if($filters['name']?? false){
            $builder->where('products.name','LIKE',"%{$filters['name']}%");
                }
                 if($filters['status']?? false){
                 $builder->where('products.status',$filters['status']);
        }
     }
     protected static  function booted()
     {
        static::addGlobalScope('store',function(Builder $builder){
            $user=Auth::user();
            if($user && $user->store_id){
          $builder->where('store_id','=',$user->store_id);
            }
        });
     }


     public function category()
     {
           return $this->belongsTo(Category::class);
     }
     public function store()
     {
           return $this->belongsTo(Store::class);
     }
     public function tags(){
      return $this->belongsToMany(Tag::class,);
     }
     protected function scopeActive(Builder $builder)
     {
      $builder->where('status','=','active');
     }

     public function getImageUrlAttribute()
     {
       if(!$this->image){
        return 'https://www.incathlad.com/imges/products/default_producr.png';
       }
       if(Str::startsWith($this->image, ['http://','https://'])){
             return $this ->image;
       }
      return asset('storage/'.$this->image);
    }

    public function getSalePercentAttribute()
    {
      if(!$this->compare_price){
            return 0;
      }
      return round(100-(100 * $this->price/ $this->compare_price),1) ;
    }


    public static function rules($id = 0)
    {
       return[
            'name'=>[
                    'required','string','min:5','max:35',
                    'filter :: php ,laravel,html,Css',
            ], 'parent_id'=>[
                    'nullable','int',
                    'exists:categories,id'
            ], 'description'=>[
                  'required','string','min:20','max:5000',
            ],'image'=>[
                    'image','mimes:jpg,png','max:1048576',
                    'dimensions:min_width=100,min_height=100'
            ],'price'=>[
                  'int','required'
            ], 'compare_price'=>[
             // ويكون رقم priceمطلوب فلديشن ماكس السعر
             'int',
            ],'status'=>'in:active,draft,archived'
         ];
    }


}
