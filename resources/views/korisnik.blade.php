@extends('layouts.app')

@section('content')

    <div class="card-header">Prikaz korisnika <b> {{ $korisnik->name }} ({{ $korisnik->email }})</b> </div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            <div class="col-6">
                <table class="table table-info">
                    <thead>
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
                                        <input class="btn btn-primary " disabled type="submit" value="Rezervisi">
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $konsultacije->links() }}
            </div>
            <div class="col-6">
                <table class="table table-info">
                    <thead>
                        <tr>
                            <th>Naziv</th>
                            <th>Datum</th>
                            <th>Trajanje</th>
                            <th>Akcije</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($casovi as $c)
                            <tr>
                                <td>{{ $c->naziv }}</td>
                                <td>{{ $c->datum }}</td>
                                <td>
                                    {{ strval(intval($c->trajanje / 3600)) }}:{{ strval(intval($c->trajanje / 60) % 60) }}
                                </td>
                                <td>
                                    <form method="post" action={{ 'http://127.0.0.1:8000/privatan-cas/' . $c->id }}>
                                        @csrf
                                        @method('put')
                                        <input class="btn btn-primary" {{ $c->rezervisao_id > 0 ? 'disabled' : '' }}
                                            type="submit" value="Rezervisi">
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $casovi->links() }}
            </div>
        </div>
    </div>

@endsection
