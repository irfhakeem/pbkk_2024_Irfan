@extends('layout.base')

@section('title', 'Basic Routing')

@section('content')
    <div class="flex flex-col gap-3">
        <p>Contoh basic Rounting get untuk menuju "/"</p>
        <a href="/" class="bg-black px-5 py-2 rounded-lg text-white w-[15%] text-center">
            Return Home
        </a>
        <p>Bentuk route yang digunakan : <br>
            {`Route::get('/', function () {
            return view('pertemuan1.basic');
            });`}
            <br>
        </p>
    </div>
@endsection
