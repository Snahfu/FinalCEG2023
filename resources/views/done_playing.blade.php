@extends('layouts.app')

@section('css')
    <!-- Styles -->
    <link href="{{ asset('css/pemain/dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    <main class="d-block mx-1 sm-mx-4">
        <div class="container dashboard d-flex flex-column">

            <div class="row my-2 my-md-3">
                <div class="col">
                    <h1 class="p-0 m-0">List Done Playing</h1>
                </div>

            </div>

            <div class="card my-4" id="card-inv">
                <div class="card-body">
                    <div class="row">

                        <div class="col">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" width="15%">
                                                No.
                                            </th>
                                            <th scope="col" width="40%">
                                                Nama
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="items" class="table-group-divider">
                                        <?php $no = 1; ?>
                                        @foreach ($teams as $team)
                                            <?php $helper = false; ?>
                                            <tr>
                                                <td style="text-align: center;" scope="row"><?php echo $no; ?></td>
                                                <td scope="row" style="text-align: center;">{{ $team->namaTeam }}</td>
                                                <?php $helper = true; ?>
                                            </tr>
                                            <?php $no++; ?>
                                        @endforeach
                                        <?php $helper = false; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>

    {{-- JQUERY --}}
    <script>

    </script>
@endsection
