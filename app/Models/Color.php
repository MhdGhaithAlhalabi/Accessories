<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table= 'colors';
    protected $fillable =['color','product_id','color_hex'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function image()
    {
        return $this->hasMany(Image::class);
    }
}
