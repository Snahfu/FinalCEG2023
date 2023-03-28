@extends('layouts.app')

@section('css')
    <style>

        th {
            text-align: center;
            padding: 0 15px;
        }

        td {
            padding: 10px 15px;
            height: 54px;
        }
        button{
            margin-left: 8px;
        }

        .dropdown-menu{
            max-width: 350px;
            max-height: 200px;
        }

        .card{
            height: 363px;
            box-shadow: 5px 10px 20px rgba(0, 0, 0, 0.2);
            border: 0px solid black;
            border-radius: 20px;
        }
    </style>
@endsection

@section('content')
    <main class="d-block mx-auto">
        <div class="container tinkerer">

            <div class="row my-2 my-md-3 d-flex justify-content-center">
                <div class="col">
                    
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <h1 id="tipe" class="p-0 m-0">Crafting</h1>
                    <div class="card">
                        <div class="card-body">

                            {{-- Selection Team --}}
                            <div class="selection mb-3">
                                <label class="text">Nama Team :</label>
                                <select name="teams" id="teams" class="form-control selectpicker bordered"
                                    data-live-search="true" tabindex="-1" aria-label="team">
                                    <option value="-" selected disabled>-- Pilih Team --</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->idteams }}" data-tokens="{{ $team->idteams }}">
                                            {{ $team->namaTeam }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="">
                                <table class="table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Downgrade</th>
                                            <th>Alat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="selection">
                                                    <select name="downgrade_1" id="downgrade_1" class="form-control selectpicker selectDowngrade bordered" data-live-search="true" tabindex="-1" aria-label="downgrade">
                                                        <option value="-" selected disabled>-- Pilih Item --</option>
                                                        @foreach ($downgrade as $dg)
                                                            <option value="{{ $dg }}" data-tokens="{{$dg}}">{{ $dg }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                            </td>
                                            <td rowspan="3" style="text-align: center;vertical-align : middle;">
                                                <h3 id="hasil_alat">None</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>

                                                <div class="selection">
                                                    <select name="downgrade_2" id="downgrade_2" class="form-control selectpicker selectDowngrade bordered" data-live-search="true" tabindex="-1" aria-label="downgrade">
                                                        <option value="-" selected disabled>-- Pilih Item --</option>
                                                        @foreach ($downgrade as $dg)
                                                            <option value="{{ $dg }}" data-tokens="{{$dg}}">{{ $dg }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{-- <select name="downgrade_2" id="downgrade_2" class="selectDowngrade">
                                                    <option value="-">-</option>
                                                    @foreach ($downgrade as $dg)
                                                        <option value="{{ $dg }}">{{ $dg }}</option>
                                                    @endforeach
                                                </select> --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="selection">
                                                    <select name="downgrade_3" id="downgrade_3" class="form-control selectpicker selectDowngrade bordered" data-live-search="true" tabindex="-1" aria-label="downgrade">
                                                        <option value="-" selected disabled>-- Pilih Item --</option>
                                                        @foreach ($downgrade as $dg)
                                                            <option value="{{ $dg }}" data-tokens="{{$dg}}">{{ $dg }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{-- <select name="downgrade_3" id="downgrade_3" class="selectDowngrade">
                                                    <option value="-">-</option>
                                                    @foreach ($downgrade as $dg)
                                                        <option value="{{ $dg }}">{{ $dg }}</option>
                                                    @endforeach
                                                </select> --}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                                                     
                            <button id="btnCraft" class="btn btn-success"><i class="fa-solid fa-hammer" style="margin-right: 8px;"></i>Craft</button>
  
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <h1 id="tipe" class="p-0 m-0">Dismantle</h1>
                    <div class="card">
                        <div class="card-body">
                            
                            {{-- Selection Team --}}
                            <div class="selection mb-3">
                                <label class="text">Nama Team :</label>
                                <select name="teams" id="teams" class="form-control selectpicker bordered"
                                    data-live-search="true" tabindex="-1" aria-label="team">
                                    <option value="-" selected disabled>-- Pilih Team --</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->idteams }}" data-tokens="{{ $team->idteams }}">
                                            {{ $team->namaTeam }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="">
                                <table class="table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Alat</th>
                                            <th>Downgrade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td rowspan="3" style="vertical-align : middle;">
                                                <div class="selection">
                                                    <select name="alat" id="alat" class="form-control selectpicker selectDowngrade bordered" data-live-search="true" tabindex="-1" aria-label="downgrade">
                                                        <option value="-" selected disabled>-- Pilih Alat --</option>
                                                        @foreach ($alat as $a)
                                                            <option value="{{ $a->idalat }}" data-tokens="{{ $a->idalat }}">{{ $a->nama_alat }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                            </td>
                                            <td id="dismantle_1">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="dismantle_2">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="dismantle_3">
                                                -
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button id="btnDismantle" class="btn btn-danger"><i class="fa-solid fa-wrench" style="margin-right: 8px;"></i>Dismantle</button>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="spacing"></div>

            {{-- Dismantling
            <h2>Dismantle</h2>
            <select name="teamDismantle" id="teamDismantle">
                <option value="-">-</option>
                @foreach ($teams as $team)
                    <option value="{{ $team->idteams }}">{{ $team->namaTeam }}</option>
                @endforeach
            </select>
            <table>
                <thead>
                    <tr>
                        <th>Alat</th>
                        <th>Downgrade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="3">
                            <select name="alat" id="alat">
                                <option value="-">-</option>
                                @foreach ($alat as $a)
                                    <option value="{{ $a->idalat }}">{{ $a->nama_alat }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td id="dismantle_1">
                            -
                        </td>
                    </tr>
                    <tr>
                        <td id="dismantle_2">
                            -
                        </td>
                    </tr>
                    <tr>
                        <td id="dismantle_3">
                            -
                        </td>
                    </tr>
                </tbody>
            </table>
            <button id="btnDismantle" class="btn btn-primary">Dismantle</button>
        </div> --}}
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
        let action = null;
        // Crafting
        $(".selectDowngrade").change(function() {
            $.ajax({
                type: "POST",
                url: "{{ route('change.downgrade') }}",
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'downgrade_1': $("#downgrade_1").val(),
                    'downgrade_2': $("#downgrade_2").val(),
                    'downgrade_3': $("#downgrade_3").val(),
                },
                success: function(data) {
                    let result = data.data
                    let count = data.count

                    // console.log(result)
                    $("#hasil_alat").html("None")

                    if (count > 1) {
                        $("#hasil_alat").html(`
                            <select name="select_hasil_alat" id="select_hasil_alat">
                                <option>${result[0].nama_alat}</option>
                                <option>${result[1].nama_alat}</option>
                            </select>
                        `)
                    } else if (count > 0) {
                        $("#hasil_alat").html(result[0].nama_alat)
                    }
                },
                error: function() {
                    alert("error")
                }
            })
        })

        $("#btnCraft").click(function() {
            if ($("#teamCraft").val() == "-") {
                $("#alert-warning").html("Tolong pilih Team terlebih dahulu")
                $("#ModalAlert").modal("show");
            }

            if ($("#hasil_alat").html() == "None") {
                $("#alert-warning").html(
                    "Tolong pilih Downgrade yang lengkap terlebih dahulu untuk di <em>Crafting</em>")
                $("#ModalAlert").modal("show");
            }

            if ($("#teamCraft").val() != "-" && $("#hasil_alat").html() != "None") {
                $("#confirmation").html(`Apakah anda yakin ingin <em>Craft</em> ${$("#hasil_alat").html()}?`)
                $("#ModalConfirmation").modal("show");
                action = "crafting"
            }
        })

        // Dismantle
        $("#alat").change(function() {
            if ($("#alat").val() == "-") {
                for (let x = 1; x <= 3; x++) {
                    $(`#dismantle_${x}`).html("-")
                }
            } else {
                $.ajax({
                    type: "POST",
                    url: "{{ route('change.alat') }}",
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'selectedAlat': $("#alat").val()
                    },
                    success: function(data) {
                        let result = data.data
                        for (let x = 1; x <= 3; x++) {
                            $(`#dismantle_${x}`).html(result[x - 1])
                        }

                        if (result.length == 2) {
                            $(`#dismantle_3`).html("-")
                        }
                    },
                    error: function() {
                        alert("error")
                    }
                })
            }

        })

        $("#btnDismantle").click(function() {
            if ($("#teamDismantle").val() == "-") {
                $("#alert-warning").html("Tolong pilih Team terlebih dahulu")
                $("#ModalAlert").modal("show");
            }

            if ($("#alat").val() == "-") {
                $("#alert-warning").html("Tolong pilih Alat yang ingin di <em>Dismantle</em> terlebih dahulu")
                $("#ModalAlert").modal("show");
            }

            if ($("#teamDismantle").val() != "-" && $("#alat").html() != "None") {
                $("#confirmation").html(
                    `Apakah anda yakin ingin <em>Dismantle</em> ${$("#alat option:selected").html()}?`)
                $("#ModalConfirmation").modal("show");
                action = "dismantle"
            }
        })

        $("#confirmSubmit").click(function() {
            if (action == "crafting") {
                $.ajax({
                    type: "POST",
                    url: "{{ route('tinkerer.crafting') }}",
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'team': $("#teamCraft").val(),
                        'alat': $("#hasil_alat").html(),
                        'downgrade_1': $("#downgrade_1").val(),
                        'downgrade_2': $("#downgrade_2").val(),
                        'downgrade_3': $("#downgrade_3").val()
                    },
                    success: function(data) {
                        let msg = data.msg
                        alert(msg)
                    },
                    error: function() {
                        alert("error")
                    }
                })
            } else if (action == "dismantle") {
                $.ajax({
                    type: "POST",
                    url: "{{ route('tinkerer.dismantle') }}",
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'team': $("#teamDismantle").val(),
                        'alat': $("#alat option:selected").html(),
                    },
                    success: function(data) {
                        let msg = data.msg
                        alert(msg)
                    },
                    error: function() {
                        alert("error")
                    }
                })
            }
        })
    </script>
@endsection
