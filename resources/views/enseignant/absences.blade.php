@extends('layouts.app')

@section('content')
    <div class="container-md">
        <div>
            <h1 class="d-inline-block">Liste des absences de Mr. {{ $user->nom }} {{ $user->prenom }}</h1>
            <a href="/home" class="btn btn-success float-end">Home</a>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Module</th>
                <th>Date</th>
                <th>Etat</th>
            </tr>
            </thead>
            <tbody>
            @foreach($absences as $abs)
                <tr>
                    <td> {{ $abs->nom }} </td>
                    <td> {{ $abs->date }} </td>
                    <td>
                        @if($abs->present)
                            P
                        @elseif($abs->justified)
                            AJ
                        @else
                            A
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
