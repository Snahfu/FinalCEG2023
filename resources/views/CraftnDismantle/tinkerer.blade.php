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
    </style>
@endsection

@section('content')
    <main>
        <div class="container tinkerer">
            {{-- Crafting --}}
            <h2>Crafting</h2>
            <table>
                <thead>
                    <tr>
                        <th>Alat</th>
                        <th>Downgrade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="downgrade_1" id="downgrade_1" class="selectDowngrade">
                                <option value="-">-</option>
                                @foreach ($downgrade as $dg)
                                    <option value="{{ $dg }}">{{ $dg }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td id="hasil_alat" rowspan="3" style="text-align: center;">
                            <h3>None</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="downgrade_2" id="downgrade_2" class="selectDowngrade">
                                <option value="-">-</option>
                                @foreach ($downgrade as $dg)
                                    <option value="{{ $dg }}">{{ $dg }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="downgrade_3" id="downgrade_3" class="selectDowngrade">
                                <option value="-">-</option>
                                @foreach ($downgrade as $dg)
                                    <option value="{{ $dg }}">{{ $dg }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-primary">Craft</button>

            <div class="spacing"></div>

            {{-- Dismantling --}}
            <h2>Dismantle</h2>
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
                                @foreach ($alat as $a)
                                    <option value="{{ $a->idalat }}">{{ $a->nama_alat }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td id="dismantle_1">
                            Motor
                        </td>
                    </tr>
                    <tr>
                        <td id="dismantle_2">
                            Pump
                        </td>
                    </tr>
                    <tr>
                        <td id="dismantle_3">
                            Tub
                        </td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-primary">Dismantle</button>
        </div>
    </main>

    <script>
        // Crafting
        $(".selectDowngrade").change(function() {
            $.ajax({
                type: "POST",
                url: "{{ route('change.downgrade') }}",
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'downgrade_1': $("#downgrade_1").val(),
                    'downgrade_2': $("#downgrade_2").val(),
                    'downgrade_3': $("#downgrade_3").val(),
                },
                success: function(data) {
                    let result = data.data
                    let count = data.count

                    // console.log(result)
                    $("#hasil_alat").html("<h3>None</h3>")

                    if (count > 1) {
                        $("#hasil_alat").html(`
                            <select name="select_hasil_alat" id="select_hasil_alat">
                                <option>${result[0].nama_alat}</option>
                                <option>${result[1].nama_alat}</option>
                            </select>
                        `)
                    } else if (count > 0) {
                        $("#hasil_alat").html(`<h3>${result[0].nama_alat}</h3>`)
                    }
                },
                error: function() {
                    alert("error")
                }
            })
        })

        // Dismantle
        $("#alat").change(function() {
            $.ajax({
                type: "POST",
                url: "{{ route('change.alat') }}",
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'selectedAlat': $("#alat").val()
                },
                success: function(data) {
                    let result = data.data
                    for (let x = 1; x <= 3; x++) {
                        $(`#dismantle_${x}`).html(result[x - 1])
                    }

                    if (result.length == 2) {
                        $(`#dismantle_3`).html("-")
                    }
                },
                error: function() {
                    alert("error")
                }
            })
        })
    </script>
@endsection
