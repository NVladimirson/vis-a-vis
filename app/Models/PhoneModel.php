<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneModel extends Model
{
    use HasFactory;

    protected $table = 'phones';

    protected $fillable = ['phone', 'firm_id','udated_at','created_at'];

    public function firm(){
        return $this->hasOne('App\Models\FirmModel','id','firm_id');
    }
}
