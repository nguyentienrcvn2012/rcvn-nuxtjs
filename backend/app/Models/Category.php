<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    protected $table = 'category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categoryName', 'description', 'updated_at','imageUrl'
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
    public function scopeCategoryName($query, $categoryId)
    {
        return $query->join('category', 'category.id', '=', 'products.categoryId')->select('categoryName')->get();

    }

    /**
     * @param $query
     * @param $email
     * @return mixed
     */
    public function scopeEmail($query, $email)
    {
        return $query->where('users.email', 'LIKE', "%$email%", 'or');
    }
}