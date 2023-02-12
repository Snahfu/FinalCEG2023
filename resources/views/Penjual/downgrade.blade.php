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
        }

        td {
            padding: 0 10px;
        }

        .dashboard {
            width: 60%;
        }
    </style>
@endsection

@section('content')
<main class="d-block mx-auto">
    <div class="container dashboard d-flex flex-column">
        <table>
            <thead>
                <tr>
                    <th>
                        No.
                    </th>
                    <th>
                        Nama Downgrade
                    </th>
                    <th>
                        Stock
                    </th>
                </tr>
            </thead>
            <tbody id="items">
                
            </tbody>
        </table>
    </div>
</main>
@endsection
