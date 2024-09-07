@extends('layout.base')

@section('title', 'Named Routing')

@section('content')
    <div class="flex flex-col gap-3">
        <h5 class="card-title">Preview URL : <span id="preview-1"></span></h5>
        <form id="form1" method="GET" action="">
            <div class="form-group">
                <label for="param1">Parameter 1:</label>
                <input class="border-[1px] border-black form-control" type="text" id="param1" name="param1"
                    placeholder="Enter parameter 1" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form1 = document.getElementById('form1');
            const param1Input = document.getElementById('param1');
            const preview1Span = document.getElementById('preview-1');

            console.log("Testing")
            console.log(param1Input.value)

            function updatePreview1() {
                const param1 = encodeURIComponent(param1Input.value);
                const previewUrl1 = `{{ url('pertemuan1/named') }}/${param1}`;
                preview1Span.textContent = previewUrl1;
            }

            form1.addEventListener('submit', function(e) {
                e.preventDefault();
                const param1 = encodeURIComponent(param1Input.value);
                const url = `{{ url('pertemuan1/named') }}/${param1}`;
                window.location.href = url;
            });

            updatePreview1();
        });
    </script>
@endsection
