<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table= 'images';
    protected $fillable =['url','color_id'];
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
