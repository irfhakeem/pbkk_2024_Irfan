@extends('layouts.base')

@section('title', 'Dashboard')

@section('content')
    <div>
        <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
        <p class="text-gray-500">Welcome back, {{ Auth::user()->name }}!</p>
    </div>
@endsection
