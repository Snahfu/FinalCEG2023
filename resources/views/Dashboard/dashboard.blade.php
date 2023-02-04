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

        .dashboard{
            width: 60%;
        }
    </style>
@endsection

@section('content')
    <main class="d-block mx-auto">
        <div class="container dashboard d-flex flex-column">
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
                        <tr>
                            <td style="text-align: center;">{{ $a->idalat }}</td>
                            <td>{{ $a->nama_alat }}</td>
                            <td></td>
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
                                $("#items").append(`
                                <tr>
                                    <td style="text-align: center;">
                                        ${num}
                                    </td>
                                    <td>
                                        ${value.nama_alat}
                                    </td>
                                    <td>

                                    </td>
                                </tr>`)
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
                                    <td>

                                    </td>
                                </tr>`)
                                break;
                            case "downgrade":
                                $("#items").append(`
                                <tr>
                                    <td style="text-align: center;">
                                        ${num}
                                    </td>
                                    <td>
                                        ${value.nama_downgrade}
                                    </td>
                                    <td>

                                    </td>
                                </tr>`)
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
