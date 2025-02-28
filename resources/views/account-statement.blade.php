@extends('portfolio')

@section('title', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/history.css') }}">
@endpush

@section('content')
    <h2>Account-statement</h2>

    <table class="table table-bordered table-striped" style="margin-top: 10px;">
        <thead class="table-dark">
            <tr>
                <th>S.N</th>
                <th>Portfolio-Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="portfolioTable">
            @foreach ($portfolios as $portfolio)
                <tr>

                    <td>{{ $portfolio->id }}</td>
                    <td>{{ $portfolio->portfolio_name }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/ind-acc?portfolio_id={{ $portfolio->id }}">View</a>

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
