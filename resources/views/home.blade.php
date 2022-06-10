@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="align-content-lg-center p-4 bg-info">
                    <h3>You are a {{ Auth::user()->role }}</h3>
                    @if(Auth::user()->role == 'admin')
                        <a href="/etudiants/create" class="btn btn-light mx-1">Ajouter un étudiant</a>
                        <a href="/enseignants/create" class="btn btn-light mx-1">Ajouter un enseignant</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
