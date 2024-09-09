@extends('page-pertemuan-2.layout.base')

@section('title', 'CRUD Medical Reports')

@section('content')
    <div class="flex justify-end items-center mb-5">
        <button id="addButton" class="bg-[#229799] px-4 py-[0.4rem] rounded-full items-center text-white hover:bg-[#317375]">
            Add New
        </button>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">
                <tr>
                    @foreach ($columns as $column)
                        <th scope="col" class="px-1 py-2 text-[12px]">
                            @if (str_contains($column, 'id'))
                                {{ ucfirst(str_replace('_', ' ', substr($column, 0, -3))) }}
                            @else
                                {{ ucfirst(str_replace('_', ' ', $column)) }}
                            @endif
                        </th>
                    @endforeach
                    <th scope="col" class="py-2 text-xs">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody id="myTable" class="text-center">
                @foreach ($medicalReports as $medicalReport)
                    <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200">
                        @foreach ($columns as $column)
                            <td class="py-2 whitespace-nowrap text-[12px]">
                                {{ $medicalReport->$column }}
                            </td>
                        @endforeach
                        <td class="flex py-2 gap-3  justify-center items-center">
                            <a href="{{ route('medicalReport.edit', $medicalReport->medical_report_id) }}"
                                class="text-[11px] font-medium text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('medicalReport.delete', $medicalReport->medical_report_id) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this medicalReport with ID: {{ $medicalReport->medical_report_id }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-[11px] font-medium text-blue-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $medicalReports->onEachSide(1)->links() }}
    </div>

    <div id="mr_modal" class="fixed flex inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="p-10 bg-white rounded-lg shadow-lg max-w-3xl w-full">
            <form action="{{ route('medicalReport.add') }}" method="POST">
                @csrf
                <div class="relative z-0 w-full mb-5 group">
                    <input type="patient_id" name="patient_id" id="patient_id" autocomplete="off"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                        placeholder=" " required />
                    <label for="patient_id"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        ID Pasien</label>
                </div>

                {{-- <div class="relative z-0 w-full mb-5 group">
                    <input datepicker id="date" type="text" name="date" autocomplete="off"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                        placeholder="" required>
                    <label for="date"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Tanggal Periksa</label>
                </div> --}}

                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="dokter" class="block mb-2 text-sm text-gray-500">Dokter</label>
                        <select id="dokter" name="dokter" autocomplete="off" required
                            class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                            @foreach ($doctors as $doctor)
                                <option>
                                    {{ $doctor->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="status" class="block mb-2 text-sm text-gray-500">Status</label>
                        <select id="status" name="status" autocomplete="off" required
                            class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                            <option>Selesai</option>
                            <option>Belum Selesai</option>
                        </select>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="faskes" class="block mb-2 text-sm text-gray-500">Fasilitas Kesehatan </label>
                        <select id="faskes" name="faskes" autocomplete="off"
                            class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                            @foreach ($healthCenters as $healthCenter)
                                <option>
                                    {{ $healthCenter->nama }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="service" class="block mb-2 text-sm text-gray-500">Service
                        </label>
                        <select id="service" name="service" autocomplete="off"
                            class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                            @foreach ($services as $service)
                                <option>
                                    {{ $service->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <textarea name="diagnosis" id="diagnosis" autocomplete="off"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                        placeholder=" " required style="height: 100px; resize: none;"></textarea>
                    <label for="diagnosis"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Diagnosis</label>
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
