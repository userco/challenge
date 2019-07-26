<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secret extends Model
{
    protected $table = 'secrets';
	protected $fillable = [
        'id','code', 'username',
    ];
	protected $primaryKey = 'id';
	public $timestamps=true;
}
