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

                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Naziv</th>
                                    <th style="width:45%">Opis</th>
                                    <th>Prijave</th>
                                    <th>Datum</th>
                                    <th>Akcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($konsultacije as $k)
                                    <tr>
                                        <td>{{ $k->naziv }}</td>
                                        <td style="word-break: break-all">{{ $k->opis }}</td>
                                        <td>{{ $k->broj_prijava }}/{{ $k->max_prijava }}</td>
                                        <td>{{ $k->datum }}</td>
                                        <td>
                                            <form method="post" action="{{ url('konsultacija/' . $k->id) }}">
                                                @csrf
                                                @method('delete')
                                                <input class="btn btn-block izbrisi" type="submit" value="Izbrisi">
                                            </form>
                                            <a class="btn btn-block pregledaj"
                                                href="{{ url('konsultacija/' . $k->id) }}">Pregled</a>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
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

                                </tr>
                                <br>
                            </tbody>
                        </table>
                        {{ $konsultacije->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
