@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <main>
        <div>
            <form action="{{ route('uploadppt') }}" class="dropzone"></form>
        </div>
    </main>

    <script>
        let CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        Dropzone.autoDiscover = false;
        let myDropzone = new Dropzone(".dropzone", {
            acceptedFiles: ".ppt,.pptx"
        })

        myDropzone.on("sending", function(file, xhr, formData) {
            formData.append("_token", CSRF_TOKEN)
        })

        myDropzone.on("success", function(file, response) {
            if (response.data.status == "error") {
                alert(response.data.msg)
            } else if (response.data.status == "success") {
                alert(response.data.msg)
            }
        })
    </script>
@endsection
