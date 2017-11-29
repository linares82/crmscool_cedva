<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetAllDataTrait;
use App\Traits\RelationManagerTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodoMaterium extends Model
{
    use RelationManagerTrait,GetAllDataTrait;
    use SoftDeletes;

    protected $table="periodo_materium";

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    } 

	//Mass Assignment
	protected $fillable = ['periodo_estudio_id','materium_id','created_at','updated_at', 'deleted_at'];

	public function periodo_estudios() {
		return $this->belongsTo('App\PeriodoEstudio', 'id', 'periodo_estudio_id');
	}// end

	public function materias() {
		return $this->belongsTo('App\Materium', 'id', 'materium_id');
	}// end

    protected $dates = ['deleted_at'];
}