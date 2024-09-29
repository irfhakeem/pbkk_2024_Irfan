@extends ('page-pertemuan-2.layout.base')

@section('title', 'Edit Medical Report')

@section('content')

    <div class="py-10 bg-white w-full">
        <form action="{{ route('medicalReport.update', $medicalReport->medical_report_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="relative z-0 w-full mb-5 group">
                <input type="judul" name="judul" id="judul" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder=" " value="{{ $medicalReport->judul }}" required />
                <label for="judul"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Judul Report</label>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <input type="patient_id" name="patient_id" id="patient_id" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder=" " value="{{ $medicalReport->patient_id }}" required />
                <label for="patient_id"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    ID Pasien</label>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <input id="date" type="date" name="date" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder="" value="{{ $medicalReport->date }}" readonly required>
                <label for="date"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Tanggal Periksa</label>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <label for="dokter" class="block mb-2 text-sm text-gray-500">Dokter</label>
                    <input type="text" id="dokter" name="dokter" value="{{ $doctor->nama }}" readonly
                        class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="status" class="block mb-2 text-sm text-gray-500">Status</label>
                    <select id="status" name="status" autocomplete="off" required
                        class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                        <option value="Selesai" {{ $medicalReport->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Belum Selesai" {{ $medicalReport->status == 'Belum Selesai' ? 'selected' : '' }}>
                            Belum Selesai</option>
                    </select>
                </div>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <label for="faskes" class="block mb-2 text-sm text-gray-500">Fasilitas Kesehatan</label>
                    <input type="text" id="faskes" name="faskes" value="{{ $healthCenter->name }}" readonly
                        class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="service" class="block mb-2 text-sm text-gray-500">Service</label>
                    <select id="service" name="service" autocomplete="off" required
                        class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                        <option value="" disabled selected>Pilih Service</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->nama }}"
                                {{ $service->nama == $medicalReport->service ? 'selected' : '' }}>
                                {{ $service->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <textarea name="diagnosis" id="diagnosis" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder=" " style="height: 100px; resize: none;" required>{{ $medicalReport->diagnosis }}</textarea>
                <label for="diagnosis"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Diagnosis</label>
            </div>
            <div class="flex justify-end">
                <a type="button" id="close_modal" href="{{ route('medicalReport') }}"
                    class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-0 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Close</a>
                <button type="submit"
                    class="text-white bg-[#229799] hover:bg-[#317375] focus:ring-0 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save</button>
            </div>
        </form>
    </div>
@endsection
