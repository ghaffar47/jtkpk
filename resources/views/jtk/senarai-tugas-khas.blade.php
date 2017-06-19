@inject('jtkc', '\App\Http\Controllers\JTKController')

@extends('master.app')
@section('title', 'Senarai Tugas Khas')
@section('site.description', 'Senarai Tugas Khas')

@section('content')
<!-- Page Header -->
<div class="content bg-image overflow-hidden" style="background-image: url('/assets/img/photos/photo12@2x.jpg');">
    <div class="push-100-t push-15">
        <h1 class="h2 font-w300 text-white animated fadeInUp">
            Senarai Tugas Khas
        </h1>
    </div>
</div>
<!-- END Page Header -->

<!-- Menu -->
<div class="content padding-5-t bg-white border-b">
    <div class="push-15 push-10-t">
        <div class="row">
            <div class="col-xs-7">
                <a class="btn btn-primary" href="{{ url('/tugasan-harian') }}">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </div>
            <div class="col-xs-5">
                <div class="row">
                    <?php
                        if (strlen($mon) != 0) {
                            $month = $mon;
                        } else {
                            $month = date('m');
                        }

                        if (strlen($year) != 0) {
                            $year = $year;
                        } else {
                            $year = date('Y');
                        }
                    ?>
                    <div class="col-xs-6">
                        <select name="qmonth" id="qmonth" data-placeholder="Bulan" class="form-control js-select2">
                            <option></option>
                            <?php
                                for ($i = 1; $i <= 12; $i++) { 
                            ?>
                            @if (str_pad($i,2,'0',STR_PAD_LEFT) == $month)
                                <option value="{{ str_pad($i,2,'0',STR_PAD_LEFT) }}" selected>{{ $jtkc->replaceMonth($i) }}</option>
                            @else
                                <option value="{{ str_pad($i,2,'0',STR_PAD_LEFT) }}">{{ $jtkc->replaceMonth($i) }}</option>
                            @endif
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <select name="qyear" id="qyear" data-placeholder="Tahun" class="form-control js-select2">
                            <option></option>
                            <?php
                                for ($i = 2016; $i < date('Y')+10; $i++) { 
                            ?>
                            @if ($i == $year)
                                <option value="{{ $i }}" selected>{{ $i }}</option>
                            @else
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endif

                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <button type="button" class="btn btn-primary" onclick="javascript:ViewTK($('#qmonth').val(),$('#qyear').val());">
                            <i class="fa fa-eye push-5-r"></i>Lihat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Menu -->


<!-- Page Content -->
<div class="content">
    <div class="row">
        <div class="col-xs-12">
            
            <div class="block block-themed block-rounded">
                <div class="block-header bg-primary-dark">
                    <ul class="block-options">
                        <li>
                            <button type="button" data-toggle="block-option" data-action="content_toggle">
                                <i class="si si-arrow-up"></i>
                            </button>
                        </li>
                    </ul>
                    <h3 class="block-title">
                        <i class="fa fa-briefcase push-10-r"></i>Senarai Tugas Khas
                    </h3>
                </div>
                
                <div class="block-content block-content-full block-content-mini text-right border-b bg-gray-lighter">
                    <button type="button" class="btn btn-success" onclick="javascript:TugasKhasDialog();">
                        <i class="fa fa-plus push-5-r"></i>Tambah Tugas Khas
                    </button>
                </div>
                
                <div class="block-content block-content-full block-content-mini">
                    @if (count($stk_user) == 0)
                        <center>- Tiada Rekod -</center>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">#</th>
                                    <th>Tugasan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($stk_user as $stk)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}.</td>
                                        <td>
                                            <a href="#" onclick="javascript:EditTugasKhas('{{ $stk->id }}');return false;"> 
                                                {{ $stk->tugasan }}
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-sm btn-primary" onclick="javascript:EditTugasKhas('{{ $stk->id }}');">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="javascript:DeleteTugasKhas('{{ $stk->id }}');">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END Page Content -->

<!-- Senarai Tugas Khas Dialog //-->
<div id="TugasKhasDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popout">
        <div class="modal-content">
            <form method="post" class="form-horizontal" action="{{ url('/senarai-tugas-khas') }}">
                {{ csrf_field() }}
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">
                            <i class="fa fa-briefcase push-10-r"></i>Senarai Tugas Khas
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-xs-7">
                                <div class="form-group items-push border-b">
                                    <div class="col-sm-12 push-5">Tugasan :</div>
                                    <div class="col-sm-12">
                                        <input type="text" id="_tugasan" name="_tugasan" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-5 items-push border-b">
                                <div class="row">
                                    <div class="col-sm-12 push-5">Tugas Khas Bulan :</div>
                                    <div class="col-xs-7">
                                        <select name="_month" id="_month" data-placeholder="Bulan" class="form-control js-select2" style="width: 100%;">
                                            <option></option>
                                            <?php
                                                for ($i = 1; $i <= 12; $i++) { 
                                            ?>
                                            @if (str_pad($i,2,'0',STR_PAD_LEFT) == $month)
                                                <option value="{{ str_pad($i,2,'0',STR_PAD_LEFT) }}" selected>{{ $jtkc->replaceMonth($i) }}</option>
                                            @else
                                                <option value="{{ str_pad($i,2,'0',STR_PAD_LEFT) }}">{{ $jtkc->replaceMonth($i) }}</option>
                                            @endif
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <select name="_year" id="_year" data-placeholder="Tahun" class="form-control js-select2" style="width: 100%;">
                                            <option></option>
                                            <?php
                                                for ($i = 2016; $i < date('Y')+10; $i++) { 
                                            ?>
                                            @if ($i == $year)
                                                <option value="{{ $i }}" selected>{{ $i }}</option>
                                            @else
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endif

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <div class="col-sm-12 push-5">Keterangan Tugasan :</div>
                            <div class="col-sm-12">
                                <textarea name="_keterangan_tugasan" id="_keterangan_tugasan" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group items-push">
                            <div class="col-sm-12 push-5">Status / Laporan :</div>
                            <div class="col-sm-12">
                                <textarea name="_status_laporan" id="_status_laporan" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_u_save" class="btn btn-primary" type="submit">
                        <i class="fa fa-save push-5-r"></i>Simpan Rekod
                    </button>
                    <button id="btn_u_cancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:ClearSenaraiTugasKhas();">
                        <i class="fa fa-times push-5-r"></i>Batal
                    </button>                
                    <input id="_id" name="_id" type="hidden" value="0" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
