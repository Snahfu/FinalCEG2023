@extends('layouts.app')

@section('css')
    <style>
        table,
        thead,
        tbody,
        tr,
        th,
        td {
            border: 1px solid black;
        }

        th {
            text-align: center;
        }

        td {
            padding: 0 10px;
        }

        .dashboard {
            width: 60%;
        }
    </style>
@endsection

@section('content')
    <main class="d-block mx-auto">
        <div class="container dashboard d-flex flex-column">
            <div>
                <select name="teams" id="teams">
                    <option value="-">-- Pilih Team --</option>
                    @foreach ($teams as $team)
                        <option value="{{ $team->idteams }}">{{ $team->namaTeam }}</option>
                    @endforeach
                </select>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>
                            No.
                        </th>
                        <th>
                            Nama Bahan
                        </th>
                        <th>
                            Stok
                        </th>
                        <th>
                            Jumlah
                        </th>
                    </tr>
                </thead>
                <tbody id="items">
                    <?php $id = 1; ?>
                    @foreach ($market_bahan as $bahan)
                        <tr>
                            <td style="text-align: center;"><?php echo $id; ?></td>
                            <td>{{ $bahan->bahan }}</td>
                            <td style="text-align: center;">{{ $bahan->stok }}</td>
                            <td style="text-align: center;"><input id="{{ $bahan->bahan }}" class="jumlah" type="number"
                                    min="0" max="{{ $bahan->stok }}" value="0">
                            </td>
                        </tr>
                        <?php $id++; ?>
                    @endforeach
                </tbody>
            </table>
            <div>
                <button id="btnConfirm" class="btn btn-primary" style="float: right;">Confirm</button>
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
                <div class="modal-body flex">
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
                    <ul id="listBahan"></ul>
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
        $("#btnConfirm").click(function() {
            if ($("#teams").val() != "-") {
                $("#confirmation").html("Apakah anda yakin ingin membeli:")
                $("#listBahan").html("")
                $(".jumlah").each(function() {
                    // console.log($(this).val())
                    if ($(this).val() > 0) {
                        $("#listBahan").append(`
                        <li name="${$(this).attr("id")}" value="${$(this).val()}">
                            ${$(this).attr("id")} (${$(this).val()})
                        </li>`)
                    }
                })
                $("#ModalConfirmation").modal("show")
            } else {
                $("#alert-warning").html("Tolong pilih Team terlebih dahulu")
                $("#ModalAlert").modal("show")
            }
        })

        $("#confirmSubmit").click(function() {
            let beliBahan = []
            $("#listBahan>li").each(function() {
                let bahan = [$(this).attr("name"), $(this).attr("value")]
                beliBahan.push(bahan)
            })

            $.ajax({
                type: "POST",
                url: "{{ route('jualBahan') }}",
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'team': $("#teams").val(),
                    'beliBahan': beliBahan
                },
                success: function(data) {
                    let msg = data.msg
                    $("#alert-warning").html(msg)
                    $("#ModalAlert").modal("show")
                },
                error: function() {
                    alert("error")
                }
            })
        })
    </script>
@endsection
