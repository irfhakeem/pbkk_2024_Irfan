@extends('layout.base')

@section('title', 'Named Routing')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Hasil</h5>
        </div>
        <div class="card-body">
            <div>URL : {{ url()->current() }}</div>
            <div> Parameter : {{ $data['namedParam'] }}</div>
        </div>
        <div class="card-footer">
            <a href="{{ url('pertemuan1/named') }}">
                <button class="btn btn-primary">Kembali</button>
            </a>
        </div>
    </div>
@endsection
