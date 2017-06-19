@extends('master.app')
@section('title', 'Dashboard')
@section('site.description', 'Dashboard Sistem Bersepadu JTKPK')

@section('content')
<!-- Page Header -->
<div class="content bg-image overflow-hidden" style="background-image: url('/assets/img/photos/photo12@2x.jpg');">
    <div class="push-50-t push-15">
        <h4 class="h4 font-w300 text-white animated zoomIn">
            <span class="font-w600">Dashboard : </span> Portal Juruteknik Komputer Negeri Perak (JTKPK)
        </h4>
    </div>
</div>
<!-- END Page Header -->

<!-- Menu -->
<!--
<div class="content padding-5-t bg-white border-b">
    <div class="push-15 push-10-t">
        <div class="row">
            <div class="col-md-6 font-w300">
            </div>
            <div class="col-md-6 text-right">
            </div>
        </div>
    </div>
</div>
//-->
<!-- END Menu -->

<!-- Page Content -->
<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="block block-themed block-rounded">
                <div class="block-content bg-gray-light">
                    <div class="row">
                        
                        <!-- Profile -->
                        <div class="col-sm-6 col-md-3">
                            <a class="block block-bordered block-rounded block-link-hover3" href="{{ url('/profil') }}">
                                <div class="block-content block-content-full text-center">
                                    <div>
                                        <i class="fa fa-user fa-3x"></i>
                                    </div>
                                    <div class="text-uppercase h5 font-w500 push-15-t push-5">Profil</div>
                                </div>
                            </a>
                        </div>

                        @if (Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin'))
                            @if (Auth::user()->hasRole('super-admin'))
                                <!-- Packages -->
                                <div class="col-sm-6 col-md-3">
                                    <a class="block block-bordered block-rounded block-link-hover3" href="{{ url('/admin/packages') }}">
                                        <div class="block-content block-content-full text-center">
                                            <div>
                                                <i class="fa fa-th fa-3x"></i>
                                            </div>
                                            <div class="text-uppercase h5 font-w500 push-15-t push-5">Pakej Sistem</div>
                                        </div>
                                    </a>
                                </div>
                            @endif

                            <!-- Users -->
                            <div class="col-sm-6 col-md-3">
                                <a class="block block-bordered block-rounded block-link-hover3" href="{{ url('/admin/users') }}">
                                    <div class="block-content block-content-full text-center">
                                        <div>
                                            <i class="fa fa-users fa-3x"></i>
                                        </div>
                                        <div class="text-uppercase h5 font-w500 push-15-t push-5">Pengguna</div>
                                    </div>
                                </a>
                            </div>
                        @endif

                        <!-- Tugasan Harian -->
                        @if (!Auth::user()->hasRole('jpn'))
                        <div class="col-sm-6 col-md-3">
                            <a class="block block-bordered block-rounded block-link-hover3" href="{{ url('/tugasan-harian') }}">
                                <div class="block-content block-content-full text-center">
                                    <div>
                                        <i class="fa fa-check-square-o fa-3x"></i>
                                    </div>
                                    <div class="text-uppercase h5 font-w500 push-15-t push-5">Tugasan Harian</div>
                                </div>
                            </a>
                        </div>
                        @endif

                        <!-- Aduan Kerosakan -->
                        <div class="col-sm-6 col-md-3">
                            <a class="block block-bordered block-rounded block-link-hover3" href="{{ url('/aduan-kerosakan') }}">
                                <div class="block-content block-content-full text-center">
                                    <div>
                                        <i class="fa fa-wrench fa-3x"></i>
                                    </div>
                                    <div class="text-uppercase h5 font-w500 push-15-t push-5">Aduan Kerosakan</div>
                                </div>
                            </a>
                        </div>

                        <!-- Development Team -->
                        <div class="col-sm-6 col-md-3">
                            <a class="block block-bordered block-rounded block-link-hover3" href="{{ url('/dev-team') }}">
                                <div class="block-content block-content-full text-center">
                                    <div>
                                        <i class="fa fa-users fa-3x"></i>
                                    </div>
                                    <div class="text-uppercase h5 font-w500 push-15-t push-5">Development Team</div>
                                </div>
                            </a>
                        </div>

                        <!-- SMART Team -->
                        <div class="col-sm-6 col-md-3">
                            <a class="block block-bordered block-rounded block-link-hover3" href="{{ url('/smart-team') }}">
                                <div class="block-content block-content-full text-center">
                                    <div>
                                        <i class="fa fa-ambulance fa-3x"></i>
                                    </div>
                                    <div class="text-uppercase h5 font-w500 push-15-t push-5">SMART Team</div>
                                </div>
                            </a>
                        </div>

                        <!-- FORUM -->
                        <div class="col-sm-6 col-md-3">
                            <a class="block block-bordered block-rounded block-link-hover3" href="{{ url('/forums') }}">
                                <div class="block-content block-content-full text-center">
                                    <div>
                                        <i class="fa fa-comments fa-3x"></i>
                                    </div>
                                    <div class="text-uppercase h5 font-w500 push-15-t push-5">FORUM</div>
                                </div>
                            </a>
                        </div>

                        @foreach (App\Packages::all() as $package)
                            @if ($package->package_status == 1)
                                <!-- Users -->
                                <div class="col-sm-6 col-md-3">
                                    <a class="block block-bordered block-rounded block-link-hover3" href="{{ url(''.$package->package_url.'') }}">
                                        <div class="block-content block-content-full text-center">
                                            <div>
                                                <img src="{{ asset('/img/pakej/'.$package->package_icon.'') }}" width="50" height="50">
                                            </div>
                                            <div class="text-uppercase h5 font-w500 push-15-t push-5">{{ $package->package_title }}</div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection
