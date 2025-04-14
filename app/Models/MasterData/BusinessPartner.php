<?php

namespace App\Models\MasterData;

use App\Helpers\NumberGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessPartner extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [
        'price_level_id',
        'code',
        'name',
        'address',
        'phone',
        'is_customer',
        'is_supplier',
        'is_active',
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

    protected static function onBoot()
    {
        self::creating(function ($model) {
            $model->code = NumberGenerator::generate(self::class, 'MITRA', 5, false, 'code');
        });   
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
            $object[$prefix . "code"] = $this->code;
            $object[$prefix . "name"] = $this->name;
            $object[$prefix . "address"] = $this->address;
            $object[$prefix . "phone"] = $this->phone;
            $object[$prefix . "is_customer"] = $this->is_customer;
            $object[$prefix . "is_supplier"] = $this->is_supplier;
        }

        return $object;
    }

    public function priceLevel()
    {
        return $this->belongsTo(PriceLevel::class, 'price_level_id', 'id');
    }

}
