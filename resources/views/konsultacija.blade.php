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
                            <h4>Prijavljeni korisnici:</h4>
                            <table class="table ">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Ime</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ucesnici as $i => $u)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $u->name }}</td>
                                            <td>{{ $u->email }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <form class="prikljuciSeKonsultacijiForm">
                            @csrf
                            <input type="number" class="idKonsultacije" hidden value="{{ $konsultacija->id }}">
                            <input class="btn rezervisi "
                                {{ $konsultacija->broj_prijava == $konsultacija->max_prijava ? 'disabled' : '' }}
                                type="submit" value="Prijavi se">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
