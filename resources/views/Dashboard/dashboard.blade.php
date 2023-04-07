@extends('layouts.app')

@section('css')
    <!-- Styles -->
    <link href="{{ asset('css/pemain/dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    <main class="d-block mx-1 sm-mx-4">
        <div class="container dashboard d-flex flex-column">

            <div class="card py-2 mb-4 mt-3" id="header">
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
                        
                        <div class="row">
                            <div class="col p-0" id="koinResponsive">
                                <div class="d-flex" style="">
                                    <i class="bi bi-coin icon" id="icon-coin"></i>
                                    <div class="koin px-3 d-flex align-items-center" style="font-size: 18px;">
                                        {{ $team[0]->koin }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="row my-2 my-md-3">
                <div class="col">
                    <h1 class="p-0 m-0" id="page-name">Dashboard</h1>
                </div>

            </div>

            <div class="card my-4" id="card-inv">
                <div class="card-body">
                    <div class="row">

                        <div class="col">
                            <div class="d-flex flex-row " style="margin-bottom: 0px;">
                                <div class="btnItems tab d-flex align-items-center justify-content-center activeTab"
                                    id="btnAlat">
                                    <a href="#">Alat</a>
                                </div>
                                <div class="btnItems tab d-flex align-items-center  justify-content-center" id="btnBahan">
                                    <a href="#">Bahan</a>
                                </div>
                                <div class="btnItems tab d-flex align-items-center  justify-content-center"
                                    id="btnDowngrade">
                                    <a href="#">Downgrade</a>
                                </div>

                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="table-dark" id="thead-sticky">
                                        <tr>
                                            <th scope="col" width="15%">
                                                No.
                                            </th>
                                            <th scope="col" width="60%" style="text-align: left;">
                                                Nama
                                            </th>
                                            <th scope="col" width="25%">
                                                Tersedia
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="items" class="table-group-divider">
                                        <?php $no = 1; ?>
                                        @foreach ($alat as $a)
                                            <?php $helper = false; ?>

                                            <tr>
                                                <td style="text-align: center;" scope="row"><?php echo $no; ?></td>
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
                                            <?php $no++; ?>
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

    {{-- JQUERY --}}
    <script>
        //  dipakai untuk mengganti inventory (alat, bahan, downgrade)
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
                                let helperBahan = false;
                                $.each(data.inventory, function(key1, value1) {
                                    if (value.nama_bahan == value1.nama_barang) {
                                        $("#items").append(`
                                        <tr>
                                            <td style="text-align: center;">
                                                ${num}
                                            </td>
                                            <td>
                                                ${value.nama_bahan}
                                            </td>
                                            <td style="text-align: center;">
                                                ${value1.stock_barang}
                                            </td>
                                        </tr>`)
                                        helperBahan = true
                                        return false
                                    }
                                })
                                if (helperBahan == false) {
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
                                }
                                break;
                            case "downgrade":
                                let helperDowngrade = false
                                $.each(data.inventory, function(key2, value2) {
                                    if (value == value2.nama_barang) {
                                        $("#items").append(`
                                        <tr>
                                            <td style="text-align: center;">
                                                ${num}
                                            </td>
                                            <td>
                                                ${value}
                                            </td>
                                            <td style="text-align: center;">
                                                ${value2.stock_barang}
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

    {{-- PUSHER --}}
    <script>
        var pusher = new Pusher('ee40c583b896ff3cfaa7', {
            cluster: 'ap1'
        });

        var teamPusher = pusher.subscribe('teamPusher');
        teamPusher.bind('team', (e) => {
            let thisId = "<?php echo $team[0]->idteams; ?>"
            // console.log(thisId)
            // console.log(e.id)

            if (thisId == e.id) {
                $(".koin").html(`${e.koin} Koin`)
                console.log('masuk')
            }
        });
    </script>
@endsection
