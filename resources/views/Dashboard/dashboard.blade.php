@extends('layouts.app')

@section('css')
    <!-- Styles -->
    <link href="{{ asset('css/pemain/dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    <main class="d-block mx-4">
        <div class="container dashboard d-flex flex-column">

            <div class="card py-2 mb-4" id="header">
                <div class="row d-flex justify-content-center">
                    <div class="col-4 col-sm-3 d-flex justify-content-center p-0">
                        <div class="img-container">
                            <img src="{{ asset('assets/users/dummy_pic2.jpg') }}" id="user_Picture" class="userPic">
                        </div>

                    </div>
                    <div class="col-12 col-sm py-2">
                        <div class="row">
                            <div class="col p-0">
                                <h3 id="username" style="font-weight:bold;">{{ $team[0]->namaTeam }}</h3>
                            </div>

                        </div>
                        {{-- <div class="col colDashboard">
                            <h3 id="username" style="font-weight:bold;">Ini Nama Kelompok </h3>
                        </div> --}}
                        <div class="row">
                            <div class="col p-0" id="koinResponsive">
                                <div class="d-flex" style="">
                                    <i class="fa-solid fa-coins" id="icon-coin"></i>
                                    <div class="koin px-3" style="font-size: 18px;">
                                        {{ $team[0]->koin }} Koin
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col colDashboard" style="">
                            <i class="fa-solid fa-coins" id="icon-coin"></i> 
                            <div class="koin px-3" style="font-size: 18px;">
                                {{ $team[0]->koin }} Koin
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>

            <div class="card" id="card-inv">
                <div class="card-body">
                    <div class="row">
                        {{-- <div class="col-2 d-flex flex-column">
                            <a id="btnAlat" class="btnItems w-100 active" href="#">Alat</a>
                            <a id="btnBahan" class="btnItems w-100" href="#">Bahan</a>
                            <a id="btnDowngrade" class="btnItems w-100" href="#">Downgrade</a>

                            <button id="btnAlat" class="btn btn-primary btnItems">Alat</button>
                            <button id="btnBahan" class="btn btn-primary btnItems">Bahan</button>
                            <button id="btnDowngrade" class="btn btn-primary btnItems">Downgrade</button>
                        </div> --}}

                        <div class="col">
                            <div class="d-flex flex-row " style="margin-bottom: 0px">
                                <div class="btnItems tab d-flex align-items-center justify-content-center activeTab" id="btnAlat">
                                    <a href="#">Alat</a>
                                </div>
                                <div class="btnItems tab d-flex align-items-center  justify-content-center" id="btnBahan">
                                    <a href="#">Bahan</a>
                                </div>
                                <div class="btnItems tab d-flex align-items-center  justify-content-center" id="btnDowngrade" >
                                    <a href="#">Downgrade</a>
                                </div>
                                
                            </div>
                                
                            
                            
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" width="15%">
                                                No.
                                            </th>
                                            <th scope="col" width="60%">
                                                Nama
                                            </th>
                                            <th scope="col" width="25%">
                                                Tersedia
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="items" class="table-group-divider">
                                        @foreach ($alat as $a)
                                            <?php $helper = false; ?>
                                            <tr>
                                                <td style="text-align: center;" scope="row">{{ $a->idalat }}</td>
                                                <td scope="row">{{ $a->nama_alat }}</td>
                                                @foreach ($inventory as $i)
                                                    @if ($a->nama_alat == $i->nama_barang)
                                                        <td style="text-align: center;" scope="row">
                                                            {{ $i->stock_barang }}</td>
                                                        <?php $helper = true; ?>
                                                    @endif
                                                @endforeach
                                                @if ($helper == false)
                                                    <td style="text-align: center;" scope="row">0</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>

    <script>
        $(".btnItems").click(function() {
            let itemType = ""
            switch (this.id) {
                case "btnAlat":
                    itemType = "alat"
                    $("#btnBahan").removeClass("activeTab")
                    $("#btnDowngrade").removeClass("activeTab")
  
                    $("#btnAlat").addClass("activeTab")
                    break;
                case "btnBahan":
                    itemType = "bahan"
                    $("#btnAlat").removeClass("activeTab")
                    $("#btnDowngrade").removeClass("activeTab")

                    $("#btnBahan").addClass("activeTab")
                    break;
                case "btnDowngrade":
                    itemType = "downgrade"
                    $("#btnAlat").removeClass("activeTab")
                    $("#btnBahan").removeClass("activeTab")

                    $("#btnDowngrade").addClass("activeTab")
                    break;
            }

            $.ajax({
                type: "POST",
                url: "{{ route('inventory') }}",
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'tipe': itemType,
                },
                success: function(data) {
                    // alert("success")
                    let result = data.data
                    let num = 1
                    $("#items").html("")
                    $.each(result, function(key, value) {
                        switch (itemType) {
                            case "alat":
                                let helperAlat = false
                                $.each(data.inventory, function(key1, value1) {
                                    if (value.nama_alat == value1.nama_barang) {
                                        $("#items").append(`
                                        <tr>
                                            <td style="text-align: center;">
                                                ${num}
                                            </td>
                                            <td>
                                                ${value.nama_alat}
                                            </td>
                                            <td style="text-align: center;">
                                                ${value1.stock_barang}
                                            </td>
                                        </tr>`)
                                        helperAlat = true
                                        return false
                                    }
                                })
                                if (helperAlat == false) {
                                    $("#items").append(`
                                        <tr>
                                            <td style="text-align: center;">
                                                ${num}
                                            </td>
                                            <td>
                                                ${value.nama_alat}
                                            </td>
                                            <td style="text-align: center;">
                                                0
                                            </td>
                                        </tr>`)
                                }
                                break;
                            case "bahan":
                                $("#items").append(`
                                <tr>
                                    <td style="text-align: center;">
                                        ${num}
                                    </td>
                                    <td>
                                        ${value.nama_bahan}
                                    </td>
                                    <td style="text-align: center;">
                                        0
                                    </td>
                                </tr>`)
                                break;
                            case "downgrade":
                                let helperDowngrade = false
                                $.each(data.inventory, function(key1, value1) {
                                    if (value == value1.nama_barang) {
                                        $("#items").append(`
                                        <tr>
                                            <td style="text-align: center;">
                                                ${num}
                                            </td>
                                            <td>
                                                ${value}
                                            </td>
                                            <td style="text-align: center;">
                                                ${value1.stock_barang}
                                            </td>
                                        </tr>`)
                                        helperDowngrade = true
                                        return false
                                    }
                                })
                                if (helperDowngrade == false) {
                                    $("#items").append(`
                                        <tr>
                                            <td style="text-align: center;">
                                                ${num}
                                            </td>
                                            <td>
                                                ${value}
                                            </td>
                                            <td style="text-align: center;">
                                                0
                                            </td>
                                        </tr>`)
                                }
                                break;
                        }
                        num++
                    })
                },
                error: function() {
                    alert("error")
                }
            })
        })
    </script>
@endsection
