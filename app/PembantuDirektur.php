<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembantuDirektur extends Model
{
    protected $table = 'pembantu_direktur';

    public function user() {
        return $this->belongsTo('App\User');
    }
}
