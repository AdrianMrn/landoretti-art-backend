@extends('layouts.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('auction', $auction) }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $auction->title }}</h2>
                </div>
            </div>
            <div class="row marginbelow">
                <div class="col-md-12">
                    <span>{{ $auction->timeleft() }} &nbsp ({{ $auction->amountOfBids() }} bids) &nbsp add to watchlist</span>
                </div>
            </div>
            
            <!-- future: complete errors (in alert box w/ red background) -->
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                <div class="row">
                    <div class="row-md-9">
                        <div class="alert alert-danger"><strong>{{ $error }}</strong></div>
                    </div>
                </div>
                @endforeach
            @endif

            
            <div class="row marginbelow">
                <div class="col-md-7">
                    <div class="row marginbelow">
                        <div class="col-md-12 auction-detail-img auction-detail-img-big" style="background-image: url('{{ asset($auction->imageArtwork) }}');"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 auction-detail-img auction-detail-img-small" style="background-image: url('{{ asset($auction->imageArtwork) }}');"></div>
                        <div class="col-md-4 auction-detail-img auction-detail-img-small" style="background-image: url('{{ asset($auction->imageSignature) }}');"></div>
                        @if ($auction->imageOptional)
                        <div class="col-md-4 auction-detail-img auction-detail-img-small" style="background-image: url('{{ asset($auction->imageOptional) }}');"></div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-1 auction-sidebar">
                    <div class="row">
                        <h3 class="auction-title">{{ $auction->title }}</h3>
                    </div>
                    <div class="row">
                        <span>{{ $auction->year }}</span>
                    </div><hr>
                    <div class="row">
                        <span class="auctiondetail-timeleft">{{ $auction->timeleft() }} left</span>
                    </div>
                    <div class="row">
                        <span>{{ $auction->endDate }}</span>
                    </div><hr>
                    <div class="row marginbelow">
                        <p>If you wish to bid on this auction, enter your bid amount below and press BID NOW.</p>
                    </div>
                    <div class="row bid-box">
                        <span>Estimated price:</span><br>
                        <span>€{{ $auction->priceMinEst }} - €{{ $auction->priceMaxEst }}</span><br>
                        @if ($auction->priceBuyout)
                        <a href="#" >Buy now for €{{ $auction->priceBuyout }}</a> <!-- future: link to thank you page -->
                        @endif<br><br>
                        <span class="pull-left">Current highest bid: {{$auction->highestBidAmount()}}</span>
                        <span>bids: {{ $auction->amountOfBids() }} </span> <!-- future: add amount of bids -->
                        
                        <form class="form-inline" method="POST" action="{{ url('bid') }}">
                            {{ csrf_field() }}
                            <input type="hidden" id="auctionid" name="auctionid" value="{{ $auction->id }}">
                            <div class="form-group mb-2">
                                <input id="amount" placeholder="amount" type="number" class="form-control" name="amount" value="{{ $auction->highestBidAmount() + 5 }}" required>
                            </div>
                            <button type="submit" class="btn">BID NOW ></button>
                        </form>

                        <a class="add-to-watchlist" href="#">Add to my watchlist</a>

                    </div>
                </div>
            </div>

            <div class="row auction-info">
                <div class="col-md-8">
                    <strong>Description</strong>
                    <p>{{ $auction->description }}</p>

                    <strong>Condition</strong>
                    <p>{{ $auction->condition }}</p>
                </div>

                <div class="col-md-4">
                    <strong>Origin</strong>
                    <p>{{ $auction->origin }}</p>

                    <strong>Dimensions</strong>
                    <p>{{ $auction->height }} x {{ $auction->width }}
                        @if ($auction->depth)
                        x {{ $auction->depth }}
                        @endif
                        cm
                    </p>
                        
                    <strong>Style</strong>
                    <p>{{ $auction->style }}</p><br/>

                    <button class="btn">ASK A QUESTION ABOUT THIS AUCTION</button>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
