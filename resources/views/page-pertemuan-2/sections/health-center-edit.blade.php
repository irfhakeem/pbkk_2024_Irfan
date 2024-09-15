@extends ('page-pertemuan-2.layout.base')

@section('title', 'Edit Health Center')

@section('content')

    <div class="py-10 bg-white w-full">
        <form action="{{ route('healthCenter.update', $healthCenter->health_center_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="nama" id="nama"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder=" " value="{{ $healthCenter->nama }}" required />
                <label for="nama"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Nama Fasilitas Kesehatan</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="alamat" id="alamat"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                    placeholder=" " value="{{ $healthCenter->alamat }}" required />
                <label for="alamat"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Alamat Fasilitas Kesehatan</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <label for="service_id" class="block mb-2 text-sm text-gray-500">Service</label>
                <div class="bg-white text-gray-500 text-sm focus:outline-none focus:ring-0 block w-full">
                    <div class="grid grid-cols-3 ">
                        @foreach ($services as $service)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="service_id" name="service_id[]"
                                    value="{{ $service->service_id }}" class="mr-2"
                                    @if (in_array($service->service_id, $healthCenterServices)) checked @endif>
                                <label for="service_id">{{ $service->nama }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="email" id="email"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                        placeholder=" " value="{{ $healthCenter->email }}" required />
                    <label for="email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Email</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" pattern="^08[0-9]{8,13}$" name="no_telp" id="no_telp"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#229799] peer"
                        placeholder=" " value="{{ $healthCenter->no_telp }}" required />
                    <label for="no_telp"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[#229799]  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Nomor Telephone</label>
                </div>
            </div>
            <div class="flex justify-end">
                <a type="button" id="close_modal" href="{{ route('healthCenter') }}"
                    class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-0 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Close</a>
                <button type="submit"
                    class="text-white bg-[#229799] hover:bg-[#317375] focus:ring-0 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save</button>
            </div>
        </form>
    </div>
@endsection
