@extends('page-pertemuan-2.layout.base')

@section('title', 'Edit Patients')

@section('content')
    <div class="py-10 bg-white w-full">
        <form action="{{ route('pasien.update', $patient->patient_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="relative z-0 w-full mb-5 group">
                <input type="nik" name="nik" id="nik" pattern="[0-9]{8}" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder=" " value="{{ $patient->nik }}" required />
                <label for="nik"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    NIK</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="name" name="name" id="name" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder=" " value="{{ $patient->name }}" required />
                <label for="name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama
                    Lengkap</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input datepicker id="tanggal_lahir" type="text" name="tanggal_lahir" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder="" value="{{ $patient->tanggal_lahir }}" required>
                <label for="tanggal_lahir"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Tanggal Lahir</label>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="email" name="email" id="email" autocomplete="off"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                        placeholder=" " value="{{ $patient->email }}" required />
                    <label for="email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Email</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="no_hp" pattern="^08[0-9]{8,13}$" name="no_hp" id="no_hp" autocomplete="off"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                        placeholder=" " value="{{ $patient->no_hp }}" required />
                    <label for="no_hp"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Nomor HP</label>
                </div>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <label for="jenis_kelamin" class="block mb-2 text-sm text-gray-500">Jenis Kelamin
                    </label>
                    <select id="jenis_kelamin" name="jenis_kelamin" value="{{ $patient->jenis_kelamin }}"
                        class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                        <option>L</option>
                        <option>P</option>

                    </select>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="Golongan_darah" class="block mb-2 text-sm text-gray-500">Golongan Darah</label>
                    <select id="Golongan_darah" name="Golongan_darah" value="{{ $patient->Golongan_darah }}"
                        class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                        <option>A</option>
                        <option>B</option>
                        <option>AB</option>
                        <option>O</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end">
                <a type="button" id="close_modal" href="{{ route('pasien') }}"
                    class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-0 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Close</a>
                <button type="submit"
                    class="text-white bg-[#229799] hover:bg-[#317375] focus:ring-0 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save</button>
            </div>
        </form>
    </div>
@endsection
