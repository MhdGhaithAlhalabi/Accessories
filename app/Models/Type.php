<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $table= 'types';
    //protected $fillable =['type_name','type_image'];
    protected $fillable =['type_name'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function category()
    {
        return $this->hasMany(Category::class);
    }
}
