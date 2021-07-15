@extends('layouts.app')

@section('content')
<div id="email"> 
<div class="login-wrapper">
                                            <form method="POST"
                                                method="POST" action="{{ route('password.email') }}"
                                                class="asm-form active" id="frmSignIn">
                                                @csrf
                                                <div class="asm-form__header"> 
                                                    <img src="{{ asset('assets/images/logo/TF-logo-2.png') }}" alt="" srcset="">

                                                </div> 
                                                <div class="asm-form__body">
                                                    @if (session('status'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ session('status') }}
                                                    </div>
                                                    @endif
                                                    <div class="asm-form__inputbox">
                                                        <div class="asm-form__inputbox">
                                                            <label for="email" class="asm-form__inputlabel" >E-Mail Address</label>
                                                            <svg class="asm-form__icon prepend" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                                <path
                                                                    d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z" />
                                                            </svg>
                                                            <input id="email" class="asm-form__input @error('email') is-invalid @enderror" 
                                                                type="email" name="email" value="{{ old('email') }}" required placeholder="Email Id" autocomplete="email" autofocus>
                                                                @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="asm-form__footer">
                                                    <button type="button" id="btnFetch" class="asm-form__btn spinner-button btn btn-primary mb-2" onclick="reset_password_email();">Send Password Reset Link</button>

                                                </div>
                                            </form>
                                        </div>
                                        </div>
                                        
@endsection
