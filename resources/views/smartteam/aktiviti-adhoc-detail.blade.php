@extends('master.app')
@section('title', 'Detail Aktiviti')
@section('site.description', 'Detail Aktiviti')
@section('app.helper', ",'summernote', 'ckeditor'")

@section('jquery')
@if ($xtvt->where('jtk_terlibat','LIKE','%,'.Auth::user()->id.',%')->count() == 1 || Auth::user()->hasRole('ppd') || strlen($xtvt->jtk_terlibat) == 0)
$('#btn-add-gambar').click(function(){ $('#upload-gambar').toggle(); });
Dropzone.autoDiscover = false;
$('#upload-gambar').dropzone({
    url: '/smart-team/aktiviti/upload-gambar/{{ $xtvt->id }}',
    params: {
        _token: "{{ csrf_token() }}",
        _adhoc: 1
    },
    acceptedFiles: '.jpg,.jpeg,.png',
    maxFilesize: 5,
    maxFiles: 10,
    addRemoveLinks: false,
    dictDefaultMessage: "Letakkan gambar anda di sini atau klik di sini",
    dictFileTooBig: "Saiz fail terlalu besar ! (Max: 5MB)",
    dictInvalidFileType: "Anda tidak dibenarkan muat naik jenis fail ini !",
    dictCancelUpload: "Batal",
    dictCancelUploadConfirmation: "Anda pasti untuk batal ?",
    dictRemoveFile: "Padam",
    dictMaxFilesExceeded: "Dibenarkan 10 gambar untuk satu sesi.",

    init: function()
    {
        this.on("addedfile", function(file){
            $('#upload-gambar').parent().append('<input class="gambar" type="hidden" data-name="'+file.name+'" data-public="">');
        });
        this.on("success", function(file) {
            var ret = file.xhr.response;
            var txt = ret.split('|');
            if (txt[0] == "OK") {
                $('[data-name="'+file.name+'"]').attr('data-public', txt[1]);
            } else {
                SweetAlert('error','Ops !',txt[0]);
            }
        });
        this.on("removedfile", function(file) {
            PadamGambar($('[data-name="'+file.name+'"]').attr('data-public'));
            $('[data-name="'+file.name+'"]').remove();
        });
        this.on("complete", function() {
            window.location.href = '/smart-team/aktiviti-adhoc-detail/{{ $xtvt->id }}';
        });
        this.on("error", function(file, errorMessage) {
            console.log(errorMessage);
            setTimeout(function(){ SweetAlert('error','Ops !',errorMessage); },500);
        });
    }
});
@endif
@endsection

