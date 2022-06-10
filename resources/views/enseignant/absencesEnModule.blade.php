@extends('layouts.app')

@section('content')
    <div class="container-md">
        <div>
            <h1 class="d-inline-block">Liste des absents dans le module <strong>{{ $module->nom }}</strong>. </h1>
            <a href="/home" class="btn btn-success float-end">Home</a>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Cne</th>
                <th>Date</th>
                <th>Etat</th>
            </tr>
            </thead>
            <tbody>
            @php
                $i = 0;
            @endphp
            @foreach($absences as $abs)
                @php
                    $i++;
                @endphp
                <tr>
                    <td class="align-middle">
                        <img src="/images/etudiants/{{ $abs->img_path }}"
                             class="rounded-circle"
                             width="50"
                             height="auto"
                        />
                    </td>
                    <td class="align-middle"> {{ $abs->nom }} </td>
                    <td class="align-middle"> {{ $abs->prenom }} </td>
                    <td class="align-middle"> {{ $abs->cne }} </td>
                    <td class="align-middle"> {{ $abs->date }} </td>
                    <td class="align-middle">
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
            @php
                if ($i == 0)
                    print '<tr><td colspan="6"><h3 class="text-center"> Aucun absent dans ce module </h3></td></tr>';
            @endphp
            </tbody>
        </table>
    </div>

@endsection
