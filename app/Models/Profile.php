<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $primaryKey='user_id';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'image',
        'birthday',
        'gender',
        'street_address',
        'city',
        'state',
        'postal_code',
        'country',
        'locale',
    ];

   public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public static function rules()
    {
     return[
        'first_name'=>['required','string','max:255'],
        'last_name'=>['required','string','max:255'],
        'birthday'=>['nullable','date','before:today'],
        'gander'=>['in:male,female'],
        'country'=>['require','string','size:2']
     ];
    }
}
