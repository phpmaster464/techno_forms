@extends('layouts.app')

@section('content')
<div id="login">
 <div class="login-wrapper">
          <form method="POST"  action="{{ route('login') }}" class="asm-form active" id="frmSignIn">
             @csrf
            <div class="asm-form__header">
                <img src="{{ asset('assets/images/logo/TF-logo-2.png') }}" alt="" srcset="">
            </div>
            <div class="asm-form__body">
                 @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong><h4>{{ $message }}</h4></strong>
                        </span>
                        @enderror

                   @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror      

                <div class="asm-form__inputbox">
                   <label for="email" >Email Address</label>
                    <svg class="asm-form__icon prepend" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path
                            d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z" />
                    </svg>
                    <input id="email" class="asm-form__input validate @error('email') is-invalid @enderror" 
                        type="text" name="email" required placeholder="Email Id" autocomplete="email">

                </div>
                <div class="asm-form__inputbox">
                   <label class="asm-form__inputlabel" for="password" >Password</label>
                    <svg class="asm-form__icon prepend" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M320 48c79.529 0 144 64.471 144 144s-64.471 144-144 144c-18.968 0-37.076-3.675-53.66-10.339L224 368h-32v48h-48v48H48v-96l134.177-134.177A143.96 143.96 0 0 1 176 192c0-79.529 64.471-144 144-144m0-48C213.965 0 128 85.954 128 192c0 8.832.602 17.623 1.799 26.318L7.029 341.088A24.005 24.005 0 0 0 0 358.059V488c0 13.255 10.745 24 24 24h144c13.255 0 24-10.745 24-24v-24h24c13.255 0 24-10.745 24-24v-20l40.049-40.167C293.106 382.604 306.461 384 320 384c106.035 0 192-85.954 192-192C512 85.965 426.046 0 320 0zm0 144c0 26.51 21.49 48 48 48s48-21.49 48-48-21.49-48-48-48-48 21.49-48 48z" />
                    </svg>
                    <input id="password"  class="asm-form__input validate @error('password') is-invalid @enderror" type="password" name="password" required placeholder="Password" autocomplete="current-password">
                   
                   <!--  <svg class="asm-form__icon append" data-action="toggle-show-password" data-input="#signinPassword"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path
                            d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z" />
                    </svg> -->
                </div>


            </div>

            <div class="asm-form__footer">
                <button type="submit" class="asm-form__btn" id="signinSubmit">Log In</button>
            </div>
            <div class="asm-form__leverbox">

               @if (Route::has('password.request'))
                     <a class="asm-form__link" href="{{ route('password.request') }}">
                                        <u>{{ __('Forgot Password?') }}
                                    </a>
                                                      
                      @endif 

                <!-- <button type="button" class="asm-form__link" data-action="show-form" data-target="#frmForget">Forgot Your Password?</button> -->
            </div>
        </form>
    </div>
</div>



 <!-- <form method="POST"  action="{{ route('login') }}" class="asm-form active" id="frmSignIn">
             @csrf
            <div class="asm-form__header">
                <h2>Log In</h2>
            </div>
            <div class="asm-form__body">
                <div class="asm-form__inputbox">
                    <svg class="asm-form__icon prepend" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path
                            d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z" />
                    </svg>
                   
                         <input class="asm-form__input validate @error('email') is-invalid @enderror"
                         type="text" name="email" id="email" required placeholder="Email" autocomplete="email">
                         <label class="asm-form__inputlabel" for="email">Email</label>

                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                   
                </div>
                <div class="asm-form__inputbox">
                    <svg class="asm-form__icon prepend" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M320 48c79.529 0 144 64.471 144 144s-64.471 144-144 144c-18.968 0-37.076-3.675-53.66-10.339L224 368h-32v48h-48v48H48v-96l134.177-134.177A143.96 143.96 0 0 1 176 192c0-79.529 64.471-144 144-144m0-48C213.965 0 128 85.954 128 192c0 8.832.602 17.623 1.799 26.318L7.029 341.088A24.005 24.005 0 0 0 0 358.059V488c0 13.255 10.745 24 24 24h144c13.255 0 24-10.745 24-24v-24h24c13.255 0 24-10.745 24-24v-20l40.049-40.167C293.106 382.604 306.461 384 320 384c106.035 0 192-85.954 192-192C512 85.965 426.046 0 320 0zm0 144c0 26.51 21.49 48 48 48s48-21.49 48-48-21.49-48-48-48-48 21.49-48 48z" />
                    </svg>
                    <input class="asm-form__input validate @error('password') is-invalid @enderror"  type="password"
                        name="password" id="password" required placeholder="password" autocomplete="current-password">

                      

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                    <label class="asm-form__inputlabel" for="password">password</label>
                    <svg class="asm-form__icon append" data-action="toggle-show-password" data-input="#password"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path
                            d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z" />
                    </svg>
                </div>
                <div class="asm-form__leverbox">
                    @if (Route::has('password.request'))
                     <a class="" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                                      
                      @endif 

                   
                </div>

            </div>

            <div class="asm-form__footer">
                <button class="asm-form__btn" id="signinSubmit" type="submit">Log In</button>
            </div>
        </form>
 -->

 <script>
        const frmSignIn = document.getElementById('frmSignIn');
        const frmForget = document.getElementById('frmForget');
        const frmRegister = document.getElementById('frmRegister');

        const inputs = document.querySelectorAll('.asm-form__input');
        const showPasswordTogglers = document.querySelectorAll('[data-action="toggle-show-password"]');
        const linkButtons = document.querySelectorAll('[data-action="show-form"]');

        /* Functions */
        const inputLabelFocusOut = event => {
            label = document.querySelector(`label[for="${event.target.id}"]`);
            if (event.target.value.length > 0) {
                label.classList.add('active');
                label.parentNode.classList.remove('invalid');
            } else {
                label.classList.remove('active');
            }
        }

        const inputLabelFocus = event => {
            label = document.querySelector(`label[for="${event.target.id}"]`);
            label.classList.add('active');
            label.parentNode.classList.remove('invalid');
        }

        const toggleShowPassword = event => {
            const input = document.querySelector(event.target.dataset.input);
            const type = input.getAttribute('type');
            input.setAttribute('type', type === 'password' ? 'text' : 'password');
        }

        const showForm = event => {
            event.preventDefault();

            for (const form of document.querySelectorAll('.asm-form')) {
                form.classList.remove('active');
            }

            for (const error of document.querySelectorAll('.asm-form__inputbox.invalid')) {
                error.classList.remove('invalid');
            }

            document.querySelector(event.target.dataset.target).classList.add('active');
        }

        /* Listener assigns */

        for (const input of inputs) {
            input.addEventListener('focusout', inputLabelFocusOut);
            input.addEventListener('focus', inputLabelFocus);
        }

        for (const toggler of showPasswordTogglers) {
            toggler.addEventListener('click', toggleShowPassword);
        }

        for (const button of linkButtons) {
            button.addEventListener('click', showForm);
        }
    </script>

@endsection
