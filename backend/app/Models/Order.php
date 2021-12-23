<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    protected $table = 'orders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'productName', 'categoryId', 'price','description','inventory','updated_at','imageUrl'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /**
     * @param $query
     * @param $name
     * @return mixed
     */
    public function customer() {
        return $this->hasOne('App\Models\Customer', 'id', 'customerId');
    }
    public function product() {
        return $this->hasOne('App\Models\product', 'id', 'productId');
    }
    public function getCustomerNameAttribute()
    {
        return $this->customer->name;
    }

    /**
     * @param $query
     * @param $email
     * @return mixed
     */
    public function getProductNameAttribute()
    {
        return $this->product->productName;

    }
    public function getStatusOrderAttribute()
    {
         if($this->status==0){
            return 'proccessing';
         }else{
            return 'finished';
         }
    }
}
