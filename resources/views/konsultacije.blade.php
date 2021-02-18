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

                        <form method="post" action={{ 'http://127.0.0.1:8000/konsultacija/' }}>
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    Naziv:
                                    <br>
                                    <input type="text" name="naziv" placeholder="Cas iz matematike" id="">
                                </div>
                                <div class="col-8">
                                    Opis:
                                    <br>
                                    <input type="text" name="opis" placeholder="Kratak opis konsultacije" id="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    Datum:
                                    <br>
                                    <input col="col" type="datetime-local" name="datum" id="">
                                </div>
                                <div class="col">
                                    Maximum pristalica:
                                    <br>
                                    <input type="number" min="0" max="59" name="max_pristalica" id="">
                                </div>
                                <input class="btn dodaj" type="submit" value="Dodaj konsultaciju!">
                            </div>

                        </form>
                        <div id="konsultacije"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
