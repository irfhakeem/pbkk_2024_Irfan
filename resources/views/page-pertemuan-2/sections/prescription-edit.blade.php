@extends ('page-pertemuan-2.layout.base')

@section('title', 'Edit Medical Report')

@section('content')

    <div class="py-10 bg-white w-full">
        <form action="{{ route('prescription.update', $prescription->prescription_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="patient_id" id="patient_id" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder=" " value="{{ $prescription->patient_id }}" required />
                <label for="patient_id"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    ID Pasien</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="penyakit" id="penyakit" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder=" " value="{{ $prescription->penyakit }}" required />
                <label for="penyakit"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Penyakit</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="date" name="date" id="date" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder=" " value="{{ $prescription->date }}" required />
                <label for="date"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Tanggal Resep</label>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <label for="dokter" class="block mb-2 text-sm text-gray-500">Dokter</label>
                <input type="text" id="dokter" name="dokter" value="{{ $prescription->dokter }}" readonly
                    class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <textarea name="instruksi" id="instruksi" autocomplete="off"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder=" " required style="height: 100px; resize: none;">{{ $prescription->instruksi }}</textarea>
                <label for="instruksi"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Instruksi</label>
            </div>
            <div class="flex justify-end">
                <a type="button" id="close_modal" href="{{ route('prescription') }}"
                    class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-0 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Close</a>
                <button type="submit"
                    class="text-white bg-[#229799] hover:bg-[#317375] focus:ring-0 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
            </div>
        </form>
    </div>
@endsection
