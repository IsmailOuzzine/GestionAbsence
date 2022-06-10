@extends('layouts.app')

@section('content')
    <div id="body" class="bg-light p-3 container">
        <div class="row bg-white p-4 rounded shadow-sm">
            <div class="col-3 text-center" id="img-profile">
                <img
                    src="/images/enseignants/{{ $user->img_path }}"
                    class="rounded-circle shadow-sm"
                    alt="photo de profile"
                    height="auto"
                    width="65%"
                />

            </div>
            <div class="col-9 p-2" id="infos">
                <table class="table">
                    <tbody>
                    <tr> <th>Nom</th> <td>{{ $user->nom }}</td> </tr>
                    <tr> <th>Prénom</th> <td>{{ $user->prenom }}</td> </tr>
                    <tr> <th>Email</th> <td>{{ $user->email }}</td> </tr>
                    <tr> <th>Adresse</th> <td>{{ $user->adresse }}</td> </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md bg-white mt-3 p-4 shadow-sm rounded">
                <h3 class="d-inline-block">Vous vous êtes absenté {{ $nb }} fois dont {{ $nbj }} fois est justifiée.</h3>
                <a href="/enseignants/{{$user->id}}/absences" class="btn btn-secondary float-end">Voir plus</a>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md bg-white mt-3 p-4 shadow-sm rounded">
                <h4>La liste des absents dans les modules</h4>
                <ul>
                @foreach($modules as $m)
                    <li>
                        <a href="/enseignants/modules/{{ $m->id }}/absences"
                           class="text-primary text-decoration-none"
                        >
                            {{ $m->nom }}
                        </a>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
