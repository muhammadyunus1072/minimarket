<?php

namespace App\Models\MasterData;

use App\Helpers\NumberGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashAccount extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [
        'code',
        'type',
        'name',
        'current_balance',
        'admin_type',
        'admin_fee',
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

    CONST TYPE_CASH = 'cash';
    CONST TYPE_BANK = 'bank';

    CONST TYPE_CHOICE = [
        self::TYPE_CASH => 'TUNAI',
        self::TYPE_BANK => 'BANK',
    ];

    CONST ADMIN_TYPE_PERCENTAGE = 'percentage';
    CONST ADMIN_TYPE_FIXED = 'fixed';

    CONST ADMIN_TYPE_CHOICE = [
        self::ADMIN_TYPE_PERCENTAGE => 'Persentase',
        self::ADMIN_TYPE_FIXED => 'Nominal Tetap',
    ];

    protected static function onBoot()
    {
        self::creating(function ($model) {
            $model->code = NumberGenerator::generate(self::class, 'AKUN_KAS', 5, false, 'code');
        });   
    }

    public function saveInfo($object, $data = null, $prefix = "cash_account_")
    {
        if($data)
        {
            foreach($data as $item)
            {
                $object[$prefix . "".$item] = $this->$item;
            }
        }else{
            $object[$prefix . "code"] = $this->code;
            $object[$prefix . "type"] = $this->type;
            $object[$prefix . "name"] = $this->name;
            $object[$prefix . "admin_type"] = $this->admin_type;
            $object[$prefix . "admin_fee"] = $this->admin_fee;
        }

        return $object;
    }
}
