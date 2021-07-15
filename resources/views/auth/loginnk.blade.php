
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home - My Admin Template</title>

    <!-- Main Styles -->
    <link rel="stylesheet" href="assets/styles/style.css">

    <!-- Material Design Icon -->
    <link rel="stylesheet" href="assets/fonts/material-design/css/materialdesignicons.css">

    <!-- mCustomScrollbar -->
    <link rel="stylesheet" href="assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css">

    <!-- Waves Effect -->
    <link rel="stylesheet" href="assets/plugin/waves/waves.min.css">

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="assets/plugin/sweet-alert/sweetalert.css">

    <!-- Morris Chart -->
    <link rel="stylesheet" href="assets/plugin/chart/morris/morris.css">

    <!-- FullCalendar -->
    <link rel="stylesheet" href="assets/plugin/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assets/plugin/fullcalendar/fullcalendar.print.css" media='print'>

    <style type="text/css">
            
            :root {
  --asm-default-transition: 300ms;
  --asm-color-facebook: rgb(59, 89, 152);
  --asm-color-twitter: rgb(85, 172, 238);
  --asm-color-google: rgb(219,68,55) ;
  --asm-color-linkedin: rgb(0, 130, 202);
}
:root {
  --asm-color-warning: #ffc107;
  --asm-color-danger: #dc3545;
  --asm-color-dark: #343a40;
  --asm-color-focus: rgba(0, 123, 255, 0.25);
  --asm-color-secondary: #3f5c80;
  --asm-color-accent: #b4c2c9;
  --asm-color-flat: #6a9ed3;
  --asm-color-sidenav-item: rgba(29, 54, 86, .6);
  --asm-color-input-border: rgba(52, 58, 64, .25);
  --asm-color-btn-secondary: #64c3f0;
  --asm-color-background: #fff;
  --asm-color-text: #343a40;
  --asm-color-secondary-text: #fff;
  --asm-color-social: #fff;
}

#login {
  background-image: linear-gradient(45deg, #184b8a, transparent);
}

#login .login-wrapper{
  width: 100%;
  transform: translate(0%, 60%);
  
}

.asm-form {
  display: flex;
  flex-direction: column;
  width: 100%;
  max-width: 45rem;
  margin: 0 auto;
  font-family: inherit;
  border-radius: 0.5rem;
  box-shadow: 0 0 0.8rem rgb(0 0 0 / 15%);
  color: #343a40;
  background-color: var(--asm-color-background);
  font-size: 1rem;

}
.asm-form:not(.active) {
  max-height: 0;
  overflow: hidden;
}

.asm-form__body {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  padding: 50px 20px 10px;
  font-family: inherit;
  color: #343a40;
  background-color: var(--asm-color-background);
}

.asm-form__footer, .asm-form__header {
  padding: 0.9rem 2rem;
  color: var(--asm-color-secondary-text);
  background-color: var(--asm-color-secondary);
}

.asm-form__footer {
  border-radius: 0 0 .5rem .5rem;
}

.asm-form__header {
  border-radius: .5rem .5rem 0 0;
}



.asm-form__inputbox, .asm-form__leverbox {
  position: relative;
  margin: 0.5rem 0;
  --error-opacity: 0;
  --error-top: -3rem;
  --error-z-index: -1;
  --input-box-shadow: none;
}

.asm-form__inputbox.invalid, .asm-form__leverbox.invalid {
  --error-opacity: 1;
  --error-top: 100%;
  --error-z-index: 10;
  --input-box-shadow: inset 0 0 4px var(--asm-color-warning)
    ;
}

.asm-form__icon {
  position: absolute;
  top: 34%;
  max-width: 17px;
  color: inherit;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
}

.asm-form__icon.prepend {
  left: 19px;
}

.asm-form__icon.append {
  right: 1rem;
}

.asm-form__inputlabel {
  position: absolute;
  top: 34%;
  left: 22px;
  font-family: inherit;
  color: inherit;
  -webkit-transition: var(--asm-default-transition);
  transition: var(--asm-default-transition);
  -webkit-transform: translate(3rem, -50%);
          transform: translate(3rem, -50%);
}

.asm-form__inputlabel:not(.active) {
  font-size: 15px;
}

.asm-form__inputlabel.active {
  top: -10px;
  left: -4px;
  font-size: 15px;
  -webkit-transform: translate(1rem, -100%);
          transform: translate(1rem, -100%);
  color: #343a40;
  text-transform: capitalize;
}

.asm-form__error {
  position: absolute;
  width: -webkit-fit-content;
  width: -moz-fit-content;
  width: fit-content;
  padding: .5rem 1rem;
  z-index: var(--error-z-index);
  top: var(--error-top);
  left: 3rem;
  color: var(--asm-color-warning);
  background: var(--asm-color-danger);
  border-radius: 0.5rem;
  opacity: var(--error-opacity);
}

