<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;
    
    protected $primaryKey = 'id';

    protected $hidden = ['deleted_at'];

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

    public function journal()
    {
        return $this->hasMany(Journal::class);
    }
    
}
