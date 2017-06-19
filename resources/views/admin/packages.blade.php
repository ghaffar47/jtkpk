@extends('master.app')
@section('title', 'Pakej Sistem')
@section('site.description', 'Pakej Sistem')

@section('jquery')
$('#Packages').DataTable({ responsive: true });
@endsection

@section('content')
<!-- Page Header -->
<div class="content bg-image overflow-hidden" style="background-image: url('/assets/img/photos/photo12@2x.jpg');">
    <div class="push-100-t push-15">
        <h1 class="h2 font-w300 text-white animated fadeInUp">
            <i class="fa fa-th push-15-r"></i> Pakej Sistem
        </h1>
    </div>
</div>
<!-- END Page Header -->

<!-- Menu -->
<div class="content padding-5-t bg-white border-b">
    <div class="push-15 push-10-t">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-default" href="{{ url('/') }}">
                    <i class="fa fa-home"></i>
                </a>                
            </div>
            <div class="col-md-6 text-right">
            </div>
        </div>
    </div>
</div>
<!-- END Menu -->

<!-- Page Content -->
<div class="content content-narrow">
    <div class="row">
        <div class="col-xs-12">
            <div id="_packages" class="block block-themed block-rounded push-5">
                
                <div class="block-content">
                    <table id="Packages" class="table table-striped table-bordered responsive h6">
                        <thead>
                            <tr>
                                <th class="text-center">Bil</th>
                                <th class="text-center">Pakej Sistem</th>
                                <th class="text-center">Keterangan Pakej</th>
                                <th class="text-center">Dibangunkan Oleh</th>
                                <th class="text-center">Status Pakej</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($packages as $package)
                            <?php $i++; ?>
                            <tr>
                                <td class="text-center">{{ $i }}.</td>
                                <td>
                                    <span class="font-w300 h5 text-primary">{{ $package->package_title }}</span>
                                </td>
                                <td class="text-left">
                                    <div class="pull-left padding-10-r">
                                        <img src="{{ asset('/img/pakej/'.$package->package_icon.'') }}" width="50" height="50">
                                    </div>
                                    {{ $package->package_description }}
                                </td>
                                <td class="text-center">{{ $package->package_author }}</td>
                                <td class="text-center">
                                    @if ($package->package_status==1)
                                        <span class="text-success">
                                            <i class="fa fa-check text-success push-5-r"></i> Aktif
                                        </span>
                                    @else
                                        <span class="text-danger">
                                            <i class="fa fa-times text-danger push-5-r"></i> Tidak Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center" width="100">
                                    @if ($package->package_status==1)
                                        <a href="{{ url('/admin/packages/'.$package->id.'/deactivate') }}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Lumpuhkan Pakej">
                                            <i class="fa fa-arrow-circle-down"></i>
                                        </a>
                                    @else
                                        <a href="{{ url('/admin/packages/'.$package->id.'/activate') }}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Aktifkan Pakej">
                                            <i class="fa fa-arrow-circle-up"></i>
                                        </a>
                                    @endif

                                    <a href="{{ url('/admin/packages/'.$package->id.'/delete') }}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Padam Pakej">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection
