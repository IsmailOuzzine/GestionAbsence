<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\AbsenceEnseignant;
use App\Models\Enseignant;
use App\Models\Enseignement;
use App\Models\Etudiant;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\AssignOp\Mod;

class EnseignantController extends Controller
{
    public function index() {
        $user = Auth::user();
        $prof = Enseignant::where('user_id', $user->id)->first();

        $modules = array();
        $ens = Enseignement::where('enseignant_id', $prof->id)->get();
        $nb = 0;
        $nbj = 0;
        foreach ($ens as $e) {
            $m = Module::find($e->module_id);
            $nb += $e->absenceEnseignants->where('present', false)->count();
            $nbj += $e->absenceEnseignants->where('present', false)->where('justified', true)->count();
            array_push($modules, $m);
        }

        $table = [
            'user' => $user,
            'prof' => $prof,
            'modules' => $modules,
            'nb' => $nb,
            'nbj' => $nbj,
        ];
        return view('enseignant.index', $table);
    }

    public function create() {
        return view('enseignant.create');
    }

    public function store(Request $request) {
        $file = $request->file('photo');
        if (($file->extension() != 'png')  && ($file->extension() != 'jpg')) {
            $message = $file->extension()." files are not accepted !";

            return back()->withInput(['message' => $message]);
        }
        $user = new User();
        $user->nom = $request->input('name');
        $user->prenom = $request->input('prenom');
        $user->role = 'enseignant';
        $user->adresse = $request->input('adresse');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $filename = $request->input('name').'_'.$request->input('prenom').'.'.$file->extension();
        $user->img_path = $filename;
        $file->move(public_path('images\enseignants'), $filename);
        $user->save();

        $enseignant = new Enseignant();
        $enseignant->user_id = $user->id;
        $enseignant->save();

        return redirect()->route('home');
    }

    public function absencesModules($id) {
        $prof = Enseignant::where('user_id', Auth::user()->id)->first();
        $enseignement = Enseignement::where('enseignant_id', $prof->id)
            ->where('module_id', $id)
            ->orderByDesc('annee_universitaire')
            ->first();
        if ($enseignement == null) {
            abort(403, 'Unauthorized action.');
        }
        //get all absences of students of that module grouped by date
        $module = Module::find($id);
        $absences = Absence::join('etudiants', 'absences.etudiant_id', '=', 'etudiants.id')
            ->join('users', 'etudiants.user_id', '=', 'users.id')
            ->where('module_id', $id)
            ->select('users.nom', 'users.prenom', 'users.img_path', 'etudiants.cne', 'absences.present', 'absences.justified', 'absences.date')
            ->orderByDesc('date')
            ->get();
        $data = [
            'module' => $module,
            'prof' => $prof,
            'absences' => $absences,
        ];
        return view('enseignant.absencesEnModule', $data);
    }

    public function absences($id) {
        if(Auth::user()->id != $id) {
            return redirect()->route('ens.abs', Auth::user()->id);
        }
        //get all absences of this enseignant
        $prof = Enseignant::where('user_id', Auth::user()->id)->first();
        $absences = AbsenceEnseignant::join('enseignements', 'absence_enseignants.enseignement_id', '=', 'enseignements.id')
            ->join('modules', 'enseignements.module_id', '=', 'modules.id')
            ->where('enseignements.enseignant_id', $prof->id)
            ->select('absence_enseignants.date', 'modules.nom', 'present', 'justified')
            ->orderByDesc('absence_enseignants.date')
            ->get();
        $data = [
            'user' => Auth::user(),
            'prof' => $prof,
            'absences' => $absences,
        ];

        return view('enseignant.absences', $data);
    }
}
