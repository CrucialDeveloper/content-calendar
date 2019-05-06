@extends('layouts.app')

@section('content')
<div class="container mx-auto w-1/2 bg-white rounded shadow-lg p-8">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group row">
            <label for="email" class="font-bold">{{ __('E-Mail Address') }}</label>

            <div class="mt-2">
                <input id="email" type="email" class="p-2 border-2 rounded w-full @error('password') border-red-500 border-2 @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                @error('email')
                <span class="text-sm text-red-500" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <label for="password" class="font-bold">{{ __('Password') }}</label>

            <div class="mt-2">
                <input id="password" type="password" class="p-2 border-2 rounded w-full @error('password') border-red-500 border-2 @enderror" name="password" autocomplete="current-password">


                @error('password')
                <span class="text-sm text-red-500" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>

        <div class="mt-4">
            <div class="">
                <button type="submit" class="bg-blue-500 rounded p-2 text-white mr-8">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                <a class="p-22 underline" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection
