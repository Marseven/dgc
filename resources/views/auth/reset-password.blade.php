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
                        <form class="theme-form" method="POST" action="{{ route('password.update') }}">
                            @csrf


                            @include('layout.alert')

                            <input type="hidden" name="token" value="{{ $token }}">

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
                            <br>
                            <!--end::Input group=-->
                            <div class="fv-row mb-3">
                                <!--begin::Password-->
                                <input type="password" placeholder="Mot de passe" name="password" autocomplete="off"
                                    class="form-control bg-transparent" />
                                <!--end::Password-->
                                @if ($errors->has('password'))
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        {{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <!--end::Input group=-->

                            <!--end::Input group=-->
                            <div class="fv-row mb-3">
                                <!--begin::Password-->
                                <input type="password" id="password-confirm" placeholder="Confirmer le Mot de passe"
                                    name="password_confirmation" autocomplete="off" class="form-control bg-transparent" />
                                <!--end::Password-->
                                @if ($errors->has('password_confirmation'))
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        {{ $errors->first('password_confirmation') }}</div>
                                @endif
                            </div>
                            <!--end::Input group=-->

                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Réinitialiser</span>
                                    <!--end::Indicator label-->
                                </button>
                            </div>
                            <!--end::Submit button-->

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--end::Root-->
@endsection
