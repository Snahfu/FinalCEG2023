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
    </style>
@endsection

@section('content')
    <div class="d-flex">
        <button id="btnAlat" class="btn btn-primary btnItems">Alat</button>
        <button id="btnBahan" class="btn btn-primary btnItems">Bahan</button>
        <button id="btnDowngrade" class="btn btn-primary btnItems">Downgrade</button>
    </div>
    <table>
        <thead>
            <tr>
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
                    <td>{{ $a->nama_alat }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>

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
                    $("#items").html("")
                    $.each(result, function(key, value) {
                        switch (itemType) {
                            case "alat":
                                $("#items").append(`
                                <tr>
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
                                    <td>
                                        ${value.nama_downgrade}
                                    </td>
                                    <td>

                                    </td>
                                </tr>`)
                                break;
                        }
                    })
                },
                error: function() {
                    alert("error")
                }
            })
        })
    </script>
@endsection
