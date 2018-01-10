@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row marginbelow">
                <div class="col-md-4">
                    <h2>Register</h2>
                </div>
            </div>

            <!-- future: complete errors (in alert box w/ red background)  -->
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

            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="row marginbelow">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Company or name</label>
                            <input id="name" placeholder="Studio 6" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail</label>
                            <input id="email" placeholder="name@provider.com" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>
                            <input id="password" placeholder="●●●●●●●●" type="password" class="form-control" name="password" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password-confirm" class="control-label">Password confirmation</label>
                            <input id="password-confirm" placeholder="●●●●●●●●" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label for="country" class="control-label">Country</label>
                            <input id="country" placeholder="Belgium" type="text" class="form-control" name="country" value="{{ old('country') }}" required> <!-- future: should be dropdown -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                            <label for="zipcode" class="control-label">Zip Code</label>
                            <input id="zipcode" placeholder="2000" type="text" class="form-control" name="zipcode" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="control-label">City</label>
                            <input id="city" placeholder="Antwerpen" type="text" class="form-control" name="city" required>
                        </div>
                    </div>
                </div>
                
                <div class="row marginbelow">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="control-label">Address</label>
                            <input id="address" placeholder="Kerkstraat" type="text" class="form-control" name="address" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="control-label">Phone number</label>
                            <input id="phone" placeholder="+32499437843" type="text" class="form-control" name="phone" required>
                        </div>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('accountnumber') ? ' has-error' : '' }}">
                            <label for="accountnumber" class="control-label">Account number</label>
                            <input id="accountnumber" placeholder="BE26 XXXX XXXX XXXX XX" type="text" class="form-control" name="accountnumber" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('vatnumber') ? ' has-error' : '' }}">
                            <label for="vatnumber" class="control-label">VAT number</label>
                            <input id="vatnumber" placeholder="XX XXX XXX XXX" type="text" class="form-control" name="vatnumber" required>
                        </div>
                    </div>
                </div>

                <div class="row marginbelow">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('altpayment') ? ' has-error' : '' }}">
                            <label for="altpayment" class="control-label">Alternative payment methods</label>
                            <input id="altpayment" placeholder="PayPal, check, cash, ..." type="text" class="form-control" name="altpayment">
                        </div>
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
                                REGISTER
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
