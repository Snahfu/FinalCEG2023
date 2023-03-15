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
        <div class="container addKoin d-flex flex-column gap-3">
            <div class="card">
                <div class="card-body mx-sm-3">
                    <div class="isiCard ">
                        <div class="usable">
                            <div class="selection my-3">
                                <div class="text">Nama Team :</div>
                                <select name="team" id="team" class="form-control selectpicker bordered"
                                    data-live-search="true" tabindex="-1" aria-label="team">
                                    <option value="-" selected disabled>-- Pilih Team --</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->idteams }}" data-tokens="{{ $team->idteams }}">
                                            {{ $team->namaTeam }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="addSection">
                                <div class="d-flex align-items-center">
                                    <label>Jumlah </label>
                                    <input class="form-control" id="jumlahKoin" type="number" inputmode="numeric"
                                        name="koin" id="koin" min="0" placeholder="0">
                                </div>
                                <div class="d-flex align-items-center">
                                    <button id="btnAddKoin" class="btn btn-primary" style="margin-left:10px">Add</button>
                                </div>
                            </div>
                        </div>

                        <div class="gifCont">
                            <div class="gif"></div>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
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

                    $("#team").val("-").change()
                    $("#jumlahKoin").val("")
                },
                error: function() {
                    alert("error")
                }
            })
        })
    </script>
@endsection
