@extends('layouts.app')

@section('css')
    <style>
        body {
            background: ;
        }

        h1:after {
            background-color: #000;
            content: "";
            display: inline-block;
            height: 2px;
            position: relative;
            vertical-align: middle;
            width: 25%;
        }

        /* h1:before {
                right: 0.5em;
                margin-left: 1.5%;
            } */

        h1:after {
            left: 0.5em;
            margin-right: 0%;
        }

        img {
            aspect-ratio: 1/1;
            object-fit: contain;
        }

        .btn-primary {
            padding: 3px 6px 3px 6px !important;
            font-size: 12px;
        }

        .harga {
            background: #d3d7a5;
        }

        .card-body .badge {
            /* background: #d3d7a5 !important; */
            font-size: 14px;
        }

        /* Responsive Grid Start */
        .cardBuy {
            display: flex;
        }

        .card-container {
            display: grid;
            grid-template-columns: auto auto auto auto auto;
        }

        .cardItems {
            width: auto;
            margin: 15px 10px 10px 10px !important;

            box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.4);
            transition: all 0.1s ease-in-out;
        }

        .cardItems:hover {
            transform: translateY(-2%);
            transition: all 0.15s ease-in-out;
        }

        .card-container .card-body {
            padding: 16px 12px 16px 12px;
        }

        .nomortb {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <main class="d-block mx-auto">
        <div class="container">

            <div class="row my-2 my-md-3 d-flex justify-content-center">
                <div class="col">
                    <h1 class="p-0 m-0">Buy</h1>
                </div>

            </div>

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Nama peralatan" aria-label="" aria-describedby="">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button">Button</button>
                </div>
            </div>
            <div class="row">
                {{-- Sisi Display --}}
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- START Baris Pertama --}}
                            <div class="inline-spacing">
                                <div class="card-container">
                                    @for ($i = 1; $i <= 41; $i++)
                                        <div class="card col-2 p-0 cardItems">
                                            <img src="{{ asset('assets/tools/knife.png') }}" class="card-img-top"
                                                alt="...">
                                            <div class="card-body text-center">
                                                <h6 class=""> Nama Kartu</h6>
                                                <div class="row my-1">
                                                    <div class="col">
                                                        Stock : <span class="">100</span>
                                                    </div>

                                                </div>
                                                <div class="d-flex justify-content-center my-1" style="font-size: 14px">

                                                    <span class="badge bg-danger mx-1">75</span>
                                                    <span class="badge bg-success mx-1">60</span>
                                                </div>

                                                <button class="btn btn-primary w-100" onclick="buy({{ $i }})"><i
                                                        class="fa-solid fa-cart-shopping mx-1"></i>Add</button>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            {{-- END Baris Pertama --}}

                        </div>
                    </div>
                </div>
                {{-- Sisi pembelian --}}
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row my-2">
                                {{-- Selection Team --}}
                                <div class="selection">
                                    <label class="text">Nama Team :</label>
                                    <select name="teams" id="teams" class="form-control selectpicker bordered"
                                        data-live-search="true" tabindex="-1" aria-label="team">
                                        {{-- <option value="-" selected disabled>-- Pilih Team --</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->idteams }}" data-tokens="{{ $team->idteams }}">
                                            {{ $team->namaTeam }}</option>
                                    @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="text">Daftar Penjualan/Pembelian:</div>
                            <div class="row">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td class="nomortb" width="15%">1.</td>
                                            <td width="70%">Pisau</td>
                                            <td><input type="number" style="width: 100px"></td>
                                        </tr>
                                        <tr>
                                            <td class="nomortb" width="15%">2.</td>
                                            <td width="70%">Kondensor</td>
                                            <td><input type="number" style="width: 100px"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success">Konfirmasi</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
