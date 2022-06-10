<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EtudiantController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'cne' => ['required', 'string', 'max:10', 'max:255', 'unique:etudiants'],
            'adresse' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    public function index() {
        return view('etudiant.index');
    }

    public function create() {
        $classes = Classe::all();
        return view('etudiant.create', ['classes' => $classes]);
    }

    public function store(Request $request)
    {

        $file = $request->file('photo');
        if (($file->extension() != 'png')  && ($file->extension() != 'jpg')) {
            $message = $file->extension()." files are not accepted !";
            print $message;
            return;
        }
        $user = new User();
        $user->nom = \request('name');
        $user->prenom = \request('prenom');
        $user->role = 'etudiant';
        $user->adresse = \request('adresse');
        $user->email = \request('email');
        $user->password = Hash::make(\request('password'));
        $filename = \request('cne').'.'.$file->extension();
        $user->img_path = $filename;
        $file->move(public_path('images\etudiants'), $filename);
        $user->save();

        $etu = new Etudiant();
        $etu->cne = \request('cne');
        $etu->classe_id = Classe::findOrFail(\request('classe'))->id;
        $etu->user_id = $user->id;
        $etu->save();

        return redirect()->route('home');
        // print '<a href="/home">home</a>';
    }

    public function absences($id) {
        if ($id != ''.Auth::user()->id) {
            return redirect()->route('etudiants.abs', Auth::user()->id);
        }
        $etud = Etudiant::where('user_id', Auth::user()->id)->first();

        $data = [
            'user' => Auth::user(),
            'etud' => $etud,
            'abs' => $etud->absences()
                ->where('etudiant_id', $etud->id)
                ->get(),
        ];
        return view('etudiant.absences', ['data' => $data]);
    }
}
