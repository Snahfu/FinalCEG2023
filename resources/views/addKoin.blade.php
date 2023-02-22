@extends('layouts.app')

@section('css')
    <style></style>
@endsection

@section('content')
    <main>
        <div>
            Nama Team :
            <select name="team" id="team">
                <option value="-" selected disabled>-- Pilih Team --</option>
                @foreach ($teams as $team)
                    <option value="{{ $team->idteams }}">{{ $team->namaTeam }}</option>
                @endforeach
            </select>

            Koin :
            <input id="jumlahKoin" type="text" inputmode="numeric" name="koin" id="koin">

            <button id="btnAddKoin" class="btn-btn-primary">Add</button>
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
        $("#btnAddKoin").click(function() {
            $.ajax({
                type: "POST",
                url: "{{ route('addKoin') }}",
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'idteam': $("#team").val(),
                    'jumlahKoin': $("#jumlahKoin").val(),
                },
                success: function(data) {
                    $("#alert-warning").html(data.msg)
                    $("#ModalAlert").modal("show")
                },
                error: function() {
                    alert("error")
                }
            })
        })
    </script>
@endsection
