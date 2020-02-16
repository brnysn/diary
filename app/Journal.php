<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];
    
    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'title', 'date', 'content', 'state_id', 'city_id'
    ];

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'journal_has_tags', 'journal_id', 'tag_id');
    }

    public function contacts()
    {
        return $this->belongsToMany('App\Contact', 'journal_has_contacts', 'journal_id', 'contact_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
