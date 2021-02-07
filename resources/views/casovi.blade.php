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
                                            <form method="post"
                                                action={{ 'http://127.0.0.1:8000/privatan-cas/' . $c->id }}>
                                                @csrf
                                                @method('put')
                                                <input class="btn btn-primary"
                                                    {{ $c->rezervisao_id > 0 ? 'disabled' : '' }} type="submit"
                                                    value="Rezervisi">
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
        </div>
    </div>
@endsection
