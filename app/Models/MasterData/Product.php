<?php

namespace App\Models\MasterData;

use App\Helpers\NumberGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [
        'name',
        'description',
        'product_category_id',
        'expired_date',

        'type',
        'min_stock',
        'max_stock',
        'purchase_price',

        'brand',

        'supplier_id',

        'default_purchase_unit_id',
        'default_retail_unit_id',
        'default_stock_unit_id',

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

    const TYPE_PRODUCT_WITH_STOCK = 'product_with_stock';
    const TYPE_PRODUCT_WITHOUT_STOCK = 'product_without_stock';
    const TYPE_SERVICE = 'service';
    const TYPE_CHOICE = [
        self::TYPE_PRODUCT_WITH_STOCK => "Barang dengan Stok",
        self::TYPE_PRODUCT_WITHOUT_STOCK => "Barang tanpa Stok",
        self::TYPE_SERVICE => "Jasa",
    ];

    protected static function onBoot()
    {
        self::creating(function ($model) {
            $model->pid = NumberGenerator::generate(self::class, 'PID', 5, false, 'pid');
        });   
    }

    public function saveInfo($object, $data = null, $prefix = "product_")
    {
        if($data)
        {
            foreach($data as $item)
            {
                $object[$prefix . "".$item] = $this->$item;
            }
        }else{
            $object[$prefix . "name"] = $this->name;
            $object[$prefix . "description"] = $this->description;
            $object[$prefix . "expired_date"] = $this->expired_date;

            $object[$prefix . "type"] = $this->type;
            $object[$prefix . "min_stock"] = $this->min_stock;
            $object[$prefix . "max_stock"] = $this->max_stock;
            $object[$prefix . "purchase_price"] = $this->purchase_price;

            $object[$prefix . "brand"] = $this->brand;
        }

        return $object;
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }
}
