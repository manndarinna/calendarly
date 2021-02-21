@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ovde cete imati uvid u casove koje ste rezervisali.</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>Naziv</th>
                                <th>Datum</th>
                                <th>Trajanje</th>
                                <th>Zakazao</th>
                                <th>Akcija</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
