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
        .HeartAnimation {
            padding-top: 2em;
            background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/66955/web_heart_animation.png');
            background-repeat: no-repeat;
            background-size: 2900%;
            background-position: left;
            height: 50px;
            width: 50px;
            
            cursor: pointer;
        }

        .animate {
            animation: heart-burst .8s steps(28) forwards;
        }

        @keyframes heart-burst {
            0% {
                background-position: left
            }
            100% {
                background-position: right
            }
        }
    </style>
@endsection

@section('content')
    <main class="d-block mx-auto">
        <div class="container dashboard d-flex flex-column">
            <h1 id="tipe">{{ $tipe }}</h1>
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
                            Nama Downgrade
                        </th>
                        <th>
                            Stock
                        </th>
                    </tr>
                </thead>
                <tbody id="items">
                    <?php $id = 1; ?>
                    @foreach ($market_downgrade as $downgrade)
                        <tr>
                            <td style="text-align: center;"><?php echo $id; ?></td>
                            <td>{{ $downgrade->downgrade }}</td>
                            <td style="text-align: center;">{{ $downgrade->stok }}</td>
                            <td style="text-align: center;"><input id="{{ $downgrade->downgrade }}" class="jumlah"
                                    type="number" min="0" max="{{ $downgrade->stok }}" value="0"
                                    style="max-width: 50px;">
                            </td>
                        </tr>
                        <?php $id++; ?>
                    @endforeach
                </tbody>
            </table>
            <div>
                <button id="btnConfirm" class="btn btn-primary" style="float: right;">Confirm</button>
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
                    <ul id="listDowngrade"></ul>
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

        $("#btnConfirm").click(function() {
            if ($("#teams").val() != "-") {
                if ($("h1#tipe").html() == "Sell") {
                    $("#confirmation").html("Apakah Peserta yakin ingin membeli:")
                } else if ($("h1#tipe").html() == "Buy") {
                    $("#confirmation").html("Apakah Peserta yakin ingin menjual:")
                }
                $("#listDowngrade").html("")
                $(".jumlah").each(function() {
                    // console.log($(this).val())
                    if ($(this).val() > 0) {
                        $("#listDowngrade").append(`
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
            let arrayDowngrade = []
            $("#listDowngrade>li").each(function() {
                let downgrade = [$(this).attr("name"), $(this).attr("value")]
                arrayDowngrade.push(downgrade)
            })

            if ($("h1#tipe").html() == "Sell") {
                $.ajax({
                    type: "POST",
                    url: "{{ route('adminDowngradeSell') }}",
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'team': $("#teams").val(),
                        'arrayDowngrade': arrayDowngrade
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
            } else if ($("h1#tipe").html() == "Buy") {
                $.ajax({
                    type: "POST",
                    url: "{{ route('adminDowngradeBuy') }}",
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'team': $("#teams").val(),
                        'arrayDowngrade': arrayDowngrade
                    },
                    success: function(data) {
                        if (data.status == "kurang") {
                            $("#alert-warning").html(data.msg)
                            $("#alert-body").append(`<ul></ul>`)
                            $.each(data.downgradeLebih, function(key, value) {
                                $("#alert-body>ul").html(`<li>${value}</li>`)
                            })
                            $("#ModalAlert").modal("show")
                        } else {
                            $("#alert-warning").html(data.msg)
                            $("#ModalAlert").modal("show")
                        }
                    },
                    error: function() {
                        alert("error")
                    }
                })
            }
        })
    </script>
@endsection