@section('content')
<!-- Page Header -->
<div class="content bg-image overflow-hidden" style="background-image: url('/assets/img/photos/photo3@2x.jpg');">
    <div class="push-50-t push-15">
        <h1 class="h2 text-white animated fadeInUp">
            <i class="fa fa-ambulance push-15-r"></i> <span class="font-w300">Aktiviti Detail :</span> {{ $xtvt->nama_aktiviti }}
        </h1>
    </div>
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content content-narrow">
    <div class="row">
        <div class="col-xs-12">
            <div class="block block-themed block-rounded push-5">
                <div class="block-content block-content-full block-content-mini border-b bg-gray-lighter clearfix">
                    <a href="{{ url('/smart-team/'.$xtvt->kod_ppd.'') }}" class="btn btn-primary" data-toggle="tooltip" title="Kembali">
                        <i class="fa fa-arrow-circle-left"></i>
                    </a>
                    <div class="pull-right">
                    </div>
                </div>
                
                <div class="block-content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="block block-bordered">
                                <div class="block-header bg-gray-lighter">
                                    
                                    <div class="block-options-simple">
                                        @if ((Auth::user()->hasRole('ppd') && Auth::user()->kod_ppd == $xtvt->kod_ppd) || App\AktivitiAdhoc::where('id',$xtvt->id)->where('jtk_terlibat','LIKE','%,'.Auth::user()->id.',%')->count() == 1 || strlen($xtvt->jtk_terlibat) == 0)
                                            <button class="btn btn-sm btn-primary" type="button" onclick="EditAktivitiAdhoc('{{ $xtvt->id }}');">
                                                <i class="fa fa-pencil"></i> Edit
                                            </button>
                                        @endif
                                        @if (Auth::user()->hasRole('ppd') && Auth::user()->kod_ppd == $xtvt->kod_ppd)
                                            <button class="btn btn-sm btn-danger" type="button" onclick="PadamAktivitiAdhoc('{{ $xtvt->id }}');">
                                                <i class="fa fa-trash-o"></i> Delete
                                            </button>
                                        @endif
                                    </div>
                                    <h2 class="font-w300">
                                        {{ $xtvt->nama_aktiviti }}
                                    </h2>
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
                                                        <i class="fa fa-users push-5-r"></i> Semua Juruteknik Terlibat
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
                                            <label class="h5 font-w300 push-5">Sekolah Terlibat :</label>
                                            <div>
                                                <div class="h6 panel panel-primary padding-10-all remove-margin-b">
                                                    @if (strlen($xtvt->sekolah_terlibat) == 0)
                                                    -
                                                    @else
                                                        @foreach (explode(',', trim($xtvt->sekolah_terlibat,',')) as $sek)
                                                            <?php $_sek = App\Sekolah::where('kod_sekolah',$sek)->first(); ?>
                                                            <span class="badge badge-success">
                                                             {{ $_sek->nama_sekolah_detail }}
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
                                    <div class="row items-push">
                                        <label class="col-md-6 h5 font-w300 push-5">Gambar Aktiviti :</label>
                                        @if (App\AktivitiAdhoc::where('id',$xtvt->id)->where('jtk_terlibat','LIKE','%,'.Auth::user()->id.',%')->count() == 1 || strlen($xtvt->jtk_terlibat) == 0)
                                        <div class="col-md-6 text-right">
                                            <button id="btn-add-gambar" type="button" class="btn btn-success">
                                                <i class="fa fa-picture-o push-5-r"></i>Upload Gambar Aktiviti
                                            </button>
                                        </div>
                                        @endif
                                        <div class="col-sm-12">
                                            <div id="v_gambar" class="h6 panel bg-gray-lighter panel-primary padding-10-all remove-margin-b">
                                                @if (App\GambarAktivitiSmartTeam::where('xtvt_id',$xtvt->id)->where('JenisAktiviti','ADHOC')->count() == 0)
                                                    <center>
                                                        <i class="fa fa-picture-o fa-4x"></i>
                                                        <div class="push-10 push-5-t">- Tiada Gambar Aktiviti -</div>
                                                    </center>
                                                @else
                                                    <div class="row items-push js-gallery">
                                                        @foreach (App\GambarAktivitiSmartTeam::where('xtvt_id',$xtvt->id)->where('JenisAktiviti','ADHOC')->get() as $gambar)
                                                        <div class="gambar_{{ $gambar->public_id }} col-sm-6 col-md-4 col-lg-3 animated fadeIn">
                                                            <a class="img-link img-thumb" href="{{ $gambar->url_img }}">
                                                                <img class="img-responsive" src="{{ $gambar->url_img }}">
                                                            </a>
                                                            @if (App\AktivitiAdhoc::where('id',$xtvt->id)->where('jtk_terlibat','LIKE','%,'.Auth::user()->id.',%')->count() == 1 || Auth::user()->hasRole('ppd') || strlen($xtvt->jtk_terlibat) == 0)
                                                            <span>
                                                                <button type="button" class="btn btn-sm btn-danger" onclick="javascript:PadamGambarAktivitiConfirm('{{ $gambar->public_id }}');">
                                                                    <i class="fa fa-trash-o"></i> Padam
                                                                </button>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                            <div id="upload-gambar" style="display:none;" class="push-10-t dropzone"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if ((Auth::user()->hasRole('ppd') && Auth::user()->kod_ppd == $xtvt->kod_ppd) || App\AktivitiAdhoc::where('id',$xtvt->id)->where('jtk_terlibat','LIKE','%,'.Auth::user()->id.',%')->count() == 1 || strlen($xtvt->jtk_terlibat) == 0)
<!-- Aktiviti Dialog //-->
<div id="AktivitiDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popout">
        <div class="modal-content">
            <form method="post" class="form-horizontal" action="{{ url('/smart-team/aktiviti-adhoc') }}">
                {{ csrf_field() }}
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">
                            <i class="fa fa-ambulance push-10-r"></i>Aktiviti Ad-Hoc
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
                                    <label class="col-sm-12 h5 font-w300 push-5">Sekolah Terlibat :</label>
                                    <div class="col-sm-12">
                                        <select multiple id="_sekolah_terlibat" name="_sekolah_terlibat[]" data-placeholder="Sekolah.." class="form-control js-select2" style="width:100%;" required>
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
                                            @foreach (App\User::where('kod_ppd',Auth::user()->kod_ppd)->where('kod_jabatan','<>','')->get() as $jtk)
                                                <option value="{{ $jtk->id }}">{{ $jtk->name }}</option>
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
                    <input id="_xtvtid" name="_xtvtid" type="hidden" value="0" />
                </div>
            </form>
        </div>
    </div>
</div>
@endif
<!-- END Page Content -->
@endsection