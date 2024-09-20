@extends('page-pertemuan-2.layout.base')

@section('title', 'Prescriptions')

@section('content')
    <div class="grid grid-cols-2">
        <div>
            @foreach ($prescriptions as $prescription)
                <div
                    class="flex flex-col bg-[#22979940] px-8 py-4 rounded-3xl shadow-lg mb-2 justify-center items-start gap-5">
                    <div>
                        <p>{{ $prescription->penyakit }}</p>
                    </div>
                    <button class="more-detail-btn text-sm bg-white px-3 py-1 rounded-xl"
                        data-id="{{ $prescription->prescription_id }}">More
                        Detail</button>
                </div>
            @endforeach

            <div class="mt-3">
                {{ $prescriptions->onEachSide(1)->links() }}
            </div>
        </div>

        <div class="flex items-start justify-center w-full mx-5">
            <div id="detail-placeholder" class="text-gray-300">
                Detail will be shown here.
            </div>
            <div id="detail-container" class="bg-[#22979940] px-8 py-4 rounded-3xl shadow-lg hidden">
                @php
                    $details = [
                        ['tag' => 'Penyakit', 'id' => 'detail-penyakit'],
                        ['tag' => 'Dokter', 'id' => 'detail-doctor'],
                        ['tag' => 'Instruksi', 'id' => 'detail-instruksi'],
                        ['tag' => 'Tanggal', 'id' => 'detail-tanggal'],
                    ];
                @endphp

                @foreach ($details as $detail)
                    <div class="mb-3">
                        <p class="text-xs">{{ $detail['tag'] }} </p>
                        <p class="font-medium" id="{{ $detail['id'] }}"></p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.more-detail-btn');
            const detailContainer = document.getElementById('detail-container');
            const detailPlaceholder = document.getElementById('detail-placeholder');
            const detailPenyakit = document.getElementById('detail-penyakit');
            const detailDoctor = document.getElementById('detail-doctor');
            const detailInstruksi = document.getElementById('detail-instruksi');
            const detailTanggal = document.getElementById('detail-tanggal');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const reportId = this.getAttribute('data-id');
                    console.log(reportId);
                    const prescription = (@json($prescriptions).data);
                    console.log(prescription);
                    const report = prescription.find(report => report.prescription_id ==
                        reportId);
                    console.log(report);

                    if (report) {
                        detailPenyakit.textContent = report.penyakit;
                        detailDoctor.textContent = report.dokter;
                        detailInstruksi.textContent = report.instruksi;
                        detailTanggal.textContent = report.date;

                        detailPlaceholder.classList.add('hidden');
                        detailContainer.classList.remove('hidden');
                    }
                });
            });
        });
    </script>

@endsection
