@extends('layouts.app')

@section('css')
    <style>
        table,
        tr,
        th,
        td {
            border: 1px solid black;
        }

        table {
            width: 100%
        }

        th {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <main class="d-block mx-auto">
        <div class="container history w-75">
            <h2>History</h2>

            <table>
                <tr>
                    <th style="width: 100px;">No.</th>
                    <th>Keterangan</th>
                    <th>Waktu</th>
                </tr>
                <?php $i = 1; ?>
                @foreach ($histories as $history)
                    <tr>
                        <td style="text-align: center;"><?php echo $i; ?></td>
                        <td>{{ $history->keterangan }}</td>
                        <td style="text-align: center;">{{ $history->created_at }}</td>
                    </tr>
                    <?php $i++; ?>
                @endforeach

            </table>

        </div>
    </main>
@endsection
