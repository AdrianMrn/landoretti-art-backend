@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row marginbelow">
                <div class="col-md-4">
                    <h2>Add a new auction</h2>
                </div>
            </div>

            <!-- future: complete errors (in alert box w/ red background) -->
            <!-- (in col-md-9 instead of col-md-12!!!) -->
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

            @if ($errors->has('country'))
                <span class="help-block">
                    <strong>{{ $errors->first('country') }}</strong>
                </span>
            @endif

            @if ($errors->has('zipcode'))
                <span class="help-block">
                    <strong>{{ $errors->first('zipcode') }}</strong>
                </span>
            @endif

            @if ($errors->has('city'))
                <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
            @endif

            @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif

            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif

            @if ($errors->has('accountnumber'))
                <span class="help-block">
                    <strong>{{ $errors->first('accountnumber') }}</strong>
                </span>
            @endif

            @if ($errors->has('vatnumber'))
                <span class="help-block">
                    <strong>{{ $errors->first('vatnumber') }}</strong>
                </span>
            @endif

            @if ($errors->has('terms'))
                <span class="help-block">
                    <strong>{{ $errors->first('terms') }}</strong>
                </span>
            @endif

            <form method="POST" action="{{ url('auction') }}">
                {{ csrf_field() }}
                <div class="row marginbelow">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <select class="form-control" id="style"  value="{{ old('style') }}" required autofocus>
                                <option value="" disabled selected>Style</option>
                                @foreach ($styles as $style)
                                    <option>{{ $style->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">Auction title</label>
                            <input id="title" placeholder="Auction title" type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                            <label for="year" class="control-label">Year</label>
                            <input id="year" placeholder="XXXX" type="number" class="form-control" name="year" value="{{ old('year') }}" required>
                        </div>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('width') ? ' has-error' : '' }}">
                            <label for="width" class="control-label">Width</label>
                            <input id="width" placeholder="XXXX" type="text" class="form-control" name="width" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('height') ? ' has-error' : '' }}">
                            <label for="height" class="control-label">Height</label>
                            <input id="height" placeholder="XXXX" type="text" class="form-control" name="height" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('depth') ? ' has-error' : '' }}">
                            <label for="depth" class="control-label">Depth (optional)</label>
                            <input id="depth" placeholder="XXXX" type="text" class="form-control" name="depth" required>
                        </div>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-9">
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="control-label">Description</label>
                            <textarea id="description" placeholder="Describe your auction as thoroughly as possible" type="text" class="form-control" name="description" value="{{ old('description') }}" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-9">
                        <div class="form-group{{ $errors->has('condition') ? ' has-error' : '' }}">
                            <label for="condition" class="control-label">Condition</label>
                            <textarea id="condition" placeholder="What is the condition of the artwork?" type="text" class="form-control" name="condition" value="{{ old('condition') }}" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-8">
                        <div class="form-group{{ $errors->has('origin') ? ' has-error' : '' }}">
                            <label for="origin" class="control-label">Origin</label>
                            <input id="origin" placeholder="What is the origin of the artwork?" type="text" class="form-control" name="origin" required>
                        </div>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-8">
                        <div class="form-group{{ $errors->has('photos') ? ' has-error' : '' }}">
                            <label for="origin" class="control-label">Photos</label>
                            <p>Please upload one picture with the signature of the artwork and one picture of the artwork itself.</p>
                            <p>You can upload up to 3 pictures with a maximum of 10MB each.</p>
                            future: image uploads
                        </div>
                    </div>
                </div>

                <h3>Pricing</h3>
                <div class="row marginbelow">
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('priceMinEst') ? ' has-error' : '' }}">
                            <label for="priceMinEst" class="control-label">Minimum estimated price</label>
                            <input id="priceMinEst" placeholder="XXXX" type="text" class="form-control" name="priceMinEst" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('priceMaxEst') ? ' has-error' : '' }}">
                            <label for="priceMaxEst" class="control-label">Maximum estimated price</label>
                            <input id="priceMaxEst" placeholder="XXXX" type="text" class="form-control" name="priceMaxEst" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('priceBuyout') ? ' has-error' : '' }}">
                            <label for="priceBuyout" class="control-label">Buyout price (optional)</label>
                            <input id="priceBuyout" placeholder="XXXX" type="text" class="form-control" name="priceBuyout" required>
                        </div>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('endDate') ? ' has-error' : '' }}">
                            <label for="endDate" class="control-label">End date</label>
                            <input id="endDate" placeholder="DD/MM/YY" type="text" class="form-control" name="endDate" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Attention</label>
                        <p>You can not change the information after adding this auction.<br/>
                        If you're not certain about the information of your artwork, please ask for help.<br/>
                        We will answer your question as soon as possible.</p>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('terms') ? ' has-error' : '' }}">
                            <input class="form-check-input" type="checkbox" value="" id="terms" name="terms" required>
                            <label class="form-check-label" for="terms">I agree to the <a href="#">the Terms & Conditions</a></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                ADD AUCTION
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 offset-md-1">
                        <a href="#">ASK A QUESTION ></a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
