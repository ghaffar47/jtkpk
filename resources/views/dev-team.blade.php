@extends('master.app')
@section('title', 'Kumpulan Development Team')
@section('site.description', 'Senarai Kumpulan Development Team')
@section('app.helper', ",'summernote', 'ckeditor'")

@section('jquery')
@if (Request::is('dev-team/*'))
    @if (Auth::user()->IsKetuaKumpulan)
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
@endif
@endsection

@section('content')
<!-- Page Header -->
<div class="content bg-image overflow-hidden" style="background-image: url('/assets/img/photos/photo12@2x.jpg');">
    <div class="push-100-t push-15">
        <h1 class="h2 font-w300 text-white animated fadeInUp">
            <i class="fa fa-users push-15-r"></i> Development Team
        </h1>
    </div>
</div>
<!-- END Page Header -->

<!-- Menu -->
<div class="content padding-5-t bg-white border-b">
    <div class="push-15 push-10-t">
        <div class="row">
            <div class="col-xs-6">
                @if ($id != null)
                    <a href="/dev-team" class="btn btn-primary" data-toggle="tooltip" title="Kembali">
                        <i class="fa fa-arrow-circle-left"></i>
                    </a>
                @endif
                @if (Auth::user()->hasRole('leader'))
                    <button type="button" class="btn btn-success" onclick="javascript:AddGroupDialog();" data-toggle="tooltip" title="Tambah Kumpulan DevTeam">
                        <i class="fa fa-plus push-5-r"></i><i class="fa fa-users"></i>
                    </button>
                @endif
                @if (Request::is('dev-team/*'))
                    @if (Auth::user()->IsKetuaKumpulan)
                        <button type="button" class="btn btn-success" onclick="javascript:AddProjekDialog();" data-toggle="tooltip" title="Tambah Projek Kumpulan DevTeam">
                            <i class="fa fa-plus push-5-r"></i><i class="fa fa-th-large"></i>
                        </button>
                    @endif
                @endif
                
                @if (Auth::user()->hasRole('jpn') || Auth::user()->hasRole('ppd'))
                    <a href="/dev-team/senarai-projek/semua" class="btn btn-primary" data-toggle="tooltip" title="Senarai Semua Projek">
                        <i class="fa fa-list-ul push-5-r"></i> Senarai Projek
                    </a>
                @endif
            </div>
            <div class="col-xs-6 pull-right">
                <select name="_ppdsel" id="_ppdsel" data-placeholder="Sila pilih PPD" class="form-control js-select2" onchange="jump('parent',this,1)">
                    <option></option>
                    <option value="/dev-team">LIHAT SEMUA</option>
                    @foreach (App\PPD::all() as $_ppd)
                        <option value="/dev-team/{{ $_ppd->kod_ppd }}" {{ ($id == $_ppd->kod_ppd) ? 'selected':'' }}>{{ $_ppd->ppd }}</option>
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
                <div class="block-content">
                    @if ($id != null)
                        <center><h3 class="font-w300"><b>({{ $ppd->kod_ppd }})</b> {{ $ppd->ppd }}</h2></center>
                        <div class="content content-narrow content-full text-left">
                            @if (count(App\DevTeam::where('kod_ppd',$id)->get()) == 0)
                                <center>
                                    <h1><i class="fa fa-question fa-3x"></i></h1>
                                    <p>- Tiada Rekod -</p>
                                </center>
                            @else
                            
                            @foreach (App\DevTeam::where('kod_ppd',$id)->get() as $devteam)
                            <div class="block block-rounded block-bordered block-themed">
                                <div class="block-header bg-primary-dark">
                                    <a name="{{ $devteam->id }}" id="{{ $devteam->id }}"></a>
                                    <div class="block-options-simple">
                                        @if (count($devteam->projek) > 0)
                                            <a href="/dev-team/projek/{{ $devteam->id }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat Projek">
                                                <i class="fa fa-th push-5-r"></i> Lihat Projek ( {{ count($devteam->projek) }} )
                                            </a>
                                        @endif

                                        @if (Auth::user()->hasRole('leader'))
                                            <a href="#" onclick="javascript:EditDevTeam('{{ $devteam->id }}');return false;" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit Kumpulan">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="#" onclick="javascript:DeleteDevTeam('{{ $devteam->id }}');return false;" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Padam Kumpulan">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <h3 class="h3 text-white font-w300 text-left">{{ $devteam->nama_kumpulan }}</h3>
                                </div>
                                <div class="block-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 120px;"><i class="fa fa-user"></i></th>
                                                    <th>Nama Juruteknik</th>
                                                    <th><i class="fa fa-envelope push-10-r"></i>Alamat E-mel</th>
                                                    <th>Sekolah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Ketua Kumpulan -->
                                                <?php $KetuaKumpulan = $devteam->ketua_kumpulan; $_userkk = App\User::find($KetuaKumpulan);?>
                                                <tr>
                                                    <td class="text-center">
                                                        <img class="img-avatar img-avatar48" src="/avatar/{{ $KetuaKumpulan }}" title="{{ $_userkk->name }}">
                                                    </td>
                                                    <td>
                                                        {{ $_userkk->name }} (<i>Ketua Kumpulan</i>)
                                                    </td>
                                                    <td><a href="mailto:{{ $_userkk->email }}">{{ $_userkk->email }}</a></td>
                                                    <td>{{ $_userkk->jabatan->nama_sekolah_detail }}</td>
                                                </tr>

                                                @foreach (explode(',',trim($devteam->senarai_jtk,',')) as $userid)
                                                    <?php
                                                        if ($userid == $KetuaKumpulan) {
                                                            continue;
                                                        }
                                                        $_user = App\User::find($userid);
                                                    ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <img class="img-avatar img-avatar48" src="/avatar/{{ $_user->id }}" title="{{ $_user->name }}">
                                                        </td>
                                                        <td>
                                                            {{ $_user->name }}
                                                        </td>
                                                        <td><a href="mailto:{{ $_user->email }}">{{ $_user->email }}</a></td>
                                                        <td>{{ $_user->jabatan->nama_sekolah_detail }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            @endif
                        </div>
                    @else
                        @foreach (App\PPD::all() as $ppd)
                            <div class="block block-rounded block-bordered">
                                <div class="block-header bg-gray-lighter">
                                    <ul class="block-options">
                                        <li>
                                            <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                                        </li>
                                    </ul>
                                    <h3 class="block-title">
                                        <a href="/dev-team/{{ $ppd->kod_ppd }}">{{ $ppd->ppd }}</a>
                                    </h3>
                                </div>
                                <div class="block-content">
                                    <?php $dev_team = App\DevTeam::where('kod_ppd',$ppd->kod_ppd)->get(); ?>
                                    @if ($dev_team->count() == 0)
                                        <center><p>- Tiada Kumpulan Development Team -</p></center>
                                    @else
                                        <div class="row">
                                            @foreach ($dev_team as $dt)
                                            <div class="col-sm-6 col-md-4">
                                                <a class="block block-bordered block-link-hover3" href="{{ url('/dev-team/'.$ppd->kod_ppd.'') }}">
                                                    <div class="block-content bg-gray-lighter block-content-full text-center">
                                                        <div><i class="fa fa-users fa-3x"></i></div>
                                                        <div class="h5 push-15-t push-5">{{ ucwords($dt->nama_kumpulan) }}</div>
                                                        <div class="text-muted push-5"><b>Ketua :</b> {{ $dt->ketua->name }}</div>
                                                        <div class="text-muted push-10">
                                                            @foreach (explode(',',$dt->senarai_jtk) as $ahli)
                                                                <?php if (strlen($ahli) == 0) { continue; }?>
                                                                <img src="/avatar/{{ $ahli }}" class="img-avatar img-avatar32" data-toggle="tooltip" title="{{ App\User::find($ahli)->name }}"> 
                                                            @endforeach
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-6 border-r">
                                                                <h2 class="font-w300">{{ count($dt->projek) }}</h2>
                                                                <span class="text-primary"><small>Projek</small></span>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <h2 class="font-w300">{{ $dt->jumlah_ahli }}</h2>
                                                                <span class="text-primary"><small>Ahli</small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->

@if (Auth::user()->hasRole('leader'))
<!-- Group Dialog //-->
<div id="GroupDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popout">
        <div class="modal-content">
            <form method="post" class="form-horizontal" action="{{ url('/dev-team') }}">
                {{ csrf_field() }}
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">
                            <i class="fa fa-user push-10-r"></i>Kumpulan Development Team
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group items-push border-b">
                            <label class="col-sm-4 control-label">Jabatan (PPD) :</label>
                            <div class="col-sm-8">
                                <select id="_kodppd" name="_kodppd" data-placeholder="PPD" class="form-control js-select2" style="width:100%;" required>
                                    <option></option>
                                    @foreach (App\PPD::all() as $ppd)
                                        <option value="{{ $ppd->kod_ppd }}">{{ $ppd->ppd }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-4 control-label">Nama Kumpulan :</label>
                            <div class="col-sm-8">
                                <input type="text" id="_name" name="_name" class="form-control" maxlength="255" placeholder="Nama Kumpulan" required>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-4 control-label">Ketua Kumpulan :</label>
                            <div class="col-sm-8">
                                <select id="_ketua" name="_ketua" data-placeholder="Ketua Kumpulan" class="form-control js-select2-avatar" style="width:100%;" required>
                                    <option></option>
                                    @foreach (App\User::where('kod_ppd',Auth::user()->kod_ppd)->where('kod_jabatan','<>','')->get() as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Senarai Ahli Kumpulan (Termasuk Ketua) :</label>
                            <div class="col-sm-8">
                                <select multiple id="_jtk" name="_jtk[]" data-placeholder="Ahli-Ahli" class="form-control js-select2-avatar" style="width:100%;" required>
                                    @foreach (App\User::where('kod_ppd',Auth::user()->kod_ppd)->where('kod_jabatan','<>','')->get() as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_u_save" class="btn btn-primary" type="submit">
                        <i class="fa fa-save push-5-r"></i>Simpan Rekod
                    </button>
                    <button id="btn_u_cancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:ClearAddGroup();">
                        <i class="fa fa-times push-5-r"></i>Batal
                    </button>                
                    <input id="_gid" name="_gid" type="hidden" value="0" />
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('dev-team/*'))
@if (Auth::user()->IsKetuaKumpulan)
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
@endif

@endsection
