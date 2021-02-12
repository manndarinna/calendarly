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
                        <form method="post" action={{ 'http://127.0.0.1:8000/privatan-cas/' }}>
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    Naziv:
                                    <br>
                                    <input col="col" type="text" name="naziv" placeholder="Cas iz matematike" id="">
                                </div>
                                <div class="col-4">
                                    Datum:
                                    <br>
                                    <input col="col" type="date" name="datum" id="">
                                </div>
                                <div class="col-2">
                                    Sati:
                                    <br>
                                    <input type="number" min="0" max="59" name="sati" id="">
                                </div>
                                <div class="col-2">
                                    Minuti:
                                    <br>
                                    <input type="number" min="0" max="59" name="minuti" id="">
                                </div>

                            </div>
                            <br>
                            <input class="btn dodaj btn-block" type="submit" value="Dodaj cas!">
                        </form>
                        <br>


                        <table class="table ">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Naziv</th>
                                    <th>Datum</th>
                                    <th>Trajanje</th>
                                    <th>Rezervisao</th>
                                    <th>Akcija</th>
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
                                            {{ $c->rezervisao_id ? $c->rezervisao->name : 'nije rezervisan' }}
                                        </td>
                                        <td>
                                            <form method="post" action="{{ url('privatan-cas/' . $c->id) }}">
                                                @csrf
                                                @method('delete')
                                                <input class="btn izbrisi" type="submit" value="Izbrisi">
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
