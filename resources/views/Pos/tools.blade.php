@extends('layouts.app')

@section('css')
    <!-- Styles -->
    <link href="{{ asset('css/pos/template.css') }}" rel="stylesheet">

    <style>
        .gifCont {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px;
            transition: all 0.1s ease-in-out;
            background-image: url({{ asset('assets/hiburan/wednesdaymorning.gif') }});
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;


        }

        .gifCont:hover {
            transition: all 0.1s ease-in-out;
            background-image: url({{ asset('assets/hiburan/melastnight.gif') }});
        }
    </style>
@endsection

@section('content')
    <main class="d-block mx-1 mx-sm-4 my-5">
        <div class="container tool">

            <div>
                <h2>{{ $pos->name }}</h2>
            </div>

            <div class="card">
                <div class="card-body mx-sm-3">
                    <div class="isiCard">

                        {{-- Colomn Usable --}}
                        <div class="usable">

                            {{-- Selection Team --}}
                            <div class="selection">
                                <div class="text">Nama Team :</div>
                                <select name="teams" id="teams" class="form-control selectpicker bordered"
                                    data-live-search="true" tabindex="-1" aria-label="team">
                                    <option value="-" selected disabled>-- Pilih Team --</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->idteams }}" data-tokens="{{ $team->idteams }}">
                                            {{ $team->namaTeam }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Selection Alat --}}
                            <div class="selection my-3 my-sm-5">
                                <div class="text">Nama Alat :</div>
                                <select name="alat" id="alat" class="form-control selectpicker bordered"
                                    data-live-search="true" tabindex="-1" aria-label="alat">
                                    <option value="-" selected disabled>-- Pilih Alat --</option>
                                    @foreach ($alat as $a)
                                        <option value="{{ $a->nama_alat }}" data-tokens="{{ $a->nama_alat }}">
                                            {{ $a->nama_alat }} ({{ $a->nama_jenis }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="addSection">
                                <div class="d-flex align-items-center">
                                    <label>Jumlah </label>

                                    <input class="form-control" type="number" inputmode="numeric" name="jumlahAdd"
                                        id="jumlahAdd" min="0" placeholder="0">
                                </div>
                                <div class="d-flex align-items-center">
                                    <button id="btnAdd" class="btn btn-primary" style="margin-left:10px">Add</button>
                                </div>
                            </div>

                        </div>

                        {{-- GIF TIME --}}
                        <div class="gifCont">
                            <div class="gif"></div>

                            {{-- <div style="width:100%;height:0;padding-bottom:75%;position:relative;"><iframe src="https://giphy.com/embed/wdgX1eCnUd8ZzWIMi4" width="100%" height="100%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe></div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-end">
                <div class="HeartAnimation d-flex justify-content-end"></div>
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
                    <button id="btnOk" type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
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
        $(function() {
            $(".HeartAnimation").click(function() {
                $(this).toggleClass("animate");
            });
        });

        $("#btnAdd").click(function() {
            if ($("#teams").val() == null) {
                $("#alert-warning").html("Tolong pilih Team terlebih dahulu")
                $("#ModalAlert").modal("show")
            } else if ($("#alat").val() == null) {
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
                url: "{{ route('addTools') }}",
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'idteams': $("#teams").val(),
                    'nama_alat': $("#alat").val(),
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

        $("#btnOk").click(function() {
            location.reload();
        })
    </script>
@endsection
