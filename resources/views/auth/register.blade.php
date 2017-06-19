@extends('master.single')
@section('title', 'Pendaftaran Pengguna')
@section('site.description', 'Pendaftaran Pengguna Sistem Bersepadu JTKPK')

@section('content')
<!-- Register Content -->
<div class="bg-white push-50-t">
    <div class="content content-boxed overflow-hidden">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                <div class="push-50 animated fadeIn">
                    <!-- Register Title -->
                    <div class="text-center">
                        <img src="{{ asset('/img/logo.png') }}" width="100">
                        <p class="text-muted push-10-t font-w300">Sistem Bersepadu Juruteknik Komputer Negeri Perak (JTKPK)</p>
                    </div>
                    <!-- END Register Title -->

                    <!-- Register Form -->
                    <form class="js-validation-register form-horizontal push-50-t push-50" action="{{ url('/register') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    <input class="form-control" type="text" id="name" name="name" placeholder="Nama penuh anda" required autofocus>
                                    <label for="name">Nama Penuh</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    <input class="form-control" type="email" id="email" name="email" placeholder="Alamat e-mel anda" required>
                                    <label for="email">Alamat E-mel</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    <input class="form-control" type="password" id="password" name="password" placeholder="Kata laluan anda">
                                    <label for="password">Kata Laluan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material form-material-success">
                                    <input class="form-control" type="password" id="password-confirm" name="password_confirmation" placeholder="Sahkan sekali lagi">
                                    <label for="password-confirm">Pengesahan Kata Laluan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-7 col-sm-8">
                                <label class="css-input switch switch-sm switch-success">
                                    <input type="checkbox" id="register-terms" name="register-terms"><span></span> Bersetuju dengan Terma &amp; Syarat
                                </label>
                            </div>
                            <div class="col-xs-5 col-sm-4">
                                <div class="font-s13 text-right push-5-t">
                                    <a href="#" data-toggle="modal" data-target="#modal-terms">Terma &amp; Syarat</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <button class="btn btn-block btn-success" type="submit">
                                    <i class="fa fa-send push-5-r"></i>Daftar Akaun
                                </button>
                            </div>
                            <div class="col-xs-6">
                                <a href="{{ url('/login') }}" class="btn btn-block btn-primary" type="submit">
                                    <i class="fa fa-sign-in push-5-r"></i>Log Masuk
                                </a>
                            </div>
                        </div>
                    </form>
                    <!-- END Register Form -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Terms Modal -->
<div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Terma &amp; Syarat-Syarat</h3>
                </div>
                <div class="block-content">
                    <p>Dengan pendaftaran yang dilakukan, anda secara tidak langsung bersetuju dan akur dengan semua terma dan syarat-syarat yang telah disenaraikan dibawah :-</p>
                    <ul>
                        <li>Anda bersetuju dengan semua terma dan syarat-syarat di Portal JTKPK ini.</li>
                        <li>Membenarkan penggunaan maklumat anda seperti e-mel rasmi untuk kegunaan rasmi dan berkaitan dengan tugas rasmi.</li>
                        <li>Lain-lain syarat akan dikemaskini dari masa ke semasa.</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Tutup</button>
                <button class="btn btn-sm btn-primary" type="button" data-dismiss="modal">
                    <i class="fa fa-check"></i> Saya Bersetuju
                </button>
            </div>
        </div>
    </div>
</div>
<!-- END Terms Modal -->
<!-- END Register Content -->
@endsection