.asm-form__error::before {
  position: absolute;
  left: 1rem;
  top: -1rem;
  z-index: -1;
  content: '';
  width: .5rem;
  height: .5rem;
  display: block;
  border-width: .5rem;
  border-top-color: transparent;
  border-right-color: transparent;
  border-bottom-color: var(--asm-color-danger);
  border-left-color: transparent;
  border-style: solid;
}

.asm-form__input {
  width: 100%;
  padding: 13px 52px;
  font-family: inherit;
  font-size: 17px;
  color: inherit;
  background-color: inherit;
  border: 1px solid var(--asm-color-input-border);
  border-radius: .3rem;
  margin-bottom: 27px;
}

.asm-form__input::-webkit-input-placeholder {
  color: transparent;
}

.asm-form__input:-ms-input-placeholder {
  color: transparent;
}

.asm-form__input::-ms-input-placeholder {
  color: transparent;
}

.asm-form__input::placeholder {
  color: transparent;
}

.asm-form__input:active, .asm-form__input:focus, .asm-form__input:hover {
  outline: none;
  -webkit-box-shadow: inset 0 0 4px var(--asm-color-sidenav-item);
          box-shadow: inset 0 0 4px var(--asm-color-sidenav-item);
}

.asm-form__leverbox {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
}

@media (min-width: 576px) {
  .asm-form__leverbox {
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
        -ms-flex-direction: row;
            flex-direction: row;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
            padding: 13px 2rem;
            margin-top: -15px;
  }
}

.asm-form__leverlabel {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  cursor: pointer;
}

@media (max-width: 575px) {
  .asm-form__leverlabel {
    margin-bottom: 1rem;
  }
}

.asm-form__lever {
  position: relative;
  -moz-appearance: none;
  appearance: none;
  -webkit-appearance: none;
  width: 36px;
  margin-left: 19px;
  height: 17px;
  margin-right: 1rem;
  background-color: var(--background);
  border: 2px solid var(--asm-color-secondary);
  border-radius: 1rem;
  outline: none;
  -webkit-transition: var(--asm-default-transition);
  transition: var(--asm-default-transition);
  cursor: pointer;
  --background: transparent;
  --ball-background: var(--asm-color-secondary);
  --ball-left: 5px;
}

.asm-form__leverlabel .asm-form__lever-text{
  font-size: 14px;
  margin-left: 5px;
}
.asm-form__lever:checked {
  --background: var(--asm-color-secondary);
  --ball-background: #fff;
  --ball-left: calc(100% - .85rem);
}

.asm-form__lever:focus {
  -webkit-box-shadow: 0 0 0 0.2rem var(--asm-color-focus);
          box-shadow: 0 0 0 0.2rem var(--asm-color-focus);
}

.asm-form__lever::before {
  position: absolute;
  top: 50%;
  left: var(--ball-left);
  display: block;
  width: 0.75rem;
  height: 0.75rem;
  content: '';
  -webkit-transition: var(--asm-default-transition);
  transition: var(--asm-default-transition);
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  background: var(--ball-background);
  border-radius: 50%;
}

.asm-form__linkbox {
  text-align: right;
}

.asm-form__link {
  text-decoration: none;
  border: none;
  background-color: transparent;
  cursor: pointer;
  color: var(--asm-color-flat);
  font-size: 14px;
}

.asm-form__link:hover {
  color: #ff0000;
}

.asm-form__btn {
  width: 100%;
  padding: 0.75rem;
  border: none;
  border-radius: 0.3rem;
  text-transform: uppercase;
  cursor: pointer;
  font-family: inherit;
  font-size: 15px;
  color: #fff;
  background: #f44336;
  -webkit-box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
  font-weight: 500;
}

.asm-form__btn:hover {
  -webkit-box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15);
          box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15);
}

    </style>

</head>

@extends('layouts.app')

<body id="login">
    <div class="login-wrapper">
                       
        <form method="POST"  action="{{ route('login') }}" class="asm-form active" id="frmSignIn">
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
                    <!-- <label class="asm-form__leverlabel">
                        <input class="asm-form__lever" type="checkbox" name="remember" id="signinRemember">
                        <span class="asm-form__lever-text">Remember me</span>
                    </label> -->
                    <a href="{{ route('password.request')}}" class="asm-form__link" data-action="show-form"><u>Forgot 
                        password</u></a>
                </div>

            </div>

            <div class="asm-form__footer">
                <button class="asm-form__btn" id="signinSubmit" type="submit">Log In</button>
            </div>
        </form>
    </div>


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


</body>

</html>