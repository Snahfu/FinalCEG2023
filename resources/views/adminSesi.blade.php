@extends('layouts.app')

@section('css')
    <style>
        .sesiContainer {
            display: flex;
            flex-direction: column;
        }
    </style>
@endsection

@section('content')
    <main>
        <div class="sesiContainer">
            <h2>Sesi <span id="sesiNow">{{ $sesi[0]->sesi }}</span></h2>
            <div class="d-flex mb-2">
                <button id="back" class="btn btn-primary btnSesi"><i class="fa-solid fa-chevron-left"></i></button>
                <button id="next" class="btn btn-primary btnSesi mx-2"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
            <div class="d-flex mb-2">
                <button id="biasa" class="btn btn-primary btnSesi" value="biasa">Biasa</button>
                <button id="flash" class="btn btn-primary btnSesi mx-2" value="flash sale">Flash Sale</button>
            </div>
        </div>
    </main>

    {{-- Modal Alert --}}
    <div class="modal fade" id="ModalAlert" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalAlertLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalAlertLabel">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="alert-body" class="modal-body flex">
                    <b id="alert-warning"></b>
                </div>
                <div class="modal-footer">
                    {{-- button OK --}}
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".btnSesi").click(function() {
            console.log($("#sesiNow").html())
            console.log($(this).attr("id"))
            $.ajax({
                type: "POST",
                url: "{{ route('gantiSesi') }}",
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'command': $(this).attr("id"),
                    'sesiNow': $("#sesiNow").html(),
                },
                success: function(data) {
                    $("#alert-warning").html(data.msg)
                    $("#ModalAlert").modal("show")

                    $("#sesiNow").html(data.data[0].sesi)
                },
                error: function() {
                    alert("error")
                }
            })
        })
    </script>
@endsection
