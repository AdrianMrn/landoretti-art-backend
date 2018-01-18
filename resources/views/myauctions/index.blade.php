@extends('layouts.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('myauctions') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h2>My auctions</h2>
        </div>
    </div>


    <div class="row marginbelow">
        <div class="col-md-12">
            <button onclick="location.href = '{{ url('auctions/create') }}';" class="btn btn-default pull-right">CREATE NEW ></button>
            <h4>Active</h4>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th colspan="2" scope="col">Auction details</th>
                        <th scope="col">Estimated price</th>
                        <th scope="col">End date</th>
                        <th scope="col">Remaining time</th>
                    </tr>
                </thead>
            
                <tbody class="watchlist-table-body">
                    @foreach ($auctions as $auction)
                    @if ($auction->status == 'active')
                    <tr>
                        <td class="watchlist-image"><a href="{{ url('auctions', [$auction->title]) }}"><img src="{{ $auction->imageArtwork }}" alt="{{ $auction->title }}"></a></td>
                        <td><p class="auctiontitle"><a href="{{ url('auctions', [$auction->title]) }}">{{ $auction->title }}</a></p><p class="auctionyear">{{ $auction->year }}</p></td>
                        <td>€ {{ $auction->estimatedPrice() }}</td>
                        <td>{{ $auction->endDateFormatted() }}</td>
                        <td>{{ $auction->timeleft() }}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>

            <h4>Expired</h4>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th colspan="2" scope="col">Auction details</th>
                        <th scope="col">Estimated price</th>
                        <th scope="col">End date</th>
                        <th scope="col">Remaining time</th>
                    </tr>
                </thead>
            
                <tbody class="watchlist-table-body">
                    @foreach ($auctions as $auction)
                    @if ($auction->status == 'expired')
                    <tr>
                        <td class="watchlist-image"><a href="{{ url('auctions', [$auction->title]) }}"><img src="{{ $auction->imageArtwork }}" alt="{{ $auction->title }}"></a></td>
                        <td><p class="auctiontitle"><a href="{{ url('auctions', [$auction->title]) }}">{{ $auction->title }}</a></p><p class="auctionyear">{{ $auction->year }}</p></td>
                        <td>€ {{ $auction->estimatedPrice() }}</td>
                        <td>{{ $auction->endDateFormatted() }}</td>
                        <td>{{ $auction->timeleft() }}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>

            <h4>Sold</h4>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th colspan="2" scope="col">Auction details</th>
                        <th scope="col">Estimated price</th>
                        <th scope="col">End date</th>
                        <th scope="col">Remaining time</th>
                    </tr>
                </thead>
            
                <tbody class="watchlist-table-body">
                    @foreach ($auctions as $auction)
                    @if ($auction->status == 'sold')
                    <tr>
                        <td class="watchlist-image"><a href="{{ url('auctions', [$auction->title]) }}"><img src="{{ $auction->imageArtwork }}" alt="{{ $auction->title }}"></a></td>
                        <td><p class="auctiontitle"><a href="{{ url('auctions', [$auction->title]) }}">{{ $auction->title }}</a></p><p class="auctionyear">{{ $auction->year }}</p></td>
                        <td>€ {{ $auction->estimatedPrice() }}</td>
                        <td>{{ $auction->endDateFormatted() }}</td>
                        <td>{{ $auction->timeleft() }}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>

</div>
@endsection