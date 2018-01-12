<?php

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

// Home > Blog
Breadcrumbs::register('auctions', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Auctions', url('auctions'));
});

// Home > Blog > [auction]
Breadcrumbs::register('auction', function ($breadcrumbs, $auction) {
    $breadcrumbs->parent('auctions');
    $breadcrumbs->push($auction->title, url('auctions', $auction->title));
});