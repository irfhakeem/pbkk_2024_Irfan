@php
    $email = Auth::user()->email;
    $doctor = App\Models\Doctor::where('email', $email)->first();
@endphp

@extends('page-pertemuan-2.layout.base')

@section('title', 'Prescriptions')

@section('content')
    <div class="flex justify-end items-center mb-5">
        @can('add prescriptions')
            <button id="addButton" class="bg-[#229799] px-4 py-[0.4rem] rounded-full items-center text-white">
                Add New
            </button>
        @endcan
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
                    @can('edit prescriptions')
                        <th scope="col" class="px-4 py-2">
                            Action
                        </th>
                    @endcan
                </tr>
            </thead>
            <tbody id="myTable" class="text-center">
                @foreach ($prescriptions as $prescription)
                    <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200">
                        @foreach ($columns as $column)
                            <td class="px-4 py-2 whitespace-nowrap">
                                {{ Str::limit($prescription->$column, 50, '...') }}
                            </td>
                        @endforeach
                        <td class="flex gap-3 px-4 py-2 justify-center items-center">
                            @can('edit prescriptions')
                                <a href="{{ route('prescription.edit', $prescription->prescription_id) }}"
                                    class="font-medium text-blue-600 hover:underline {{ Auth::user()->name != $prescription->dokter ? 'pointer-events-none text-gray-400' : '' }}">
                                    Edit
                                </a>
                            @endcan
                            @can('delete prescriptions')
                                <form action="{{ route('prescription.delete', $prescription->prescription_id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this prescription with ID: {{ $prescription->prescription_id }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-blue-600 hover:underline">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $prescriptions->onEachSide(1)->links() }}
    </div>

    @can('add prescriptions')
        <div id="mr_modal" class="fixed flex inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
            <div class="p-10 bg-white rounded-lg shadow-lg max-w-3xl w-full">
                <form action="{{ route('prescription.add') }}" method="POST">
                    @csrf
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="patient_id" id="patient_id" autocomplete="off"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                            placeholder=" " required />
                        <label for="patient_id"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            ID Pasien</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="penyakit" id="penyakit" autocomplete="off"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                            placeholder=" " required />
                        <label for="penyakit"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Penyakit</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="date" name="date" id="date" autocomplete="off"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                            placeholder=" " required />
                        <label for="date"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Tanggal Resep</label>
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <label for="dokter" class="block mb-2 text-sm text-gray-500">Dokter</label>
                        <input type="text" id="dokter" name="dokter" value="{{ Auth::user()->name }}" readonly
                            class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <label for="drug_id" class="block mb-2 text-sm text-gray-500">Obat</label>
                        <div class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                            <div class="grid grid-cols-3">
                                @foreach ($drugs as $drug)
                                    <div class="flex items-center mb-2">
                                        <input type="checkbox" id="drug_{{ $drug->drug_id }}" name="drug_id[]"
                                            value="{{ $drug->drug_id }}" class="mr-2">
                                        <label for="drug_{{ $drug->drug_id }}">{{ $drug->nama }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <textarea name="instruksi" id="instruksi" autocomplete="off"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                            placeholder=" " required style="height: 100px; resize: none;"></textarea>
                        <label for="instruksi"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Instruksi</label>
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
    @endcan

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('mr_modal');
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
