@extends('layouts.app')

@section('css')
    <style>

        .tool{
            width: 60%;
        }

        .selection .form-control{
            max-width: 350px;
        }

        .dropdown {
            border: 1px solid black !important;
        }

        .dropdown-menu{
            max-width: 350px;
            max-height: 200px;
        }

        .card{
            border: 0px solid black;
            box-shadow: 5px 10px 20px rgba(0, 0, 0, 0.2);
            border-radius: 20px;
        }

        .isiCard{
            display: flex;
            flex-direction: row;
        }

        .addSection{
            display: flex;
            flex-direction: row;
            align-items: center;
            
        }

        .usable{
            width: 60%;
        }

        #btnAdd{
            max-width: 100px;
        }

        #jumlahAdd{
            margin-left:10px;
        }

        .gif{
            width: 360px;
            height: auto;
            
        }
        .gifCont{
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px;
            background-image: url({{ asset('assets/hiburan/wednesdaymorning.gif') }});
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            transition: all 0.1s ease-in-out;

        }
        .gifCont:hover{
            background-image: url({{ asset('assets/hiburan/melastnight.gif') }});
            transition: all 0.1s ease-in-out;

        }

        @media screen and (max-width:1000px){
            .gif{
                width: 240px;
            }
        }

        @media screen and (max-width:768px){
            .tool{
                width: 80%;
            }
            .gif{
                width: auto;
                height: 240px;
            }
            .usable{
                width: 100%;
            }

            .addSection{
                display: flex;
                align-items: center;
                width: 100%;
            }
            #jumlahAdd{
                margin-left:10px;
            }

            .isiCard{
                display: flex;
                flex-direction: column  ;
            }
        }



        @media screen and (max-width:575px){
            .tool{
                width: 95%;
            }
            .addSection{
                display: flex;
                flex-direction: column;
            }
            .usable{
                width: 100%;
            }
            
            
            #btnAdd{
                margin-top:10px;
                max-width: 100%;
            }
            #jumlahAdd{
                margin-left:10px;
                max-width:150px;
            }

            .gif{
                width: auto;
                height: 160px;
            }

            .isiCard{
                display: flex;
                flex-direction: column  ;
            }

            .gifCont{
                margin-top: 20px;
                display: flex;
                justify-content: center;
            }
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
    <main class="d-block mx-1 mx-sm-4 my-5">
        <div class="container tool d-flex flex-column gap-3">

            <div class="card">
                <div class="card-body mx-sm-3">
                    <div class="isiCard">

                        {{-- Colomn Usable --}}
                        <div class="usable">

                            {{-- Selection Team --}}
                            <div class="selection">
                                <div class="text">Nama Team :</div>
                            <select name="teams" id="teams" class="form-control selectpicker bordered"   data-live-search="true" tabindex="-1" aria-label="team">
                                    <option value="-" selected disabled>-- Pilih Team --</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->idteams }}" data-tokens="{{ $team->idteams }}">{{ $team->namaTeam }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Selection Alat --}}
                            <div class="selection my-3 my-sm-5">
                                <div class="text">Nama Alat :</div>
                                <select name="alat" id="alat" class="form-control selectpicker bordered" data-live-search="true" tabindex="-1" aria-label="alat">
                                    <option value="-" selected disabled>-- Pilih Alat --</option>
                                    @foreach ($alat as $a)
                                        <option value="{{ $a->nama_alat }}" data-tokens="{{ $a->nama_alat }}">{{ $a->nama_alat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="addSection">
                                <div class="d-flex align-items-center"> 
                                    <label>Jumlah </label>
                                    
                                <input class="form-control" type="text" inputmode="numeric" name="jumlahAdd" id="jumlahAdd">
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
    </script>
@endsection
