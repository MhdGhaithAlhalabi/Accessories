<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, string $string1, $customerId)
 * @method static create(array $array)
 * @method static find($id)
 */
class Rate extends Model
{
    use HasFactory;
    protected $table= 'rates';
    protected $fillable =['rate','product_id','customer_id'];
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
