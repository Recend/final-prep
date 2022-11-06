<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'price', 'warehouse_id'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }


//    public function scopefilterByWarehouse($query, $warehouseId)
//    {
//        if ($warehouseId) {
//            $query->where('warehouse_id', $warehouseId);
//        } else
//            return $query;
//    }


    public function scopefilter($query, $warehouseId, $quantity, $price)
    {
        if ($warehouseId) {
            return $query->where('warehouse_id', $warehouseId);
        }
        if ($quantity) {
            return $query->where('quantity', $quantity);
        }
        if ($price) {
            return $query->where('price', $price);
        }
        return $query;
    }

    public function scopefindByName($query, $name){
        if($name){
            return $query->where('name','like',"%$name%");
                //->orWhere('description','like', "%$name%");
        }else
            return $query;
    }
}
