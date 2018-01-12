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

    <div class="row marginbelow">
        <div class="col-md-12">
            @foreach ($watchlistItems as $item)
                {{ $item->title }}
            @endforeach
        </div>
    </div>

</div>
@endsection