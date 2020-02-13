<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id', 'state_id', 'name'
    ];


    public static function selectable()
    {
        return [
            'id', 'state_id', 'name'
        ];
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
    
}
