@extends('layouts.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('watchlist') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h2>My watchlist</h2>
        </div>
    </div>

    <form id="watchlist-clear" method="POST" action="{{ route('clearWatchlist') }}">
        {{ csrf_field() }}
    </form>

    <div class="row marginbelow">
        <div class="col-md-6">filter buttons</div>
        <div class="col-md-6">
            <div class="pull-right">
                <button type="submit" class="btn-sm btn-default pull-left" form="watchlist-form">DELETE SELECTED ></button>
                <button type="submit" class="btn-sm btn-default pull-left marginleft" form="watchlist-clear">CLEAR WATCHLIST ></button>
            </div>
        </div>
    </div>

    <div class="row marginbelow">
        <div class="col-md-12">
            <form id="watchlist-form" method="POST" action="{{ route('watchlist.destroy', ['id' => 0]) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="3" scope="col">Auction details</th>
                            <th scope="col">Estimated price</th>
                            <th scope="col">End date</th>
                            <th scope="col">Remaining time</th>
                        </tr>
                    </thead>
                
                    <tbody class="watchlist-table-body">
                        @foreach ($watchlistItems as $item)
                        <tr>
                            <td><input class="form-check-input" type="checkbox" name="delete_items[]" value="{{ $item->id }}" id="{{ $item->id }}"></td>
                            <td class="watchlist-image"><img src="{{ $item->imageArtwork }}" alt="{{ $item->title }}"></td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->priceMinEst }}</td>
                            <td>{{ $item->endDateFormatted() }}</td>
                            <td>{{ $item->timeleft() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>

</div>
@endsection