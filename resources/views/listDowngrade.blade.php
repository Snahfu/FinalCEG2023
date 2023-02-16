@extends('layouts.app')

@section('css')
    <style>
        table{
            font-size: 16px;
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

        @media screen and (max-width:768px){
            .listDowngrade{
                width: 100%;
            }
            table{
                font-size: 12px
            }
        }
    </style>
    
@endsection

@section('content')
    <main class="d-block mx-md-4 my-5">
        <div class="container listDowngrade d-flex flex-column sm-p-0">
            <div class="">
                <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th style="text-align: start">Pilih Alat :</th>
                        <th>Downgrade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="3" style="vertical-align: middle">
                            <div class="div">
                                <select name="alat" id="alat" class="form-control selectpicker" data-live-search="true" tabindex="-1" aria-label="alat" style="max-width: 200px">
                                <option value="-" data-tokens="-">-- Pilih mesin --</option>
                                @foreach ($alat as $a)
                                    <option value="{{ $a->idalat }}" data-tokens="{{ $a->nama_alat }}">{{ $a->nama_alat }}</option>
                                @endforeach
                            </select>
                            </div>
                            
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
