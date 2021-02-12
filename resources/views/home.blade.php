@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        Pregledajte ili dodajte cas na <br> <a class="btn btn-secondary"
                            href="{{ route('privatan-cas.index') }}"> Moji Casovi</a> <br>
                        Izvrsite uvid u Vase konsultacije na <br> <a class="btn btn-secondary"
                            href="{{ route('konsultacija.index') }}"> Moje konsultacije</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
