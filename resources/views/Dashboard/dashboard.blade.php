@extends('layouts.app')

@section('css')
    <style>
        table,
        thead,
        tbody,
        tr,
        th,
        td {
            /* border: 1px solid black; */
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

        #header{
            /* max-width: 600px; */
            border-radius: 20px;
            box-shadow: 5px 10px 20px rgba(0, 0, 0, 0.2);
            border: 0 solid;
        }
        .img-container{
            clip-path: circle(50% at 50% 50%);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: fit-content;
            height: auto;
            display: flex;
            align-content: center;
        }
        .userPic{
            max-width: 100px;
            height: auto;
        }
        #icon-coin{
            font-size: 24px;
        }

        @media screen and (max-width:768px){
            .userPic{
                width: 75px;
            }
            .dashboard{
                width: 95%;
            }
        }

        @media screen and (max-width:575px){
            .userPic{
                width: 75px;
            }
            .dashboard{
                width: 90%;
            }
            #header{
                display: flex;
                justify-content: center;
            }
            #header .col-12{
                text-align: center;
                
            }

            #koinResponsive{
                display: flex;
                
                justify-content: center;
            }
        }

    </style>
@endsection

@section('content')
    <main class="d-block mx-4">
        <div class="container dashboard d-flex flex-column">

            <div class="card py-2 mb-4"  id="header">
                <div class="row d-flex justify-content-center">
                    <div class="col-4 col-sm-3 d-flex justify-content-center">
                        <div class="img-container">
                            <img src="{{ asset('assets/users/dummy_pic2.jpg') }}" id="user_Picture" class="userPic">
                        </div>
                        
                    </div>
                    <div class="col-12 col-sm py-2">
                        <div class="row">
                            <div class="col">
                                <h3 id="username" style="font-weight:bold;">Ini Nama Kelompok </h3>
                            </div>
                            
                        </div>
                        {{-- <div class="col colDashboard">
                            <h3 id="username" style="font-weight:bold;">Ini Nama Kelompok </h3>
                        </div> --}}
                        <div class="row">
                            <div class="col"  id="koinResponsive">
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

            <button id="btnAlat" class="btn btn-primary btnItems">Alat</button>
            <button id="btnBahan" class="btn btn-primary btnItems">Bahan</button>
            <button id="btnDowngrade" class="btn btn-primary btnItems">Downgrade</button>

            <div class="card" id="card-inv">
                
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">
                                    No.
                                </th>
                                <th scope="col">
                                    Nama
                                </th >
                                <th scope="col">
                                    Tersedia
                                </th>
                            </tr>
                        </thead>
                        <tbody id="items">
                            @foreach ($alat as $a)
                                <?php $helper = false; ?>
                                <tr>
                                    <td style="text-align: center;" scope="row">{{ $a->idalat }}</td>
                                    <td scope="row">{{ $a->nama_alat }}</td>
                                    @foreach ($inventory as $i)
                                        @if ($a->nama_alat == $i->nama_barang)
                                            <td style="text-align: center;" scope="row">{{ $i->stock_barang }}</td>
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
    </main>

    <script>
        $(".btnItems").click(function() {
            let itemType = ""
            switch (this.id) {
                case "btnAlat":
                    itemType = "alat"
                    break;
                case "btnBahan":
                    itemType = "bahan"
                    break;
                case "btnDowngrade":
                    itemType = "downgrade"
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
