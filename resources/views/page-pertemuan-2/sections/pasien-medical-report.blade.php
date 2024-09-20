@extends('page-pertemuan-2.layout.base')

@section('title', 'My Medical Report')

@section('content')
    <div class="grid grid-cols-2">
        <div>
            @foreach ($medicalReports as $medicalReport)
                <div
                    class="flex flex-col bg-[#22979940] px-8 py-4 rounded-3xl shadow-lg mb-2 justify-center items-start gap-5">
                    <div>
                        <p>{{ $medicalReport->judul }}</p>
                    </div>
                    <button class="more-detail-btn text-sm bg-white px-3 py-1 rounded-xl"
                        data-id="{{ $medicalReport->medical_report_id }}">More
                        Detail</button>
                </div>
            @endforeach

            <div class="mt-3">
                {{ $medicalReports->onEachSide(1)->links() }}
            </div>
        </div>

        <div class="flex items-start justify-center mx-5">
            <div id="detail-placeholder" class="text-gray-300">
                Detail will be shown here.
            </div>
            <div id="detail-container" class="bg-[#22979940] px-8 py-4 rounded-3xl shadow-lg hidden">
                @php
                    $details = [
                        ['tag' => 'Judul', 'id' => 'detail-judul'],
                        ['tag' => 'Doctor', 'id' => 'detail-doctor'],
                        ['tag' => 'Fasilitas Kesehatan', 'id' => 'detail-faskes'],
                        ['tag' => 'Service', 'id' => 'detail-service'],
                        ['tag' => 'Tanggal', 'id' => 'detail-tanggal'],
                        ['tag' => 'Diagnosis', 'id' => 'detail-diagnosis'],
                        ['tag' => 'Status', 'id' => 'detail-status'],
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
            const detailJudul = document.getElementById('detail-judul');
            const detailDoctor = document.getElementById('detail-doctor');
            const detailFaskes = document.getElementById('detail-faskes');
            const detailService = document.getElementById('detail-service');
            const detailTanggal = document.getElementById('detail-tanggal');
            const detailDiagnosis = document.getElementById('detail-diagnosis');
            const detailStatus = document.getElementById('detail-status');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const reportId = this.getAttribute('data-id');
                    console.log(reportId);
                    const medicalReport = (@json($medicalReports).data);
                    console.log(medicalReport);
                    const report = medicalReport.find(report => report.medical_report_id ==
                        reportId);
                    console.log(report);

                    if (report) {
                        detailJudul.textContent = report.judul;
                        detailDoctor.textContent = report.dokter;
                        detailFaskes.textContent = report.faskes;
                        detailService.textContent = report.service;
                        detailTanggal.textContent = report.date;
                        detailDiagnosis.textContent = report.diagnosis;
                        detailStatus.textContent = report.status;

                        detailPlaceholder.classList.add('hidden');
                        detailContainer.classList.remove('hidden');
                    }
                });
            });
        });
    </script>
@endsection
