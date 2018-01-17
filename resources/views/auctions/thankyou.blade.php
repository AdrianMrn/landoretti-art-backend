@extends('layouts.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('thankyou') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <h1>Thanks!</h1>
    </div>
</div>
@endsection
