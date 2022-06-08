<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\AssignOp\Mod;

class Enseignement extends Model
{
    use HasFactory;

    public function enseignant () {
        return $this->belongsTo(Enseignant::class)->first();
    }

    public function module () {
        return $this->belongsTo(Module::class)->first();
    }

    public function absenceEnseignant () {
        return $this->hasMany(AbsenceEnseignant::class);
    }
}
