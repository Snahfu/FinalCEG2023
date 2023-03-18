@php
    // dd($hints);
    // dump($hints);
    // echo json_encode($hints);
    // die;
@endphp
@extends('layouts.app')

@section('css')
    <!-- Styles -->
    <link href="{{ asset('css/pos/template.css') }}" rel="stylesheet">

    <style>
        .gifCont {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px;
            transition: all 0.1s ease-in-out;
            background-image: url({{ asset('assets/hiburan/wednesdaymorning.gif') }});
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;


        }

        .gifCont:hover {
            transition: all 0.1s ease-in-out;
            background-image: url({{ asset('assets/hiburan/melastnight.gif') }});
        }

        .scale-img{
            /* transform: scale(0.5); */
            width: 300px;
            height: auto;
        }
    </style>
@endsection

@section('content')
    @if($hints->count())
        {{-- <p class="text-center fs-4">Tim Anda Memiliki Hint</p> --}}
            <div class="container">
                <div class="row">
                    @foreach ($hints as $hint)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div>
                                    <img src="{{$hint->url_hint }}" class="card-img-top scale-img rounded mx-auto d-block" alt="{{ $hint->name }}">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $hint->name }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    @else
        <p class="text-center fs-4">Tim Anda Belum Memiliki Hint</p>
    @endif

@endsection