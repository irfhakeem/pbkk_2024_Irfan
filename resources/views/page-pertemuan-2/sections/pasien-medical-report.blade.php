@extends('page-pertemuan-2.layout.base')

@section('title', 'My Medical Report')

@section('content')
    <div class="grid grid-cols-2 gap-x-10">
        <div>
            @foreach ($medicalReports as $medicalReport)
                <div class="bg-white px-8 py-4 rounded-3xl shadow-lg">
                    {{ $medicalReport->diagnosis }}
                    <button class="more-detail-btn" data-id="{{ $medicalReport->medical_report_id }}">More Detail</button>
                </div>
            @endforeach
            <div class="mt-3">
                {{ $medicalReports->onEachSide(1)->links() }}
            </div>
        </div>

        <div class="flex items-center justify-center">
            <div id="detail-placeholder" class="text-gray-300">
                Detail will be shown here.
            </div>
            <div id="detail-container" class="bg-white px-8 py-4 rounded-3xl shadow-lg hidden">
                <p>Medical Report</p>
                <p>Diagnosis: <span id="detail-diagnosis"></span></p>
                <p>Doctor: <span id="detail-doctor"></span></p>
                <p>Created At: <span id="detail-created-at"></span></p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.more-detail-btn');
            const detailContainer = document.getElementById('detail-container');
            const detailPlaceholder = document.getElementById('detail-placeholder');
            const detailDiagnosis = document.getElementById('detail-diagnosis');
            const detailDoctor = document.getElementById('detail-doctor');
            const detailCreatedAt = document.getElementById('detail-created-at');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const reportId = this.getAttribute('data-id');
                    console.log(reportId);
                    const report = @json($medicalReports).find(report => report
                        .medical_report_id ==
                        reportId);
                    console.log(report);

                    if (report) {
                        detailDiagnosis.textContent = report.diagnosis;
                        detailDoctor.textContent = report.dokter;
                        detailCreatedAt.textContent = report.created_at;

                        detailPlaceholder.classList.add('hidden');
                        detailContainer.classList.remove('hidden');
                    }
                });
            });
        });
    </script>
@endsection
