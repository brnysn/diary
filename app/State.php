<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'id', 'name'
    ];

    public static function selectable()
    {
        return [
            'id', 'name'
        ];
    }


    public function cities()
    {
        return $this->hasMany(City::class);
    }

}
