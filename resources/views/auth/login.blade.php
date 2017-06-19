@extends('master.single')
@section('title', 'Log Masuk')
@section('site.description', 'Log Masuk ke Portal Bersepadu JTKPK')

@section('content')
<!-- Login Content -->
<div class="bg-white push-50-t">
    <div class="content content-boxed overflow-hidden">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                <div class="push-50 animated fadeIn">
                    <!-- Login Title -->
                    <div class="text-center">
                        <a href="{{ url('/') }}"><img src="{{ asset('/img/logo.png') }}" width="100" title="Portal Juruteknik Komputer Negeri Perak (JTKPK)"></a>
                        <p class="text-muted push-10-t font-w300">Portal Juruteknik Komputer Negeri Perak (JTKPK)</p>
                    </div>
                    <!-- END Login Title -->

                    <!-- Login Form -->
                    <form class="js-validation-login form-horizontal push-30-t" action="{{ url('/login') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email">Alamat E-mel</label>
                            <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="email">Kata Laluan</label>
                            <input class="form-control" type="password" id="password" name="password" required>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="remember" name="remember"><span></span> Ingat Saya ?
                                </label>
                            </div>
                            <div class="col-xs-6">
                                <!--<div class="font-s13 text-right push-5-t">
                                    <a href="{{ url('/password/reset') }}"> Lupa Kata Laluan ?</a>
                                </div>//-->
                            </div>
                        </div>
                        <div class="form-group push-30-t">
                            <div class="col-xs-6">
                                <button class="btn btn-block btn-primary" type="submit">
                                    <i class="fa fa-sign-in push-5-r"></i>Log Masuk
                                </button>
                            </div>
                            <div class="col-xs-6">
                                <a href="{{ url('/register') }}" class="btn btn-block btn-success">
                                    <i class="fa fa-send push-5-r"></i>Daftar
                                </a>
                            </div>
                        </div>
                    </form>
                    <!-- END Login Form -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Login Content -->
@endsection
