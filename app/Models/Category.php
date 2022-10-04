<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static select(string $string, string $string1, string $string2, string $string3)
 */
class Category extends Model
{
    use HasFactory;
    protected $table= 'categories';
    protected $fillable =['category_name','type_id','category_image'];
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
