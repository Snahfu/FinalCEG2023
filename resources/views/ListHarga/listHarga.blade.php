@extends('layouts.app')

@section('css')
    <!-- Styles -->
    <link href="{{ asset('css/pemain/dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    <main class="d-block mx-1 sm-mx-4">
        <div class="container dashboard d-flex flex-column">

            <div class="row my-2 my-md-3">
                <div class="col">
                    <h1 class="p-0 m-0" id="page-name">List Harga</h1>
                </div>

            </div>

            <div class="card my-4" id="card-inv">
                <div class="card-body">
                    <div class="row">

                        <div class="col">
                            <div class="d-flex flex-row " style="margin-bottom: 0px;">
                                <div class="btnItems tab d-flex align-items-center  justify-content-center activeTab"
                                    id="btnBahan">
                                    <a href="#">Bahan</a>
                                </div>
                                <div class="btnItems tab d-flex align-items-center  justify-content-center"
                                    id="btnDowngrade">
                                    <a href="#">Downgrade</a>
                                </div>

                            </div>



                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" width="15%">
                                                No.
                                            </th>
                                            <th scope="col" width="40%" style="text-align: left;">
                                                Nama
                                            </th>
                                            <th scope="col" width="20%">
                                                Harga Jual
                                            </th>
                                            <th scope="col" width="20%">
                                                Harga Beli
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="items" class="table-group-divider">
                                        <?php $no = 1; ?>
                                        @foreach ($bahan as $eachBahan)
                                            <?php $helper = false; ?>
                                            <tr>
                                                <td style="text-align: center;" scope="row"><?php echo $no; ?></td>
                                                <td scope="row">{{ $eachBahan->bahan }}</td>
                                                <td style="text-align: center;" scope="row">{{ $eachBahan->harga_jual }}
                                                </td>
                                                <td style="text-align: center;" scope="row">{{ $eachBahan->harga_beli }}
                                                </td>
                                                <?php $helper = true; ?>
                                            </tr>
                                            <?php $no++; ?>
                                        @endforeach
                                        <?php $helper = false; ?>
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
                url: "{{ route('listHargaItems') }}",
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
                            case "bahan":
                                let helperBahan = false;
                                $.each(data.bahan, function(key1, value1) {
                                    if (value.nama_bahan == value1.bahan) {
                                        $("#items").append(`
                                        <tr>
                                            <td style="text-align: center;">
                                                ${num}
                                            </td>
                                            <td>
                                                ${value.bahan}
                                            </td>
                                            <td style="text-align: center;">
                                                ${value1.harga_jual}
                                            </td>
                                            <td style="text-align: center;">
                                                ${value1.harga_beli}
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
                                            ${value.bahan}
                                        </td>
                                        <td style="text-align: center;">
                                            ${value.harga_jual}
                                        </td>
                                        <td style="text-align: center;">
                                            ${value.harga_beli}
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
                                                ${value.harga_jual}
                                            </td>
                                            <td style="text-align: center;">
                                                ${value.harga_beli}
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
                                                ${value.downgrade}
                                            </td>
                                            <td style="text-align: center;">
                                                ${value.harga_jual}
                                            </td>
                                            <td style="text-align: center;">
                                                ${value.harga_beli}
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
