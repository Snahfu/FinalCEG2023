@extends('layouts.app')

@section('css')
    <style>

    </style>
@endsection

@section('content')
    <main>
        <div>
            <h2 id="sesiNow">Sesi {{}}</h2>
            <button id="backSesi" class="btn btn-primary"><i class="fa-regular fa-chevron-left"></i></button>
            <button id="nextSesi" class="btn btn-primary"><i class="fa-regular fa-chevron-right"></i></button>
        </div>
    </main>
@endsection
