@extends('page-pertemuan-2.layout.base')

@section('title', 'Doctor Dashboard')

@section('content')
    <div>
        <div>
            <p class="text-5xl font-medium">Welcome, {{ Auth::user()->name }} <br> <span
                    class="text-3xl text-[#229799]">{{ $spesialis }}</span></p>
        </div>

        {{-- <div>
            <p> {{ $appointments->count() }}
            </p>
        </div> --}}
    </div>

@endsection
