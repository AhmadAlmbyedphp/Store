<?php

namespace App\Models;

use Carbon\Carbon;
use App\Concerns\HasRoles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory,SoftDeletes,HasRoles;

    protected $fillable=
    [
        'store_id','user_id','payment_method','status','paymemt_status'
    ];
    public function scopeFilter(Builder $builder,$filters)
    {
       if($filters['name']?? false){
           $builder->where('products.name','LIKE',"%{$filters['name']}%");
               }
                if($filters['status']?? false){
                $builder->where('products.status',$filters['status']);
       }
    }
    protected static function booted()
    {
        static::creating(function(Order $order)
        {
         $order->number=Order::getNextOrderNumber();
        });
    }
    public  function store()
    {
     return $this->belongsTo(Store::class);
    }
    public  function user()
    {
     return $this->belongsTo(User::class)->withDefault([
        'name'=>'Guest Customer'
       ]);
    }
    public function  products(){
        return $this->belongsToMany(Product::class,'order_items','order_id','product_id','id','id')
        ->using(OrderItem::class)
        ->as('order_item')
        ->withPivot([
            'product_name','price','quantity','options',
        ]);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function addresses()
    {
        return $this->hasOne(OrderAddress::class);
    }
    public function billingAddress()
    {
       return $this->hasOne(OrderAddress::class,'order_id','id')
       ->where('type','=','billing');
    }
    public function shippingAddress()
    {
       return $this->hasOne(OrderAddress::class,'order_id','id')
       ->where('type','=','shipping');
    }

    public static function getNextOrderNumber()
    {
        $year=Carbon::now()->year;
        $number=Order::whereYear('created_at',$year)
                      ->max('number');
        if($number){
            return $number+1;
        }
        return $year .'0001';
    }

}
