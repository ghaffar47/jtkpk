@extends('master.app')
@section('title', 'Detail Kumpulan SMART Team')
@section('site.description', 'Detail Kumpulan SMART Team')
@section('app.helper', ",'summernote', 'ckeditor'")

@section('jquery')
@endsection

@section('content')
<!-- Page Header -->
<div class="content bg-image overflow-hidden" style="background-image: url('/assets/img/photos/photo12@2x.jpg');">
    <div class="push-100-t push-15">
        <h1 class="h2 font-w300 text-white animated fadeInUp">
            <i class="fa fa-ambulance push-15-r"></i> <span class="font-w600">Detail :</span> {{ $st->nama_kumpulan }}
        </h1>
    </div>
</div>
<!-- END Page Header -->

<!-- Menu -->
<div class="content padding-5-t bg-white border-b">
    <div class="push-15 push-10-t">
        <div class="row">
            <div class="col-xs-6">
                <a href="/smart-team/{{ $st->kod_ppd }}" class="btn btn-primary" data-toggle="tooltip" title="Kembali">
                    <i class="fa fa-arrow-circle-left"></i>
                </a>
                <button type="button" class="btn btn-success" onclick="javascript:AddAktivitiDialog();" data-toggle="tooltip" title="Tambah Aktiviti SMART Team">
                    <i class="fa fa-plus push-5-r"></i><i class="fa fa-bicycle"></i>
                </button>
            </div>
            <div class="col-xs-6 pull-right">
            </div>
        </div>
    </div>
</div>
<!-- END Menu -->

