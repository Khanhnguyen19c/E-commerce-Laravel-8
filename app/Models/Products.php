<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','slug','shor_desc','desc','regular_price','sale_price','SKU','stock_status','featured','quantity','sold','image','images','category_id'];
    protected $table = "products";
    protected $primaryKey ='id';
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class,'product_id');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }
    public function attributevalues(){
        return $this->hasMany(AttributeValue::class,'product_id');
    }
   
}
