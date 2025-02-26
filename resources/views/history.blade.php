@extends('portfolio')

@section('title', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/history.css') }}">
@endpush

@section('content')

        <table class="table table-bordered table-striped" style="margin-top: 10px;">
            <thead class="table-dark">
                <tr>
                    <th>S.N</th>
                    <th>Portfolio-Name</th>
                    <th>Total Buys</th>
                    <th>Total sold</th>
                    <th>Total transactions</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="portfolioTable">
                @foreach($portfolios as $portfolio)
                <tr>
                    <td>{{ $portfolio->id }}</td>
                    <td>{{ $portfolio->portfolio_name }}</td>
                    <td>{{$totalbuy}}</td>
                    <td>{{$totalsell}}</td>
                    <td>{{$totaltransactions}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/ind-history?portfolio_id={{ $portfolio->id }}">View</a>
        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>



@endsection
@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
