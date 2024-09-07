@extends('layout.base')

@section('title', 'Page Group')

@section('content')
    <div class="flex flex-col gap-3">
        <p>Ini adalah page di dalam group routing "testing-routing"</p>
        <a class="bg-black px-5 py-2 rounded-lg text-white w-[15%] text-center" href="{{ url('') }}">
            <button class="btn btn-primary">Kembali</button>
        </a>
    </div>
@endsection
