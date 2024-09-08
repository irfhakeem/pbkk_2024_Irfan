@extends('page-pertemuan-2.layout.base')

@section('title', 'Edit Appointment')

@section('content')
    <div class="py-10 bg-white w-full">
        <form action="{{ route('appointment.update', $appointment->appointment_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="relative z-0 w-full mb-5 group">
                <input id="patient_id" type="text" name="patient_id" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder="" value="{{ $appointment->patient_id }}" required>
                <label for="patient_id"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Patient
                    ID</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input id="date" type="date" name="date" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder="" value="{{ $appointment->date }}" required>
                <label for="date"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Tanggal</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input id="time" type="time" name="time" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder="" value="{{ $appointment->time }}" required>
                <label for="time"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Waktu</label>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <label for="doctor_id" class="block mb-2 text-sm text-gray-500">Dokter
                    </label>
                    <select id="doctor_id" name="doctor_id"
                        class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->doctor_id }}">
                                {{ $doctor->doctor_id == $appointment->doctor_id ? 'selected' : '' }}
                                {{ $doctor->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="health_center_id" class="block mb-2 text-sm text-gray-500">Fasilitas Kesehatan</label>
                    <select id="health_center_id" name="health_center_id"
                        class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                        @foreach ($healthCenters as $healthCenter)
                            <option value="{{ $healthCenter->health_center_id }}">
                                {{ $healthCenter->health_center_id == $appointment->health_center_id ? 'selected' : '' }}
                                {{ $healthCenter->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="service_id" class="block mb-2 text-sm text-gray-500">Service</label>
                    <select id="service_id" name="service_id"
                        class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                        @foreach ($services as $service)
                            <option value="{{ $service->service_id }}">
                                {{ $service->service_id == $appointment->service_id ? 'selected' : '' }}
                                {{ $service->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex justify-end">
                <a href="{{ route('appointment') }}" type="button" id="close_modal"
                    class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-0 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Close</a>
                <button type="submit"
                    class="text-white bg-[#229799] hover:bg-[#317375] focus:ring-0 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
            </div>
        </form>
    </div>
@endsection
