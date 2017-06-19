@extends('master.app')
@section('title', 'Senarai Projek')
@section('site.description', 'Senarai Projek')
@section('app.helper', ",'summernote', 'ckeditor'")

@section('jquery')
$('#Projek').DataTable({ responsive: true });

@if (Auth::user()->hasRole('leader'))
var previewNode = $('.template');
var previewTemplate = previewNode.parent().html();
previewNode.remove();

var UploadKertasKerja = $('#btn-kertas-kerja').dropzone({
    url: '/dev-team/projek/kertas-kerja',
    params: {
        _token: "{{ csrf_token() }}"
    },
    acceptedFiles: '.pdf,.doc,.docx',
    maxFilesize: 5,
    maxFiles: 1,
    createImageThumbnails: false,
    previewTemplate : previewTemplate,
    previewsContainer : '#_previews',
    init: function()
    {
        this.on("addedfile", function(file){
            $('.template').parent().append('<input class="kk" type="hidden" name="kk" data-name="'+file.name+'" data-file="" value="">');
        });
        this.on("uploadprogress", function(file, progress, bytesSent) {
            $('.progress-bar').html(progress + ' %');
        });
        this.on("processing", function(file) {
            $("#btn-kertas-kerja").attr("disabled","disabled");
        });
        this.on("success", function(file) {
            var ret = file.xhr.response;
            var txt = ret.split('|');
            if (txt[0] == "OK") {
                $(".cancel").addClass("hide");
                $(".delete").removeClass("hide");
                $("#btn-kertas-kerja").addClass("hide");
                $(".progress").addClass("hide");
                $('[data-name="'+file.name+'"]').val(file.name+'|'+txt[1]);
                $('[data-name="'+file.name+'"]').attr('data-file', txt[1]);
            } else {
                SweetAlert('error','Ops !',txt[1]);
            }
        });
        this.on("removedfile", function(file) {
            $(".progress").removeClass("hide");
            $("#btn-kertas-kerja").removeClass("hide");
            RemoveFile($('[data-name="'+file.name+'"]').attr('data-file'));
            $('[data-name="'+file.name+'"]').remove();
        });
        this.on("complete", function() {
            $("#btn-kertas-kerja").removeAttr("disabled");
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
<div class="content bg-image overflow-hidden" style="background-image: url('/assets/img/photos/photo12@2x.jpg');">
    <div class="push-100-t push-15">
        <h1 class="h2 font-w300 text-white animated fadeInUp">
            <i class="fa fa-th push-15-r"></i> Senarai Projek
        </h1>
    </div>
</div>
<!-- END Page Header -->

<!-- Menu -->
<div class="content padding-5-t bg-white border-b">
    <div class="push-15 push-10-t">
        <div class="row">
            <div class="col-xs-6">
                <a href="/dev-team/{{ $kodppd }}" class="btn btn-primary" data-toggle="tooltip" title="Kembali">
                    <i class="fa fa-arrow-circle-left"></i>
                </a>
                @if (Auth::user()->hasRole('leader'))
                    <button type="button" class="btn btn-success" onclick="javascript:AddProjekDialog();" data-toggle="tooltip" title="Tambah Projek Kumpulan DevTeam">
                        <i class="fa fa-plus push-5-r"></i><i class="fa fa-th-large"></i>
                    </button>
                @endif
            </div>
            <div class="col-xs-6 pull-right">
                <select name="_ppdsel" id="_ppdsel" data-placeholder="Sila pilih PPD" class="form-control js-select2" onchange="jump('parent',this,1)">
                    <option></option>
                    <option value="/dev-team">LIHAT SEMUA</option>
                    @foreach (App\PPD::all() as $ppd)
                        <option value="/dev-team/{{ $ppd->kod_ppd }}" {{ ($kodppd == $ppd->kod_ppd) ? 'selected':'' }}>{{ $ppd->ppd }}</option>
                    @endforeach
                </select>
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
                <div class="block-content push-20">
                    <div class="pull-left">
                        <h5>
                            <span class="font-w300">KUMPULAN : </span>
                            <b>{{ $nama_kumpulan }}</b>
                        </h5>
                    </div>
                    <div class="pull-right">
                        <h5>
                            <span class="font-w300">PPD : </span>
                            <b>{{ $namappd }}</b>
                        </h5>
                    </div>
                </div>
                <div class="block-content">
                    <table id="Projek" class="table table-striped table-bordered responsive h6">
                        <thead>
                            <tr>
                                <th class="text-center">Bil</th>
                                <th class="text-center">Nama Projek</th>
                                <th class="text-center">Peratus Siap</th>
                                <th class="text-center">Jumlah Task</th>
                                <th class="text-center">Jumlah Task (Belum Selesai)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($projek as $prj)
                            <?php $i++; ?>
                            <tr>
                                <td class="text-center">{{ $i }}.</td>
                                <td>
                                    <a href="/dev-team/projek/{{ $prj->id }}/tasks">
                                        <span class="font-w300 h5 text-primary">{{ $prj->nama_projek }}</span>
                                    </a>
                                </td>
                                <td class="text-center h3 font-w300">
                                    @if ($prj->tasks->count() != 0)
                                        {{ number_format((($prj->tasks->sum('peratus_siap') / ($prj->tasks->count()*100) ) * 100),2) }} %
                                    @else
                                        0.00 %
                                    @endif
                                </td>
                                <td class="text-center h3 font-w300">{{ $prj->tasks->count() }}</td>
                                <td class="text-center h3 font-w300">{{ $prj->tasks->where('peratus_siap','<>','100')->count() }}</td>
                                <td class="text-center" width="200">
                                    <button type="button" class="btn btn-primary" onclick="javascript:ViewProjek('{{ $prj->id }}');" data-toggle="tooltip" title="Lihat Detail Projek">
                                        <i class="fa fa-briefcase"></i>
                                    </button>
                                    <a href="/dev-team/projek/{{ $prj->id }}/tasks" class="btn btn-primary" data-toggle="tooltip" title="Lihat Semua Task">
                                        <i class="fa fa-th-list"></i>
                                    </a>
                                    @if (Auth::user()->hasRole('leader') && Auth::user()->kod_ppd == $kodppd)
                                        <button type="button" class="btn btn-primary" onclick="javascript:EditProjek('{{ $prj->id }}');" data-toggle="tooltip" title="Edit Maklumat Projek">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="javascript:DeleteProjek('{{ $prj->id }}');" data-toggle="tooltip" title="Padam Projek">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    @endif
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

@if (Auth::user()->hasRole('leader'))
<!-- Projek Dialog //-->
<div id="ProjekDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popout">
        <div class="modal-content">
            <form method="post" class="form-horizontal" action="{{ url('/dev-team/projek') }}">
                {{ csrf_field() }}
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">
                            <i class="fa fa-user push-10-r"></i>Projek : Kumpulan Development Team
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 h5 font-w300 push-5">Kumpulan Dev Team :</label>
                                    <div class="col-sm-12">
                                        <select id="_devteam" name="_devteam" data-placeholder="Kumpulan Dev Team" class="form-control js-select2" style="width:100%;" required>
                                            <option></option>
                                            @foreach (App\DevTeam::where('kod_ppd',Auth::user()->kod_ppd)->get() as $devteam)
                                                <option value="{{ $devteam->id }}">{{ $devteam->nama_kumpulan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 h5 font-w300 push-5">Nama Projek :</label>
                                    <div class="col-sm-12">
                                        <input type="text" id="_nama_projek" name="_nama_projek" class="form-control" maxlength="255" placeholder="Nama Projek" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 h5 font-w300 push-5">Objektif Projek :</label>
                            <div class="col-sm-12">
                                <textarea id="_objektif" name="_objektif" class="form-control js-emojis" placeholder="Objektif projek" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 h5 font-w300 push-5">Keterangan Projek :</label>
                            <div class="col-sm-12">
                                <textarea id="_detail" name="_detail" class="form-control js-emojis" placeholder="Keterangan detail mengenai projek yang akan dilaksanakan..." rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 h5 font-w300 push-5">Kertas Kerja :</label>
                                    <div class="col-sm-12">
                                        <button id="btn-kertas-kerja" type="button" class="btn btn-primary">
                                            <i class="fa fa-paperclip push-5-r"></i> Upload Kertas Kerja
                                        </button>
                                        <div id="_previews">
                                            <div class="template panel panel-primary remove-margin-b push-5-t">
                                                <div class="panel-body">
                                                    <div class="push-5">
                                                        <h5>
                                                            <span class="h6">
                                                                <i class="fa fa-file"></i>&nbsp; <span data-dz-name></span>
                                                            </span>
                                                            <span class="pull-right font-w300" data-dz-size></span>
                                                        </h5>
                                                    </div>
                                                    <div class="progress active remove-margin-b">
                                                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%" data-dz-uploadprogress></div>
                                                    </div>
                                                    <div class="push-5-t">
                                                        <button data-dz-remove class="btn btn-sm btn-warning cancel">
                                                            <i class="fa fa-times"></i> Batal
                                                        </button> 
                                                        <button data-dz-remove class="btn btn-sm btn-danger delete hide">
                                                            <i class="fa fa-trash-o"></i> Padam
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 h5 font-w300 push-5">Repositori Projek (Jika ada) : <a href="https://www.google.com/search?q=apa+itu+repositori+github" target="_blank">Apakah Repositori ?</a></label>
                                    <div class="col-sm-12">
                                        <input type="text" id="_repo" name="_repo" class="form-control" maxlength="255" placeholder="Contoh: https://github.com/nama/projek-saya.git">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_u_save" class="btn btn-primary" type="submit">
                        <i class="fa fa-save push-5-r"></i>Simpan Rekod
                    </button>
                    <button id="btn_u_cancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:ClearAddProjek();">
                        <i class="fa fa-times push-5-r"></i>Batal
                    </button>                
                    <input id="_projekid" name="_projekid" type="hidden" value="0" />
                </div>
            </form>
        </div>
    </div>
</div>
@endif
<!-- View Projek Dialog //-->
<div id="ViewProjekDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popout">
        <div class="modal-content">
            <form method="post" class="form-horizontal">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">
                            <i class="fa fa-user push-10-r"></i>Projek : Kumpulan Development Team
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 h5 font-w600 push-5">Kumpulan Dev Team :</label>
                                    <div id="v_devteam" class="col-sm-12">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 h5 font-w600 push-5">Nama Projek :</label>
                                    <div id="v_nama_projek" class="col-sm-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 h5 font-w600 push-5">Objektif Projek :</label>
                            <div class="col-sm-12">
                                <div id="v_objektif" class="panel panel-primary padding-10-all remove-margin-b">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 h5 font-w600 push-5">Keterangan Projek :</label>
                            <div class="col-sm-12">
                                <div id="v_detail" class="panel panel-primary padding-10-all remove-margin-b">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 h5 font-w600 push-5">Kertas Kerja :</label>
                                    <div class="col-sm-12">
                                        <div id="v_previews"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 h5 font-w600 push-5">Repositori Projek (Jika ada) : <a href="https://www.google.com/search?q=apa+itu+repositori+github" target="_blank">Apakah Repositori ?</a></label>
                                    <div id="v_repo" class="col-sm-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_u_cancel" data-dismiss="modal" class="btn btn-default" type="button">
                        <i class="fa fa-check push-5-r"></i>OK
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection
