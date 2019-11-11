<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $table = 'relationship';
    protected $fillable = ['id_relationship','name','note','time_met','phoneNumber'];
    protected $primaryKey = 'id_relationship';
    protected function User() {
        return $this->belongsTo(User::class);
    }
    public function addresses() {
        return $this->belongsTo('App\Address','id_address');
    }
    public function kindOfRelation() {
        return $this->belongsTo('App\KindOfRelationship','id_kindOfRelationship');
    }
}