<!-- Page Content -->
<div class="content content-narrow">
    <div class="row">
        <div class="col-xs-12">
            <div class="block block-themed block-rounded push-5">
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="block block-bordered">
                                <div class="block-header bg-gray-lighter">
                                    <h3 class="block-title">
                                        <i class="fa fa-users push-10-r"></i>Senarai Ahli Kumpulan
                                    </h3>
                                </div>
                                <div class="block-content">
                                    <ul class="nav-users push">
                                        @foreach ($st->ahli as $ahli)
                                        <?php $_user = App\User::find($ahli); ?>
                                        <li>
                                            <a href="#">
                                                <img class="img-avatar img-avatar48" src="/avatar/{{ $_user->id }}" title="{{ $_user->name }}">
                                                {{ $_user->name }}
                                                <div class="font-w300 text-muted"><small><i class="fa fa-envelope push-5-r"></i>{{ $_user->email }}</small></div>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            @if ($error == 'title_exists')
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <i class="fa fa-exclamation push-5-r text-danger"></i> Tajuk aktiviti telah wujud. Sila pilih tajuk lain.
                                </div>
                            @endif
                            @if ($st->aktiviti->count() == 0)
                                <div class="panel panel-primary text-center padding-20-all h6 font-w300">
                                    <i class="fa fa-bicycle fa-4x push-10"></i>
                                    <div>- Tiada aktiviti buat masa ini -</div>
                                </div>
                            @else
                                @foreach ($st->aktiviti as $xtvt)
                                <div class="block block-bordered">
                                    <div class="block-header bg-gray-lighter">
                                        <h4>
                                            <i class="fa fa-bicycle push-5-r"></i>
                                            <a class="font-w600 text-primary" href="{{ url('/smart-team/aktiviti-detail/'.$xtvt->id.'') }}">
                                                {{ $xtvt->nama_aktiviti }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-right">
                                        <a href="{{ url('/smart-team/aktiviti-detail/'.$xtvt->id.'') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-list-ul"></i> Lihat Detail
                                        </a>
                                        @if (App\SmartTeam::where('id',$xtvt->smart_team_id)->where('senarai_jtk','LIKE','%,'.Auth::user()->id.',%')->count() == 1)
                                        <button class="btn btn-sm btn-primary" type="button" onclick="EditAktiviti('{{ $xtvt->id }}');">
                                            <i class="fa fa-pencil"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger" type="button" onclick="PadamAktiviti('{{ $xtvt->id }}');">
                                            <i class="fa fa-trash-o"></i> Delete
                                        </button>
                                        @endif
                                    </div>
                                    <div class="block-content">
                                        <div class="row items-push">
                                            <div class="col-md-6">
                                                <label class="h5 font-w300 push-5">Tarikh Aktiviti :</label>
                                                <div>
                                                    <div class="h6 panel panel-primary padding-10-all remove-margin-b">
                                                        {{ $xtvt->tarikh_dari_formatted }}
                                                        @if (strlen($xtvt->tarikh_hingga) != 0 && ($xtvt->tarikh_dari != $xtvt->tarikh_hingga))
                                                            - {{ $xtvt->tarikh_hingga_formatted }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="h5 font-w300 push-5">Juruteknik Terlibat :</label>
                                                <div>
                                                    <div class="h6 panel panel-primary padding-10-all remove-margin-b">
                                                        @if (strlen($xtvt->jtk_terlibat) == 0)
                                                            <i class="fa fa-users push-5-r"></i> Semua Ahli Kumpulan
                                                        @else
                                                            @foreach (explode(',', trim($xtvt->jtk_terlibat,',')) as $jtk)
                                                                <?php $_user = App\User::find($jtk); ?>
                                                                <img src="/avatar/{{ $_user->id }}" class="img-avatar img-avatar32" data-toggle="tooltip" title="{{ $_user->name }}">
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <label class="h5 font-w300 push-5">Tempat/Lokasi :</label>
                                                <div>
                                                    <div class="h6 panel panel-primary padding-10-all remove-margin-b">
                                                        @if (strlen($xtvt->tempat) == 0)
                                                        -
                                                        @else
                                                            @foreach (explode(',', trim($xtvt->tempat,',')) as $tempat)
                                                            <?php
                                                                $_sek = App\Sekolah::where('kod_sekolah',$tempat)->first();
                                                                $_pkg = App\PKG::where('kod_pkg',$tempat)->first();
                                                                $_ppd = App\PPD::where('kod_ppd',$tempat)->first();
                                                                if (count($_sek) > 0) {
                                                                    $_nama_tempat = $_sek->nama_sekolah_detail;//AEE1026
                                                                } else if (count($_pkg) > 0) {
                                                                    $_nama_tempat = $_pkg->kod_pkg." - ".$_pkg->pkg;
                                                                } else {
                                                                    $_nama_tempat = $_ppd->kod_ppd." - ".$_ppd->ppd;
                                                                }
                                                            ?>
                                                            <span class="badge badge-success">
                                                                {{ $_nama_tempat }}
                                                            </span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row items-push">
                                            <label class="col-sm-12 h5 font-w300 push-5">Objektif Aktiviti :</label>
                                            <div class="col-sm-12">
                                                <div id="v_objektif" class="h6 panel panel-primary padding-10-all remove-margin-b">
                                                    <?php $objektif = \Emojione\Emojione::toImage($xtvt->objektif); echo nl2br($objektif); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row items-push">
                                            <label class="col-sm-12 h5 font-w300 push-5">Keterangan/Laporan/Tugasan Aktiviti :</label>
                                            <div class="col-sm-12">
                                                <div id="v_detail" class="h6 panel panel-primary padding-10-all remove-margin-b">
                                                    <?php $detail = \Emojione\Emojione::toImage($xtvt->detail); echo nl2br($detail); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Aktiviti Dialog //-->
<div id="AktivitiDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popout">
        <div class="modal-content">
            <form method="post" class="form-horizontal" action="{{ url('/smart-team/aktiviti') }}">
                {{ csrf_field() }}
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">
                            <i class="fa fa-ambulance push-10-r"></i>Aktiviti : Kumpulan SMART Team
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 h5 font-w300 push-5">Tajuk Aktiviti :</label>
                                    <div class="col-sm-12">
                                        <input type="text" id="_tajuk_xtvt" name="_tajuk_xtvt" class="form-control" maxlength="255" placeholder="Tajuk aktiviti dijalankan..." required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 h5 font-w300 push-5">Tempat/Lokasi :</label>
                                    <div class="col-sm-12">
                                        <select multiple id="_tempat_lokasi" name="_tempat_lokasi[]" data-placeholder="Tempat/Lokasi.." class="form-control js-select2" style="width:100%;" required>
                                            
                                            <option value="{{ Auth::user()->kod_ppd }}">{{ Auth::user()->kod_ppd }} - {{ Auth::user()->nama_ppd_list }}</option>

                                            @foreach (App\PKG::where('kod_ppd',Auth::user()->kod_ppd)->get() as $pkg)
                                                <option value="{{ $pkg->kod_pkg }}">{{ $pkg->kod_pkg }} - {{ $pkg->pkg }}</option>
                                            @endforeach

                                            @foreach (App\Sekolah::where('kod_ppd',Auth::user()->kod_ppd)->get() as $sekolah)
                                                <option value="{{ $sekolah->kod_sekolah }}">{{ $sekolah->kod_sekolah }} - {{ $sekolah->nama_sekolah }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 h5 font-w300 push-5">Tarikh Aktiviti Dijalankan :</label>
                                    <div class="col-sm-12">
                                        <div class="input-daterange input-group" data-date-format="dd/mm/yyyy">
                                            <input class="form-control" type="text" id="_tarikh_xtvt_dari" name="_tarikh_xtvt_dari" placeholder="Dari" required>
                                            <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                                            <input class="form-control" type="text" id="_tarikh_xtvt_hingga" name="_tarikh_xtvt_hingga" placeholder="Hingga">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group push-5">
                                    <label class="col-sm-12 h5 font-w300 push-5">Juruteknik Terlibat :</label>
                                    <div class="col-sm-12">
                                        <select disabled multiple id="_jtk_terlibat" name="_jtk_terlibat[]" data-placeholder="Juruteknik.." class="form-control js-select2-avatar" style="width:100%;" required>
                                            @foreach (explode(',', trim($st->senarai_jtk,',')) as $user)
                                                <?php $_user = App\User::find($user); ?>
                                                <option value="{{ $_user->id }}">{{ $_user->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="push-5-t">
                                            <label class="css-input css-radio css-radio-primary push-10-r">
                                                <input type="radio" id="_jtk_semua" name="jtk_terlibat_type" value="0" onclick="javascript:$('#_jtk_terlibat').val('').trigger('change');$('#_jtk_terlibat').attr('disabled','disabled');" checked><span></span> Semua
                                            </label>
                                            <label class="css-input css-radio css-radio-primary">
                                                <input type="radio" id="_jtk_adhoc" name="jtk_terlibat_type" value="1" onclick="javascript:$('#_jtk_terlibat').removeAttr('disabled');"><span></span> Ad Hoc
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 h5 font-w300 push-5">Objektif Aktiviti :</label>
                            <div class="col-sm-12">
                                <textarea id="_objektif" name="_objektif" class="form-control js-emojis" placeholder="Objektif aktiviti" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 h5 font-w300 push-5">Keterangan/Laporan/Tugasan Aktiviti :</label>
                            <div class="col-sm-12">
                                <textarea id="_detail" name="_detail" class="form-control js-emojis" placeholder="Keterangan detail mengenai aktiviti yang akan dijalankan..." rows="5" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_u_save" class="btn btn-primary" type="submit">
                        <i class="fa fa-save push-5-r"></i>Simpan Rekod
                    </button>
                    <button id="btn_u_cancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:ClearAktivitiDialog();">
                        <i class="fa fa-times push-5-r"></i>Batal
                    </button>                
                    <input id="_smart_team_id" name="_smart_team_id" type="hidden" value="{{ $st->id }}" />
                    <input id="_xtvtid" name="_xtvtid" type="hidden" value="0" />
                </div>
            </form>
        </div>
    </div>
</div>

<!-- END Page Content -->
@endsection
