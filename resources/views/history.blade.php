@extends('layouts.app')

@section('css')

    <!-- Styles -->
    <link href="{{ asset('css/pemain/history.css') }}" rel="stylesheet">
@endsection

@section('content')
    <main class="d-block mx-auto">
        <div class="container history d-flex flex-column">

            <div class="row my-2 my-md-3">
                <div class="col">
                    <h1 class="p-0 m-0" id="page-name">History</h1>
                </div>
                
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive rounded">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th width="15%">No.</th>
                                    <th>Keterangan</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($histories as $history)
                                    <tr>
                                        <td style="text-align: center;"><?php echo $i; ?></td>
                                        <td>{{ $history->keterangan }}</td>
                                        <td style="text-align: center;">{{ $history->created_at }}</td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="row d-flex justify-content-end">
                <div class="HeartAnimation d-flex justify-content-end"></div>
            </div>
        </div>
    </main>
    <script>
        $(function() {
            $(".HeartAnimation").click(function() {
                $(this).toggleClass("animate");
            });
        });
    </script>
@endsection
