@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <h2>{{ $auction->title }}</h2>
                </div>
            </div>
            <div class="row marginbelow">
                <div class="col-md-4">
                    <span>timeleft + (amount of bids) + add to watchlist</span>
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
                        <div class="col-md-12 bg-black">
                            <img class="img-center" src="{{ asset('') . $auction->imageArtwork }}" height="300">                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 bg-black">
                            <img class="img-center" src="{{ asset('') . $auction->imageArtwork }}" height="150">
                        </div>
                        <div class="col-md-4 bg-black">
                            <img class="img-center" src="{{ asset('') . $auction->imageSignature }}" height="150">
                        </div>
                        @if ($auction->imageOptional)
                        <div class="col-md-4 bg-black">
                            <img class="img-center" src="{{ asset('') . $auction->imageOptional }}" height="150">
                        </div>
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
                        timeleft
                    </div>
                    <div class="row">
                        {{ $auction->endDate }}
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
                        <span>bids: </span> <!-- future: add amount of bids -->
                        
                        <form class="form-inline" method="POST" action="{{ url('bid') }}">
                            {{ csrf_field() }}
                            <div class="form-group mb-2">
                                <input id="amount" placeholder="amount" type="number" class="form-control" name="amount" required>
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
