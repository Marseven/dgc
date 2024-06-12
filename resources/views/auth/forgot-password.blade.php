@extends('layout.auth')

@section('content')
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card login-dark">
                <div>
                    <div><a class="logo" href="{{ url('/') }}"><img class="img-fluid for-light"
                                src="{{ asset('front/images/dgc_wb.png') }}" width="100" alt="looginpage"><img
                                class="img-fluid for-dark" src="{{ asset('front/images/dgc_wb.png') }}" width="100"
                                alt="looginpage"></a>
                    </div>
                    <div class="login-main">
                        <form class="theme-form" method="POST" action="{{ route('password.email') }}">
                            @csrf

                            @include('layout.alert')

                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="text" placeholder="Email" name="email" value="{{ old('email') }}"
                                    autocomplete="off" class="form-control bg-transparent" />
                                <!--end::Email-->
                                @if ($errors->has('email'))
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        {{ $errors->first('email') }}</div>
                                @endif
                            </div>


                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Envoyer</span>
                                    <!--end::Indicator label-->
                                </button>
                            </div>
                            <!--end::Submit button-->
                            <!--begin::Sign up-->
                            <div class="text-gray-500 text-center fw-semibold fs-6">Vous avez un compte ?
                                <a href="{{ route('login') }}" class="link-primary">Se connecter</a>
                            </div>
                            <!--end::Sign up-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Root-->
@endsection
