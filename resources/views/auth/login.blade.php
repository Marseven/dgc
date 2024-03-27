@extends('layout.auth')

@section('content')
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card login-dark">
                <div>
                    <div><a class="logo" href="{{ route('home') }}"><img class="img-fluid for-light"
                                src="{{ asset('front/images/dgc_wb.png') }}" width="100" alt="looginpage"><img
                                class="img-fluid for-dark" src="{{ asset('front/images/dgc_wb.png') }}" width="100"
                                alt="looginpage"></a>
                    </div>
                    <div class="login-main">
                        <form class="theme-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <h4>Connexion</h4>
                            <p>Saisissez vos informations</p>
                            <div class="form-group">
                                <label class="col-form-label">Email</label>
                                <input class="form-control" type="email" required="" name="email"
                                    placeholder="abc@abc.com" required>
                                @if ($errors->has('email'))
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        {{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Mot de passe</label>
                                <div class="form-input position-relative">
                                    <input class="form-control" type="password" name="password" required
                                        placeholder="*********">
                                </div>
                                @if ($errors->has('password'))
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        {{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="form-group mb-0">

                                <a class="link" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                                <div class="text-end mt-3">
                                    <button class="btn btn-primary btn-block w-100" type="submit">Connexion</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Root-->
@endsection
