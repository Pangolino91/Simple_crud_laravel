<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class immagineuploadata extends Model
{
    protected $fillable =  ['descrizione', 'nomeimmagine'];

    public function user()
    {
        // must be done either with User:class or App\User. It's not enough to pass User since
        // User lives in the App namespace
        return $this->belongsTo('App\User');
    }
}