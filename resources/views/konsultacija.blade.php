@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pregled konsultacije {{ $konsultacija->naziv }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div>
                            <h4>Opis:</h4>
                            <p>{{ $konsultacija->opis }}</p>
                        </div>
                        <div>
                            <h4>Datum:</h4>
                            <p>{{ $konsultacija->datum }}</p>
                        </div>
                        <div>
                            <h4>Prijavljeni korisnici::</h4>
                            <p>{{ $konsultacija->datum }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
