@extends('layouts.app')

@section('css')
    <style>
        .card {
            border-radius: 20px;
            box-shadow: 5px 10px 20px rgba(0, 0, 0, 0.2);
        }

        h1 {
            overflow: hidden;
            text-align: left;
        }

        h1:after {
            background-color: #000;
            content: "";
            display: inline-block;
            height: 2px;
            position: relative;
            vertical-align: middle;
            width: 100%;
        }

        h1:after {
            left: 0.5em;
            margin-right: -50%;
        }

        .selection {
            max-width: 500px;
        }

        .text,
        .filter-option {
            font-size: 14px;
        }

        table {
            font-size: 14px;
        }

        th {
            text-align: center;
            padding: 0 15px;
        }

        td {
            padding: 10px 15px;
        }

        .listDowngrade {
            width: 60%;
        }

        .downgrade {
            height: 150px;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .show {
            height: 250px;
        }

        .dropdown {
            border: 1px solid black !important;
        }

        @media screen and (max-width:768px) {

            .text,
            .filter-option {
                font-size: 12px;
            }

            .listDowngrade {
                width: 100%;
            }

            table {
                font-size: 12px
            }
        }

        @media screen and (max-width:575px) {
            h1 {
                font-size: 18px;
            }

            h1:after {
                background-color: #000;
                content: "";
                display: inline-block;
                height: 1px;
                position: relative;
                vertical-align: middle;
                width: 40%;
            }
        }
    </style>
@endsection

@section('content')
    <main class="d-block mx-md-4">
        <div class="container listDowngrade d-flex flex-column sm-p-0">

            <div class="row my-3">
                <div class="col">
                    <h1 class="p-0 m-0">List Downgrade</h1>
                </div>

            </div>

            {{-- Start of Card --}}
            <div class="card mt-3">
                <div class="card-body">

                    <div class="selection">
                        <span style="font-size:14px;">Pilih Alat :</span>
                        <select name="alat" id="alat" class="form-control selectpicker bordered "
                            data-live-search="true" tabindex="-1" aria-label="alat"
                            style="max-width: 200px;font-size:14px;">
                            <option value="-" data-tokens="-" selected disabled>-- Pilih mesin --</option>
                            @foreach ($alat as $a)
                                <option value="{{ $a->idalat }}" data-tokens="{{ $a->nama_alat }}">{{ $a->nama_alat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center mt-3 border border-dark" style="background-color: #dddddd; border-radius: 100px;">Downgrade</div>
                    <div class="row">
                        <div class="col downgrade" id="downgrade_1">

                        </div>
                        <div class="col downgrade" id="downgrade_2">

                        </div>
                        <div class="col downgrade" id="downgrade_3">

                        </div>

                    </div>


                    {{-- <div class="table-responsive" style="height:400px;">
                        <!-- Start of Table -->
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
                                            <select name="alat" id="alat" class="form-control selectpicker bordered " data-live-search="true" tabindex="-1" aria-label="alat" style="max-width: 200px">
                                            <option value="-" data-tokens="-" selected disabled>-- Pilih mesin --</option>
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
                        <!-- End of Table -->
                    </div> --}}
                </div>
            </div>
            {{-- End of Card --}}
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
