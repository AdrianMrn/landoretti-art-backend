<?php

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

// Home > Auctions
Breadcrumbs::register('auctions', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Auctions', url('auctions'));
});

// Home > Auctions > [auction]
Breadcrumbs::register('auction', function ($breadcrumbs, $auction) {
    $breadcrumbs->parent('auctions');
    $breadcrumbs->push($auction->title, url('auctions', $auction->title));
});

// Home > Watchlist
Breadcrumbs::register('watchlist', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Watchlist', url('watchlist'));
});

// Home > Watchlist
Breadcrumbs::register('myauctions', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('My auctions', url('myauctions'));
});