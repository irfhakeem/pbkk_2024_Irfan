@extends('page-pertemuan-2.layout.base')

@section('title', 'Edit Doctor')

@section('content')
    <div class="py-10 bg-white w-full">
        <form action="{{ route('doctor.update', $doctor->doctor_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="relative z-0 w-full mb-5 group">
                <input type="sip" name="sip" id="sip" pattern="[0-9]{9}" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder=" " value="{{ $doctor->sip }}" required />
                <label for="sip"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    SIP</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="nama" name="nama" id="nama" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder=" " value="{{ $doctor->nama }}" required />
                <label for="nama"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama
                    Lengkap</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input id="tanggal_lahir" type="date" name="tanggal_lahir" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder="" value="{{ $doctor->tanggal_lahir }}" required>
                <label for="tanggal_lahir"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Tanggal Lahir</label>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="email" name="email" id="email" autocomplete="off"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                        placeholder=" " value="{{ $doctor->email }}" required />
                    <label for="email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Email</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="no_hp" pattern="^08[0-9]{8,13}$" name="no_hp" id="no_hp" autocomplete="off"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                        placeholder=" " value="{{ $doctor->no_hp }}" required />
                    <label for="no_hp"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Nomor HP</label>
                </div>
            </div>
            <div class="grid md:grid-cols-3 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <label for="jenis_kelamin" class="block mb-2 text-sm text-gray-500">Jenis Kelamin
                    </label>
                    <select id="jenis_kelamin" name="jenis_kelamin" autocomplete="off" value="{{ $doctor->jenis_kelamin }}"
                        class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                        <option value="L" {{ $doctor->jenis_kelamin == 'L' ? 'selected' : '' }}>L</option>
                        <option value="P" {{ $doctor->jenis_kelamin == 'P' ? 'selected' : '' }}>P</option>
                    </select>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="spesialis_id" class="block mb-2 text-sm text-gray-500">Spesialis ID</label>
                    <select id="spesialis_id" name="spesialis_id" autocomplete="off" required
                        class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                        @foreach ($specializations as $specialization)
                            <option value="{{ $specialization->spesialis_id }}"
                                {{ $specialization->spesialis_id == $doctor->spesialis_id ? 'selected' : '' }}>
                                {{ $specialization->spesialisasi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="health_center_id" class="block mb-2 text-sm text-gray-500">Health Center ID</label>
                    <select id="health_center_id" name="health_center_id" autocomplete="off" required
                        class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                        @foreach ($healthCenters as $healthCenter)
                            <option value="{{ $healthCenter->health_center_id }}"
                                {{ $healthCenter->health_center_id == $doctor->health_center_id ? 'selected' : '' }}>
                                {{ $healthCenter->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex justify-end">
                <a href="{{ route('doctor') }}" type="button" id="close_modal"
                    class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-0 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Close</a>
                <button type="submit"
                    class="text-white bg-[#229799] hover:bg-[#317375] focus:ring-0 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
            </div>
        </form>
    </div>

@endsection
