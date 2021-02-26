<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirmModel extends Model
{
    use HasFactory;

    protected $fillable = ['name','udated_at','created_at'];

    protected $table = 'firms';

    public function phones(){
        return $this->hasMany('App\Models\PhoneModel','firm_id','id');
    }
}
