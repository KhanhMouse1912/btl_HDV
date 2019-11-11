<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Relationship;

class KindOfRelationship extends Model
{
    //
    protected $table = 'kindofrelationship';
    protected $fillable = ['id_kindOfRelationship','nameOfRelationship'];
    protected $primaryKey = 'id_kindOfRelationship';

    public function relationships()
    {
        return $this->hasMany(Relationship::class,'id_kindOfRelationship','id_kindOfRelationship');
    }
}
