<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if (Auth::user()->role == 'admin')
            return view('home');
        elseif (Auth::user()->role == 'etudiant'){
            $etud = Etudiant::where('user_id', Auth::user()->id)->first();

            $student = [
                'user' => Auth::user(),
                'etud' => $etud,
                'nb' => $etud->absences()->where('present', false)->count(),
                'nbj' => $etud->absences()->where('justified', true)->count(),
            ];
            return view('etudiant.index', ['student' => $student]);
        }
        elseif (Auth::user()->role == 'enseignant') {
            return redirect()->route('enseignants.profile');
        }
    }
}
