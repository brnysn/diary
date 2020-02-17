<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{

    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $touches = ['journals'];

    protected $fillable = [
        'name'
    ];

    public function journals()
    {
        return $this->belongsToMany('App\Journal', 'journal_has_tags', 'tag_id', 'journal_id');
    }
}
