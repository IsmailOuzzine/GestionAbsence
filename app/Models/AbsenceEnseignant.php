<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenceEnseignant extends Model
{
    use HasFactory;

    public function enseignement () {
        return $this->belongsTo(Enseignement::class)->first();
    }
}
