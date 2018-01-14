@extends('layouts.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('auctions') }}
@endsection

@section('pagination')
    {{ $auctions->links() }}
@endsection

@section('page-scripts')
    <script>
        $('#auctions-filter input').change(function() {$('form#auctions-filter').submit()});
    </script>
@endsection

@section('auction-filter')
    <div class="container filters">
        <form id="auctions-filter" method="GET" action="{{ url('auctions') }}">
            {{ csrf_field() }}
            <div class="row marginbelow">
                <div class="col-md-8">
                    <ul class="sortby filter-head">
                        SORT BY:
                        <li>
                            <input type='radio' value='soonest' name='sortby' id='sortby-soonest' hidden/>
                            <label for='sortby-soonest'>ending soonest</label>
                        </li> | 
                        <li>
                            <input type='radio' value='latest' name='sortby' id='sortby-latest' hidden/>
                            <label for='sortby-latest'>ending latest</label>
                        </li> | 
                        <li>
                            <input type='radio' value='newest' name='sortby' id='sortby-newest' hidden/>
                            <label for='sortby-newest'>newest first</label>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4"><a class="pull-right" href="#">Advanced options ></a></div>
            </div>
            <div class="row marginabove">
                <div class="col-md-3">
                    <span class="filter-head">Price</span>
                    <ul>
                        <li>
                            <input type='radio' value='any' name='price' id='price-any' hidden/>
                            <label for='price-any'>Any</label>
                        </li>
                        <li>
                            <input type='radio' value='0-5000' name='price' id='price-0-5000' hidden/>
                            <label for='price-0-5000'>Up to 5,000</label>
                        </li>
                        <li>
                            <input type='radio' value='5000-10000' name='price' id='price-5000-10000' hidden/>
                            <label for='price-5000-10000'>5,000 - 10,000</label>
                        </li>
                        <li>
                            <input type='radio' value='10000-25000' name='price' id='price-10000-25000' hidden/>
                            <label for='price-10000-25000'>10,000 - 25,000</label>
                        </li>
                        <li>
                            <input type='radio' value='25000-50000' name='price' id='price-25000-50000' hidden/>
                            <label for='price-25000-50000'>25,000 - 50,000</label>
                        </li>
                        <li>
                            <input type='radio' value='50000-100000' name='price' id='price-50000-100000' hidden/>
                            <label for='price-50000-100000'>50,000 - 100,000</label>
                        </li>
                        <li>
                            <input type='radio' value='above' name='price' id='price-above' hidden/>
                            <label for='price-above'>Above</label>
                        </li>
                    </ul>

                </div>
                <div class="col-md-3">
                    <span class="filter-head">Ending</span>
                    <ul>
                        <li>
                            <input type='radio' value='any' name='ending' id='ending-any' hidden/>
                            <label for='ending-any'>Any</label>
                        </li>
                        <li>
                            <input type='radio' value='today' name='ending' id='ending-today' hidden/>
                            <label for='ending-today'>Today</label>
                        </li>
                        <li>
                            <input type='radio' value='week' name='ending' id='ending-this-week' hidden/>
                            <label for='ending-this-week'>This week</label>
                        </li>
                        <li>
                            <input type='radio' value='month' name='ending' id='ending-this-month' hidden/>
                            <label for='ending-this-month'>This month</label>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <span class="filter-head">Era</span>
                    <ul>
                        <li>
                            <input type='radio' value='any' name='era' id='era-any' hidden/>
                            <label for='era-any'>Any</label>
                        </li>
                        <li>
                            <input type='radio' value='lt-1940' name='era' id='era-pre-war' hidden/>
                            <label for='era-pre-war'>Pre-war</label>
                        </li>
                        <li>
                            <input type='radio' value='1940-1960' name='era' id='era-1940-1960' hidden/>
                            <label for='era-1940-1960'>1940-1960</label>
                        </li>
                        <li>
                            <input type='radio' value='1960-1990' name='era' id='era-1960-1990' hidden/>
                            <label for='era-1960-1990'>1960-1990</label>
                        </li>
                        <li>
                            <input type='radio' value='1990-now' name='era' id='era-1990-present' hidden/>
                            <label for='era-1990-present'>1990-present</label>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <span class="filter-head">Style</span>
                    <ul>
                        <li>
                            <input type='radio' value='any' name='style' id='style-any' hidden/>
                            <label for='style-any'>Any</label>
                        </li>
                        @foreach ($styles as $style)
                        <li>
                            <input type='radio' value='{{ $style->name }}' name='style' id='style-{{ $style->name }}' hidden/>
                            <label for='style-{{ $style->name }}'>{{ $style->name }}</label>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </form>
        <hr>
    </div>
@endsection

@section('content')
<div class="container">
    <!-- <div class="row">
        <div class="col-md-4">
            <h2>Auctions</h2>
        </div>
    </div> -->

    <div class="row marginbelow">
        <div class="col-md-12">
            <div class="auctionlist bigitem">big</div>

            @foreach ($auctions as $auction)
                <div class="auctionlist smallitem">
                    <div class="auctionlist-image" title="$auction->title" style="background-image: url('{{ asset($auction->imageArtwork) }}');"></div>
                    <div class="auctionlist-info">
                        <p class="auctionyear">{{ $auction->year }}</p>
                        <p class="auctiontitle">{{ $auction->title }}</p>
                        <p class="auctionprice">€ {{ $auction->estimatedPrice() }}</p>
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