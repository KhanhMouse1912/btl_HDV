<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $fillable = ['id_address','city','district','wards'];
    protected $primaryKey = 'id_address';
    public $timestamps = false;
    //
    public function relationships()
    {
        return $this->hasMany('App\Relationship','id_address','id_address');
    }
}
