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
            padding: 0 15px;
        }

        td {
            padding: 10px 15px;
        }

        .listDowngrade{
            width: 60%;
        }
    </style>
@endsection

@section('content')
    <main class="d-block mx-4">
        <div class="container listDowngrade d-flex flex-column">
            <table>
                <thead>
                    <tr>
                        <th>Alat</th>
                        <th>Downgrade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="3">
                            <select name="alat" id="alat">
                                <option value="-">-</option>
                                @foreach ($alat as $a)
                                    <option value="{{ $a->idalat }}">{{ $a->nama_alat }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td id="downgrade_1">
                            -
                        </td>
                    </tr>
                    <tr>
                        <td id="downgrade_2">
                            -
                        </td>
                    </tr>
                    <tr>
                        <td id="downgrade_3">
                            -
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        $("#alat").change(function() {
            if ($("#alat").val() == "-") {
                for (let x = 1; x <= 3; x++) {
                    $(`#dismantle_${x}`).html("-")
                }
            } else {
                $.ajax({
                    type: "POST",
                    url: "{{ route('listDowngrade.alat') }}",
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'selectedAlat': $("#alat").val()
                    },
                    success: function(data) {
                        let result = data.data
                        for (let x = 1; x <= 3; x++) {
                            $(`#downgrade_${x}`).html(result[x - 1])
                        }

                        if (result.length == 2) {
                            $(`#downgrade_3`).html("-")
                        }
                    },
                    error: function() {
                        alert("error")
                    }
                })
            }

        })
    </script>
@endsection
