<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
       'parent_id','name','slug','description','image','status'
    ];


    public function products(){
        return $this->hasMany(Product::class);
    }
    public function parent(){
        return $this->belongsTo(Category::class,'parent_id','id')
        ->withDefault([
            'name'=>'-'
        ]);
    }
    public function children(){
        return $this->hasMany(Category::class,'parent_id','id');
    }

    // local scope
    public function scopeFilter(Builder $builder,$filters)
    {
        if($filters['name']?? false){
                $builder->where('categories.name','LIKE',"%{$filters['name']}%");
            }
            if($filters['status']?? false){
                $builder->where('categories.status',$filters['status']);
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
            'parent_id'=>[
                    'nullable','int',
                    'exists:categories,id'
            ],
            'image'=>[
                    'image','mimes:jpg,png','max:1048576',
                    'dimensions:min_width=100,min_height=100'
            ],
            'status'=>'in:active,archived'
         ];
    }

}
