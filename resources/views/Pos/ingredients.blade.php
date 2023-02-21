@extends('layouts.app')

@section('css')
    <style>
        table,
        tr,
        th,
        td {
            border: 1px solid black;
        }

        @media (min-width: 426px) {
            #btnAdd {
                width: 10%;
            }
        }
    </style>
@endsection

@section('content')
    <main class="d-block mx-auto">
        <div class="container ingredient d-flex flex-column gap-3">
            <label for="teams">
                Team :
                <select name="teams" id="teams">
                    <option value="-" selected disabled>-- Pilih Team --</option>
                    @foreach ($teams as $team)
                        <option value="{{ $team->idteams }}">{{ $team->namaTeam }}</option>
                    @endforeach

                </select>

            </label>


            <label for="bahan">
                Bahan :
                <select name="bahan" id="bahan">
                    <option value="-" selected disabled>-- Pilih Bahan --</option>
                    @foreach ($bahan as $b)
                        <option value="{{ $b->nama_bahan }}">{{ $b->nama_bahan }}</option>
                    @endforeach

                </select>

            </label>

            <label for="jumlahAdd">
                Jumlah :
                <input type="text" inputmode="numeric" name="jumlahAdd" id="jumlahAdd" placeholder="0">

            </label>

            <button id="btnAdd" class="btn btn-primary">Add</button>

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

    {{-- Modal Confirm --}}
    <div class="modal fade" id="ModalConfirmation" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="ModalConfirmationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalConfirmationLabel">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body flex">
                    <b id="confirmation"></b>
                </div>
                <div class="modal-footer">
                    {{-- button No --}}
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                    {{-- button Yes --}}
                    <button id="confirmSubmit" type="button" class="btn btn-success" data-bs-dismiss="modal">YES</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#btnAdd").click(function() {
            if ($("#teams").val() == null) {
                $("#alert-warning").html("Tolong pilih Team terlebih dahulu")
                $("#ModalAlert").modal("show")
            } else if ($("#bahan").val() == null) {
                $("#alert-warning").html("Tolong pilih Bahan terlebih dahulu")
                $("#ModalAlert").modal("show")
            } else if ($("#jumlahAdd").val() == "") {
                $("#alert-warning").html("Tolong isi Jumlah terlebih dahulu")
                $("#ModalAlert").modal("show")
            } else {
                $("#confirmation").html("Apakah anda yakin?")
                $("#ModalConfirmation").modal("show")
            }

        })

        $("#confirmSubmit").click(function() {
            $.ajax({
                type: "POST",
                url: "{{ route('addIngredients') }}",
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'idteams': $("#teams").val(),
                    'nama_bahan': $("#bahan").val(),
                    'jumlahAdd': $("#jumlahAdd").val(),
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
