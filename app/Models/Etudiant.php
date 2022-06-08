<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    public function classe() {
        return $this->belongsTo(Classe::class)->first();
    }

    public function user() {
        return $this->hasOne(User::class);
    }

    public function absences() {
        return $this->hasMany(Absence::class);
    }
}
