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

                        <table class="table table-warning">
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
                                                <input class="btn btn-block btn-danger" type="submit" value="Izbrisi">
                                            </form>
                                            <a class="btn btn-block btn-secondary"
                                                href="{{ url('konsultacija/' . $k->id) }}">Pregled</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $konsultacije->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
