@extends('page-pertemuan-2.layout.base')

@section('title', 'Dashboard')

@php
    $age = date_diff(date_create($patient->tanggal_lahir), date_create('now'))->y;
@endphp

@section('content')
    <div class="flex flex-col justify-between gap-28">
        {{-- Card Bio --}}
        <div class="flex gap-10 items-center">
            <img src="https://matafoto.co/wp-content/uploads/2021/03/merah-min.jpg" alt=""
                class="rounded-full w-28 h-28 object-cover">
            <div class="flex flex-col gap-3">
                <p class="text-[#229799] font-semibold text-4xl">{{ $patient->name }}</p>
                <div class="flex flex-col text-sm gap-1">
                    <div class="flex gap-5">
                        <p>Date of Birth: <span class="text-[#229799]">{{ $patient->tanggal_lahir }}</span></p>
                        <p>Age: <span class="text-[#229799]">{{ $age }}</span></p>
                    </div>
                    <p>Email: <span class="text-[#229799]">{{ $patient->email }}</span></p>
                    <p>Phone Number: <span class="text-[#229799]">{{ $patient->no_hp }}</span></p>
                    <p>Blood Type: <span class="text-[#229799]">{{ $patient->Golongan_darah }}</span></p>
                    <p>Gender: <span class="text-[#229799]">{{ $patient->jenis_kelamin }}</span></p>
                </div>
            </div>
        </div>

        <div class="flex flex-row">

            {{-- <p class="bg-white px-8 py-4">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias porro, tenetur
                placeat non quis corporis exercitationem voluptates aperiam debitis consequuntur vero iure, unde numquam
                saepe doloribus cum sunt aspernatur tempora.</p> --}}

        </div>

        {{-- Card Informations --}}
        <div class="bg-[#22979940] px-8 py-4 flex gap-10 items-center rounded-xl shadow-md">
            <div class="max-w-sm mx-auto">
                <p class="text-lg font-semibold">Information</p>
                <p class="text-sm text-justify">Here's some information statistics about You. Total Medical Reports,
                    Appointments, and Prescriptions. Click the card for more information</p>
                </p>
            </div>
            <div class="flex flex-col items-center">
                <div class="absolute w-11 h-11 bg-[#229799] rounded-full"></div>
                <div
                    class="px-4 pb-4 pt-6 bg-white rounded-xl h-40 mt-7 items-center flex flex-col gap-3 border-[1px] border-gray-300 w-48">
                    <p> Medical Reports</p>
                    <p class="text-5xl font-medium text-gray-300">{{ $medicalReports }}</p>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <div class="absolute w-11 h-11 bg-[#229799] rounded-full"></div>
                <div
                    class="px-4 pb-4 pt-6 bg-white rounded-xl h-40 mt-7 items-center flex flex-col gap-3 border-[1px] border-gray-300 w-48">
                    <p> Prescriptions </p>
                    <p class="text-5xl font-medium text-gray-300"> {{ $prescriptions }} </p>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <div class="absolute w-11 h-11 bg-[#229799] rounded-full"></div>
                <div
                    class="px-4 pb-4 pt-6 bg-white rounded-xl h-40 mt-7 items-center flex flex-col gap-3 border-[1px] border-gray-300 w-48">
                    <p> Appointments </p>
                    <p class="text-5xl font-medium text-gray-300"> {{ $appointments }} </p>
                </div>
            </div>
        </div>
    </div>
@endsection
