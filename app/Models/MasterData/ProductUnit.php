<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductUnit extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [
        'product_id',
        'price_level_id',
        'barcode',
        'is_main',
        'name',
        'value',
        'retail_price',
    ];
    
    protected $guarded = ['id'];

    public function isDeletable()
    {
        return true;
    }

    public function isEditable()
    {
        return true;
    }


    public function saveInfo($object, $data = null, $prefix = "product_unit_")
    {
        if($data)
        {
            foreach($data as $item)
            {
                $object[$prefix . "".$item] = $this->$item;
            }
        }else{
            $object[$prefix . "barcode"] = $this->barcode;
            $object[$prefix . "name"] = $this->name;
            $object[$prefix . "value"] = $this->value;
            $object[$prefix . "retail_price"] = $this->retail_price;
        }

        return $object;
    }
}
