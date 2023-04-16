@extends('layouts.app')

@section('css')

<style>
.pengumpulan-ppt{
    height: 90vh;
}
.card{
    background-color:rgba(255,255,255,0.95);
    border: 0px;
}
</style>

@endsection

@section('content')
    <main>
        <div class="container pengumpulan-ppt">
            <div class="card">
                <div class="card-body">
                    <p>Silahkan melakukan pengumpulan file pada form berikut:</p>
                    <form action="{{ route('uploadppt') }}" class="dropzone"></form>
                    <sub>Format file yang diterima: .ppt, .pptx</sub>
                </div>
            </div>
            
        </div>
    </main>

    <script>
        let CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        Dropzone.autoDiscover = false;
        let myDropzone = new Dropzone(".dropzone", {
            acceptedFiles: ".ppt,.pptx,.png"
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
