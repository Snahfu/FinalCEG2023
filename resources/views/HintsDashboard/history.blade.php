@extends('layouts.app')

@section('content')

    <style>
        .card{
            box-shadow: 5px 10px 20px rgba(0, 0, 0, 0.2);
            border: 0px solid black;
            border-radius: 20px;
        }
    </style>
    <div class="container px-sm-4 py-2">
        <div class="row">
            <div class="card p-0">

                <!--Header-->
                <div class="card-header pt-3" style="background-color: white;text-align: center;">
                {{-- <div class="card-header pt-3" style="background-color: white;text-align: center;">
                    <h1 style="color:rgba(0, 0, 0, 0.704); font-weight: bold">Histori</h1>
                </div>
                </div> --}}
                <!--End Header-->

                <!--Card Body-->
                <div class="card-body mt-2">
                    {{-- <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">keterangan</th>
                                <th scope="col">created_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($histories->count())
                                @foreach ($histories as $history)
                                    <tr>
                                        <td>{{ $history->keterangan }}</td>
                                        <td>{{ $history->keterangan}}</td>
                                        <td>{{ $history->created_at }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <p class="text-center fs-4">No History Found</p>
                            @endif

                        </tbody>
                    </table> --}}

                    @php
                    $timezone = new DateTimeZone('Asia/Jakarta');
                    @endphp
                    <h1 style="color:rgba(0, 0, 0, 1); font-weight: bold; text-align:center">History</h1>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Jam</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($histories->count())
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($histories as $history)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $history->keterangan}}</td>
                                            @php
                                                $date_time = DateTime::createFromFormat('Y-m-d H:i:s', $history->created_at, $timezone);
                                                $formatted_date = $date_time->format('H:i');
                                            @endphp
                                            <td>{{  $formatted_date }}</td>
                                        </tr>
                                        @php
                                            $no +=1;
                                        @endphp
                                    @endforeach
                                @else
                                    <p class="text-center fs-4">No History Found</p>
                                @endif
                            </tbody>
                        </table>
                    </div>
@endsection
