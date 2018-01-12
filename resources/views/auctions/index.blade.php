@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="row">
        <div class="col-md-4">
            <h2>Auctions</h2>
        </div>
    </div> -->

    <div class="pull-right">{{ $auctions->links() }}</div>

    <div class="row marginbelow">
        <div class="col-md-12">
            <div class="auctionlist bigitem">big</div>

            @foreach ($auctions as $auction)
                <div class="auctionlist smallitem">
                    <div class="auctionlist-image" style="background-image: url('{{ asset($auction->imageArtwork) }}');"></div>
                    <div class="auctionlist-info">
                        <p class="auctionyear">{{ $auction->year }}</p>
                        <p class="auctiontitle">{{ $auction->title }}</p>
                        <p class="auctionprice">€ {{ $auction->priceMinEst }}</p>
                        <p class="time-and-price">
                            <span>{{ $auction->timeleft() }}</span>
                            <a href="{{ url('auctions', [$auction->title]) }}" class="pull-right">VISIT AUCTION ></a>
                        </p>
                        
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="pull-right">{{ $auctions->links() }}</div>

</div>
@endsection