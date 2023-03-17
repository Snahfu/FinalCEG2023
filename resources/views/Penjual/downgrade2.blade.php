@extends('layouts.app')

@section('css')
    <style>
        body {
            background: ;
        }

        h1:after {
            background-color: #000;
            content: "";
            display: inline-block;
            height: 2px;
            position: relative;
            vertical-align: middle;
            width: 25%;
        }

        /* h1:before {
            right: 0.5em;
            margin-left: 1.5%;
        } */

        h1:after {
            left: 0.5em;
            margin-right: 0%;
        }

        img {
            aspect-ratio: 1/1;
            object-fit: contain;
        }

        .btn-primary {
            padding: 3px 6px 3px 6px !important;
            font-size: 12px;
        }

        .harga {
            background: #d3d7a5;
        }

        .card-body .badge {
            /* background: #d3d7a5 !important; */
            font-size: 14px;
        }

        /* Responsive Grid Start */
        .cardBuy {
            display: flex;
        }

        .card-container {
            display: grid;
            grid-template-columns: auto auto auto auto auto;
        }

        .cardItems {
            width: auto;
            margin: 15px 10px 10px 10px !important;

            box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.4);
            transition: all 0.1s ease-in-out;
        }

        .cardItems:hover {
            transform: translateY(-2%);
            transition: all 0.15s ease-in-out;
        }

        .card-container .card-body {
            padding: 16px 12px 16px 12px;
        }

        .nomortb {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <main class="d-block mx-auto">
        <div class="container">

            <div class="row my-2 my-md-3 d-flex justify-content-center">
                <div class="col">
                    <h1 id="tipe" class="p-0 m-0">{{ $tipe }}</h1>
                </div>

            </div>

            <div class="row">
                {{-- Sisi Display --}}
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- START Baris Pertama --}}
                            <div class="inline-spacing">
                                <div class="card-container">
                                    @foreach ($market_downgrade as $downgrade)
                                        <div class="card col-2 p-0 cardItems">
                                            {{-- <img src="{{ asset('assets/tools/knife.png') }}" class="card-img-top"
                                                alt="..."> --}}
                                            <div class="card-body text-center">
                                                <h6 class="">{{ $downgrade->downgrade }}</h6>
                                                <div class="row my-1">
                                                    <div class="col">
                                                        Stock : <span class="">{{ $downgrade->stok }}</span>
                                                    </div>

                                                </div>
                                                <div class="d-flex justify-content-center my-1" style="font-size: 14px">

                                                    <span class="badge bg-danger mx-1">{{ $downgrade->harga_beli }}</span>
                                                    <span class="badge bg-success mx-1">{{ $downgrade->harga_jual }}</span>
                                                </div>

                                                <button id="{{ $downgrade->downgrade }}"
                                                    class="btnAdd btn btn-primary w-100"><i
                                                        class="fa-solid fa-cart-shopping mx-1"></i>Add</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- END Baris Pertama --}}

                        </div>
                    </div>
                </div>
                {{-- Sisi pembelian --}}
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row my-2">
                                {{-- Selection Team --}}
                                <div class="selection">
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
                            </div>
                            <div class="text">Daftar Penjualan/Pembelian:</div>
                            <div class="row">
                                <table class="table table-striped">
                                    <tbody id="keranjang">
                                        {{-- <tr>
                                            <td class="nomortb" width="15%">1.</td>
                                            <td width="70%">Pisau</td>
                                            <td><input type="number" style="width: 100px"></td>
                                        </tr>
                                        <tr>
                                            <td class="nomortb" width="15%">2.</td>
                                            <td width="70%">Kondensor</td>
                                            <td><input type="number" style="width: 100px"></td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button id="btnConfirm" class="btn btn-success">Konfirmasi</button>
                            </div>

                        </div>
                    </div>
                </div>
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
        let num = 0
        // jalan waktu reload
        $(document).ready(function() {
            let keranjang = localStorage.getItem("keranjang")

            if (keranjang != null && keranjang.length > 0) {
                console.log(keranjang)

                // tampilin di keranjnang waktu reload
                $.each(JSON.parse(keranjang), function(index, value) {
                    console.log(`${index}, ${value}`)
                    let val = (value[1] != null) ? value[1] : 0
                    $("#keranjang").append(
                        `<tr identifier="${parseInt(index)+1}">
                            <td class="nomortb" width="15%">${parseInt(index)+1}</td>
                            <td width="70%">${value[0]}</td>
                            <td><input id="${parseInt(index)+1}" type="number" style="width: 100px" min=0 value=${val}></td>
                            <td><button style="border: none; background-color: transparent;" onClick="delItem(${parseInt(index)+1})"><i class="fa-solid fa-xmark" style="color: red;"></i></button></td>
                        </tr>`)
                })

                num = keranjang.length
            }

        })

        // jalan waktu btnAdd di klik
        $(".btnAdd").click(function() {
            // ambil keranjang di localStorage
            let arrKeranjang = []
            let cek_keranjang = localStorage.getItem("keranjang")

            if (cek_keranjang != null) {
                arrKeranjang = JSON.parse(cek_keranjang)
            }

            // append ke keranjang
            $("#keranjang").append(
                `<tr>
                    <td class="nomortb" width="15%">${arrKeranjang.length + 1}</td>
                    <td width="70%">${$(this).attr("id")}</td>
                    <td><input id="${arrKeranjang.length + 1}" type="number" style="width: 100px" min=0 value=0></td>
                    <td><button style="border: none; background-color: transparent;" onClick="delItem()"><i class="fa-solid fa-xmark" style="color: red;"></i></button></td>
                </tr>`)

            arrKeranjang.push([$(this).attr("id")])

            console.log(arrKeranjang)

            localStorage.setItem("keranjang", JSON.stringify(arrKeranjang))
            num++
        })

        // jalan waktu btnConfirm (Konfirmasi) di klik
        $("#btnConfirm").click(function() {
            let id = 0
            let arrayKeranjang = JSON.parse(localStorage.getItem("keranjang"))

            // tambah atau ubah jumlah yang dibeli
            if (arrayKeranjang != null) {
                $("#keranjang>tr").each(function() {
                    // console.log($(`input#${parseInt(id)+1}`).val())
                    if (arrayKeranjang[id][1] != null) {
                        arrayKeranjang[id][1] = $(`input#${parseInt(id)+1}`).val()
                    } else {
                        arrayKeranjang[id].push($(`input#${parseInt(id)+1}`).val())
                    }
                    id++
                })
            }

            console.log(arrayKeranjang)

            localStorage.setItem("keranjang", JSON.stringify(arrayKeranjang))

            // console.log($("#teams").find(":selected").val())
            if ($("#teams").find(":selected").val() != "-") {

                $("#confirmation").html(`Apakah Team ${$("#teams").find(":selected").text()} yakin ingin membeli:`)

                $("#listDowngrade").html("")
                $.each(arrayKeranjang, function(index, value) {
                    if (value[1] != null && value[1] > 0) {
                        $("#listDowngrade").append(`
                        <li name="${value[0]}" value="${value[1]}">
                            ${value[0]} (${value[1]})
                        </li>`)
                    }
                })

                $("#ModalConfirmation").modal("show")

            } else {
                $("#alert-warning").html("Tolong pilih Team terlebih dahulu")
                $("#ModalAlert").modal("show")
            }
        })

        // jalan waktu sudah konfirmasi di modal
        $("#confirmSubmit").click(function() {
            let arrayDowngrade = []
            arrayDowngrade = JSON.parse(localStorage.getItem("keranjang"))
            // console.log(arrayDowngrade)

            if ($("h1#tipe").html() == "Sell") {
                $.ajax({
                    type: "POST",
                    url: "{{ route('adminDowngradeSell') }}",
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'team': $("#teams").val(),
                        'arrayDowngrade': arrayDowngrade,
                    },
                    success: function(data) {
                        let msg = data.msg
                        $("#alert-warning").html(msg)
                        $("#ModalAlert").modal("show")
                    },
                    error: function() {
                        alert('error')
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

            // bersihkan semua data keranjang
            $("#keranjang").html("")
            localStorage.removeItem("keranjang")
        })

        // jalan waktu x di klik
        function delItem(id) {
            $(`tr[identifier="${id}"]`).remove()
            let arr_keranjang = []
            arr_keranjang = JSON.parse(localStorage.getItem("keranjang"))

            arr_keranjang.splice(parseInt(id) - 1, 1)

            localStorage.setItem("keranjang", JSON.stringify(arr_keranjang))

            $("#keranjang").html("")
            $.each(arr_keranjang, function(index, value){
                let val = (value[1] != null) ? value[1] : 0
                $("#keranjang").append(
                    `<tr identifier="${parseInt(index)+1}">
                        <td class="nomortb" width="15%">${parseInt(index)+1}</td>
                        <td width="70%">${value[0]}</td>
                        <td><input id="${parseInt(index)+1}" type="number" style="width: 100px" min=0 value=${val}></td>
                        <td><button style="border: none; background-color: transparent;" onClick="delItem(${parseInt(index)+1})"><i class="fa-solid fa-xmark" style="color: red;"></i></button></td>
                    </tr>`)
            })
        }
    </script>
@endsection
