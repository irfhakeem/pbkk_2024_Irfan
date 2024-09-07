@extends('layout.base')

@section('title', 'Fallback Routing')

@section('content')
    <div class="flex flex-col gap-3">
        <p>Fallback digunakan jika route yang diakses tidak ada akan di return berupa fallback dengan pesan tertentu.</p>
        <p>Klik button untuk melihat fallback bekerja.</p>

        {{-- Mengarahkan ke URL yang tidak ada untuk memicu fallback --}}
        <a href="/fallback" class="bg-black px-5 py-2 rounded-lg text-white w-[20%] text-center">
            Return Fallback
        </a>
    </div>
@endsection
