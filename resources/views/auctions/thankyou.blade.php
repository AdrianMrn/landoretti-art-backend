@extends('layouts.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('auction', $auction) }}
@endsection

@section('content')
<div class="container">
    <form id="toggle-watchlist" method="POST" action="{{ url('watchlist') }}">
        {{ csrf_field() }}
        <input type="hidden" id="auctionId" name="auctionId" value="{{ $auction->id }}">
    </form>

    <div class="row">
        <h1>Thanks!</h1>
    </div>
</div>
@endsection
