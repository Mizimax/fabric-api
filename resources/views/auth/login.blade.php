@extends('layouts.app')

@section('content')
<div class="container" align="center">
    <div class="row justify-content-center">
        <div>
            <div class="card" style="padding: 30px; width: 400px; margin: 30px auto;">

                    @if ($errors->has('username'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
                        <div class="input-field">
                          <input id="username" name="username" type="text" class="validate" required>
                          <label for="username">Username</label>
                        </div>
                        <div class="input-field">
                          <input id="password" name="password" type="password" class="validate" required>
                          <label for="password">Password</label>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                  <label>
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                    <span>{{ __('Remember Me') }}</span>
                                  </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                            </div>
                        </div>
                    </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
