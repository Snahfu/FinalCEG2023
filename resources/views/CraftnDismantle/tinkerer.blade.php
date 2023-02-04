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
                                @foreach ($downgrade as $dg)
                                    <option value="{{ $dg }}">{{ $dg }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td rowspan="3" style="text-align: center;">
                            None
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="downgrade_2" id="downgrade_2" class="selectDowngrade">
                                @foreach ($downgrade as $dg)
                                    <option value="{{ $dg }}">{{ $dg }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="downgrade_3" id="downgrade_3" class="selectDowngrade">
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
                            Mesin
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
                },
                error: function() {
                    alert("error")
                }
            })
        })
    </script>
@endsection
