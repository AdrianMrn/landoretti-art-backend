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
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                <div class="row">
                    <div class="row-md-9">
                        <div class="alert alert-danger"><strong>{{ $error }}</strong></div>
                    </div>
                </div>
                @endforeach
            @endif

            <form method="POST" action="{{ url('auctions') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row marginbelow">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <select class="form-control" id="style" name="style" required autofocus>
                                <option value="" disabled selected>Style</option>
                                @foreach ($styles as $style)
                                    <option value="{{ $style->name }}" {{ (old('style') == $style->name ? 'selected':'') }}>{{ $style->name }}</option>
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
                            <input id="width" placeholder="XXXX" type="number" class="form-control" name="width" value="{{ old('width') }}" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('height') ? ' has-error' : '' }}">
                            <label for="height" class="control-label">Height</label>
                            <input id="height" placeholder="XXXX" type="number" class="form-control" name="height" value="{{ old('height') }}" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('depth') ? ' has-error' : '' }}">
                            <label for="depth" class="control-label">Depth (optional)</label>
                            <input id="depth" placeholder="XXXX" type="number" class="form-control" name="depth" value="{{ old('depth') }}">
                        </div>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-9">
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="control-label">Description</label>
                            <textarea id="description" placeholder="Describe your auction as thoroughly as possible" type="text" class="form-control" name="description" required>{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-9">
                        <div class="form-group{{ $errors->has('condition') ? ' has-error' : '' }}">
                            <label for="condition" class="control-label">Condition</label>
                            <textarea id="condition" placeholder="What is the condition of the artwork?" type="text" class="form-control" name="condition" required>{{ old('condition') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-9">
                        <div class="form-group{{ $errors->has('origin') ? ' has-error' : '' }}">
                            <label for="origin" class="control-label">Origin</label>
                            <input id="origin" placeholder="What is the origin of the artwork?" type="text" class="form-control" name="origin" value="{{ old('origin') }}" required>
                        </div>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-9">
                        <div class="form-group{{ $errors->has('photos') ? ' has-error' : '' }}">
                            <label class="control-label">Photos</label>
                            <p>Please upload one picture with the signature of the artwork and one picture of the artwork itself.<br>
                            You can upload up to 3 pictures with a maximum of 10MB each.<br/>
                        </div>
                    </div>
                </div>
                <div class="row marginbelow">
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('imageSignature') ? ' has-error' : '' }}">
                            <label class="btn btn-info">
                                Upload image of the artwork <input type="file" id="imageSignature" name="imageSignature" value="{{ old('imageSignature') }}" hidden>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('imageArtwork') ? ' has-error' : '' }}">
                            <label class="btn btn-info">
                                Upload image of the signature <input type="file" id="imageArtwork" name="imageArtwork" value="{{ old('imageArtwork') }}" hidden>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('imageOptional') ? ' has-error' : '' }}">
                            <label class="btn btn-info">
                                Optional image <input type="file" id="imageOptional" name="imageOptional" value="{{ old('imageOptional') }}" hidden>
                            </label>
                        </div>
                    </div>
                </div>

                <h3>Pricing</h3>
                <div class="row marginbelow">
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('priceMinEst') ? ' has-error' : '' }}">
                            <label for="priceMinEst" class="control-label">Minimum estimated price</label>
                            <input id="priceMinEst" placeholder="XXXX" type="number" class="form-control" name="priceMinEst" value="{{ old('priceMinEst') }}" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('priceMaxEst') ? ' has-error' : '' }}">
                            <label for="priceMaxEst" class="control-label">Maximum estimated price</label>
                            <input id="priceMaxEst" placeholder="XXXX" type="number" class="form-control" name="priceMaxEst" value="{{ old('priceMaxEst') }}" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('priceBuyout') ? ' has-error' : '' }}">
                            <label for="priceBuyout" class="control-label">Buyout price (optional)</label>
                            <input id="priceBuyout" placeholder="XXXX" type="number" class="form-control" name="priceBuyout" value="{{ old('priceBuyout') }}">
                        </div>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('endDate') ? ' has-error' : '' }}">
                            <label for="endDate" class="control-label">End date</label>
                            <input id="endDate" placeholder="YYYY/MM/DD" type="text" class="form-control" name="endDate" value="{{ old('endDate') }}" required>
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

                <div class="row marginbelow">
                    <div class="col-md-4 col-md-offset-1">
                        <a href="#">ASK A QUESTION ></a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
