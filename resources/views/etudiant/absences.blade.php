@extends('layouts.app')

@section('content')
    <div class="container-md">
        <div class="mx-auto">
            <div>
                <h1 class="d-inline-block">Liste des absences de {{ $data['user']->nom }} {{ $data['user']->prenom }}</h1>
                <a href="/home" class="btn btn-success float-end">Home</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Module</th>
                        <th scope="col">Date</th>
                        <th scope="col">Etat</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['abs'] as $s)
                    <tr>
                        <td>{{ $s->module->nom }}</td>
                        <td>{{ $s->date }}</td>
                        <td>
                            @php
                                $x = $s->present ? 'P' : 'A';
                                if($x == 'A')
                                    $x = $s->justified ? 'AJ' : 'A';
                                print $x;
                            @endphp
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
