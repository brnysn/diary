<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title', 'date', 'content'
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'journal_has_categories', 'journal_id', 'category_id');
    }

    public function contacts()
    {
        return $this->belongsToMany('App\Contact', 'journal_has_contacts', 'journal_id', 'contact_id');
    }
}
