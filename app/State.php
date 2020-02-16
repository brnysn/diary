<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $hidden = ['deleted_at'];

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

    public function journal()
    {
        return $this->hasMany(Journal::class);
    }
}
