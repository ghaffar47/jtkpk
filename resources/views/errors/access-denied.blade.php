@extends('master.app')
@section('title', 'Akses Disekat !')
@section('site.description', 'Akses Disekat')

@section('content')
<!-- Page Content -->
<div class="content content-narrow">
    <div class="row">
        <div class="col-xs-12">
            <div class="block">
                <div class="block-content block-content-full bg-gray-lighter text-center">
                	<h1 class="font-w300 font-s128"><i class="fa fa-lock text-danger"></i></h1>
                    <h4 class="font-w300 push-15"><b>Maaf !</b> Anda tidak dibenarkan untuk akses bahagian ini.</h4>
                    <h6 class="font-w400"><a href="javascript:history.back(-1);"><i class="fa fa-arrow-circle-left push-5-r"></i>Kembali</a></h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection
