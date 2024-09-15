@extends('page-pertemuan-2.layout.base')

@section('title', 'Doctors')

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
                @foreach ($doctors as $doctor)
                    <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200">
                        @foreach ($columns as $column)
                            <td class="px-4 py-2 whitespace-nowrap">
                                {{ $doctor->$column }}
                            </td>
                        @endforeach
                        <td class="flex gap-3 px-4 py-2 justify-center">
                            <a href="{{ route('doctor.edit', $doctor->doctor_id) }}"
                                class="font-medium text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('doctor.delete', $doctor->doctor_id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this doctor with ID: {{ $doctor->doctor_id }}?');">
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
        {{ $doctors->onEachSide(1)->links() }}
    </div>

    <div id="doctor_modal" class="fixed flex inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="p-10 bg-white rounded-lg shadow-lg max-w-3xl w-full">
            <form action="{{ route('doctor.add') }}" method="POST">
                @csrf
                <div class="relative z-0 w-full mb-5 group">
                    <input type="sip" name="sip" id="sip" pattern="[0-9]{9}" autocomplete="off"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                        placeholder=" " required />
                    <label for="sip"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        SIP</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="nama" id="nama" autocomplete="off"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                        placeholder=" " required />
                    <label for="nama"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama
                        Lengkap</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input id="tanggal_lahir" type="date" name="tanggal_lahir" autocomplete="off"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                        placeholder="" required>
                    <label for="tanggal_lahir"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Tanggal Lahir</label>
                </div>

                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="email" name="email" id="email" autocomplete="off"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                            placeholder=" " required />
                        <label for="email"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Email</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="no_hp" pattern="^08[0-9]{8,13}$" name="no_hp" id="no_hp" autocomplete="off"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                            placeholder=" " required />
                        <label for="no_hp"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Nomor HP</label>
                    </div>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="jenis_kelamin" class="block mb-2 text-sm text-gray-500">Jenis Kelamin
                        </label>
                        <select id="jenis_kelamin" name="jenis_kelamin" autocomplete="off"
                            class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                            <option>L</option>
                            <option>P</option>

                        </select>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="spesialis_id" class="block mb-2 text-sm text-gray-500">Spesialis ID</label>
                        <select id="spesialis_id" name="spesialis_id" autocomplete="off" required
                            class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                            @foreach ($specializations as $specialization)
                                <option value="{{ $specialization->spesialis_id }}">{{ $specialization->spesialisasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="health_center_id" class="block mb-2 text-sm text-gray-500">Health Center ID</label>
                        <select id="health_center_id" name="health_center_id" autocomplete="off" required
                            class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                            @foreach ($healthCenters as $healthCenter)
                                <option value="{{ $healthCenter->health_center_id }}">{{ $healthCenter->nama }}
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
            const modal = document.getElementById('doctor_modal');
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
