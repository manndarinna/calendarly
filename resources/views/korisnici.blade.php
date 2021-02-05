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
                        <table class="table table-info">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Akcije</th>
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($korisnici as $k)
                                    <tr>
                                        <td>{{ $k->id }}</td>
                                        <td>{{ $k->name }}</td>
                                        <td>{{ $k->email }}</td>
                                        <td> <a href="{{ url('korisnik/' . $k->id) }}">Prikazi detaljno</a> </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        {{ $korisnici->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
