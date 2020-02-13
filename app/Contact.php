<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'firstname', 'lastname', 'email', 'phone'
    ];
    
    protected $appends = [
        'full_name'
     ];
 

    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function journals()
    {
        return $this->belongsToMany('App\Journal', 'journal_has_contacts', 'contact_id', 'journal_id');
    }
}
