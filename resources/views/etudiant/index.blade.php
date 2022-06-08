@extends('layouts.app')

@section('content')
    <div id="body" class="bg-light p-3 container">
        <div class="row bg-white p-4 rounded">
            <div class="col-3 text-center py-5" id="img-profile">
                <img
                    src="/images/{{ $student['etud']->img_path }}"
                    class="rounded-circle"
                    alt="photo de profile"
                    height="auto"
                    width="80%"
                />

            </div>
            <div class="col-9 p-2" id="infos">
                <table class="table">
                    <tbody>
                    <tr> <td>Nom</td> <td>{{ $student['user']->nom }}</td> </tr>
                    <tr> <td>Prénom</td> <td>{{ $student['user']->prenom }}</td> </tr>
                    <tr> <td>CNE</td> <td>{{ $student['etud']->cne }}</td> </tr>
                    <tr> <td>Email</td> <td>{{ $student['user']->email }}</td> </tr>
                    <tr> <td>Adresse</td> <td>{{ $student['user']->adresse }}</td> </tr>
                    <tr> <td>Classe</td> <td>{{ $student['etud']->classe()->nom }}</td> </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row bg-white mt-3 p-4">
            <h3 class="mx-auto">Vous vous êtes absenté {{ $student['nb'] }} fois dont {{ $student['nbj'] }} fois est justifiée.</h3>
        </div>
    </div>
@endsection
