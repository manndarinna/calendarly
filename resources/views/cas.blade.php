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
                        <div class="row">
                            <div class="col">
                                Naziv:
                                <input class="form-control" disabled value="{{ $cas->naziv }}" type="text">
                            </div>
                            <div class="col">
                                Datum:
                                <input class="form-control" disabled value="{{ $cas->datum }}" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Trajanje:
                                <input class="form-control" disabled
                                    value="{{ strval(intval($cas->trajanje / 3600)) }}:{{ strval(intval($cas->trajanje / 60) % 60) }}"
                                    type="text">
                            </div>
                            <div class="col">
                                Rezervisan:
                                <input class="form-control" disabled
                                    value="{{ $cas->rezervisao_id == Auth::id() ? 'Vi ste rezervisali' : ($cas->rezervisao_id ? 'Rezervisan' : 'Nije rezervisan') }}"
                                    type="text">
                            </div>
                        </div>
                        <a href="{{ $cas->prilozeniDokument ? asset('/storage/' . $cas->prilozeniDokument . '') : '' }}"
                            download>Preuzmite materijale</a>
                        <a href={{ 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=http://127.0.0.1:8000/cas/' . $cas->id }}
                            class="slikaLink">Pogledajte QR Kod</a>
                        <br>
                        <form method="post" class="rezervisiCasForm">
                            <input type="number" hidden class="idCasa" value="{{ $cas->id }}">
                            <input class="btn rezervisi" {{ $cas->rezervisao_id > 0 ? 'disabled' : '' }} type="submit"
                                value="Rezervisi">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
