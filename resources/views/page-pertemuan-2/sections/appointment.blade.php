@extends('page-pertemuan-2.layout.base')

@section('title', 'CRUD Appointments')

@section('content')
    <div class="flex justify-end items-center mb-5">
        <button id='addButton' class="bg-[#229799] px-4 py-[0.4rem] rounded-full items-center text-white">
            Add New
        </button>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">
                <tr>
                    @foreach ($columns as $column)
                        <th scope="col" class="px-4 py-2">
                            {{ ucfirst(str_replace('_', ' ', $column)) }}
                        </th>
                    @endforeach
                    <th scope="col" class="px-4 py-2">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody id="myTable" class="text-center">
                @foreach ($appointments as $appointment)
                    <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200">
                        @foreach ($columns as $column)
                            <td class="px-4 py-2 whitespace-nowrap">
                                {{ $appointment->$column }}
                            </td>
                        @endforeach
                        <td class="flex gap-3 px-4 py-2 justify-center">
                            <a href="{{ route('appointment.edit', $appointment->appointment_id) }}"
                                class="font-medium text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('appointment.delete', $appointment->appointment_id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this appointment with ID: {{ $appointment->appointment_id }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-blue-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $appointments->onEachSide(1)->links() }}
    </div>

    <div id="appointment_modal" class="fixed flex inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="p-10 bg-white rounded-lg shadow-lg max-w-3xl w-full">
            <form action="{{ route('appointment.add') }}" method="POST">
                @csrf
                <div class="relative z-0 w-full mb-5 group">
                    <input id="patient_id" type="text" name="patient_id" autocomplete="off"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                        placeholder="" required>
                    <label for="patient_id"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Patient
                        ID</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input id="date" type="date" name="date" autocomplete="off"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                        placeholder="" required>
                    <label for="date"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Tanggal</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input id="time" type="time" name="time" autocomplete="off"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                        placeholder="" required>
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
                                    {{ $service->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="close_modal"
                        class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-0 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Close</button>
                    <button type="submit"
                        class="text-white bg-[#229799] hover:bg-[#317375] focus:ring-0 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('appointment_modal');
            const closeModalButton = document.getElementById('close_modal');
            const addButton = document.getElementById('addButton');

            // Function to open the modal
            function openModal() {
                modal.classList.remove('hidden');
            }

            // Function to close the modal
            function closeModal() {
                modal.classList.add('hidden');
            }

            // Event listener for the close button
            closeModalButton.addEventListener('click', closeModal);
            addButton.addEventListener('click', openModal);
        });
    </script>
@endsection
