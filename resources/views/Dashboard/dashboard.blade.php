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
    </style>
@endsection

@section('content')
    <main class="d-block mx-auto">
        <div class="container dashboard d-flex flex-column">
            <div class="koin">
                {{ $team[0]->koin }} Koin
            </div>
            <div class="d-flex">
                <button id="btnAlat" class="btn btn-primary btnItems">Alat</button>
                <button id="btnBahan" class="btn btn-primary btnItems">Bahan</button>
                <button id="btnDowngrade" class="btn btn-primary btnItems">Downgrade</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>
                            No.
                        </th>
                        <th>
                            Nama
                        </th>
                        <th>
                            Tersedia
                        </th>
                    </tr>
                </thead>
                <tbody id="items">
                    @foreach ($alat as $a)
                        <?php $helper = false; ?>
                        <tr>
                            <td style="text-align: center;">{{ $a->idalat }}</td>
                            <td>{{ $a->nama_alat }}</td>
                            @foreach ($inventory as $i)
                                @if ($a->nama_alat == $i->nama_barang)
                                    <td style="text-align: center;">{{ $i->stock_barang }}</td>
                                    <?php $helper = true; ?>
                                @endif
                            @endforeach
                            @if ($helper == false)
                                <td style="text-align: center;">0</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
