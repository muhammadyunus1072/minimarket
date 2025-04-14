<?php

namespace App\Models\MasterData;

use App\Helpers\NumberGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceLevel extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [
        'code',
        'name',
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
            $model->code = NumberGenerator::generate(self::class, 'LEVEL', 5, false, 'code');
        });   
    }
    
    public function saveInfo($object, $data = null, $prefix = "price_level_")
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
        }

        return $object;
    }
}
