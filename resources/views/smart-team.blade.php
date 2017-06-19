@extends('master.app')
@section('title', 'Kumpulan SMART Team')
@section('site.description', 'Senarai Kumpulan SMART Team')
@section('app.helper', ",'summernote', 'ckeditor'")

@section('jquery')
$('#XtvtAdhoc').DataTable();
@endsection

@section('content')
<!-- Page Header -->
<div class="content bg-image overflow-hidden" style="background-image: url('/assets/img/photos/photo12@2x.jpg');">
    <div class="push-100-t push-15">
        <h1 class="h2 font-w300 text-white animated fadeInUp">
            <i class="fa fa-ambulance push-15-r"></i> SMART Team
        </h1>
    </div>
</div>
<!-- END Page Header -->

<!-- Menu -->
<div class="content padding-5-t bg-white border-b">
    <div class="push-15 push-10-t">
        <div class="row">
            <div class="col-xs-6">
                @if (strlen($kod_ppd) != 0)
                    <a href="/smart-team" class="btn btn-primary" data-toggle="tooltip" title="Kembali">
                        <i class="fa fa-arrow-circle-left"></i>
                    </a>
                @endif
                @if (Auth::user()->hasRole('leader'))
                    <button type="button" class="btn btn-success" onclick="javascript:AddSTDialog();" data-toggle="tooltip" title="Tambah Kumpulan SMART Team">
                        <i class="fa fa-plus push-5-r"></i><i class="fa fa-ambulance"></i>
                    </button>
                @endif
            </div>
            <div class="col-xs-6 pull-right">
                <select name="_ppdsel" id="_ppdsel" data-placeholder="Sila pilih PPD" class="form-control js-select2" onchange="jump('parent',this,1)">
                    <option></option>
                    <option value="/smart-team">LIHAT SEMUA</option>
                    @foreach (App\PPD::all() as $_ppd)
                        <option value="/smart-team/{{ $_ppd->kod_ppd }}" {{ ($kod_ppd == $_ppd->kod_ppd) ? 'selected':'' }}>{{ $_ppd->ppd }}</option>
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
                    @if (strlen($kod_ppd) != 0)
                        @foreach (App\PPD::where('kod_ppd',$kod_ppd)->get() as $ppd)
                            <div class="block block-rounded block-bordered block-themed">
                                <div class="block-header bg-primary-dark">
                                    <ul class="block-options">
                                        <li>
                                            <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                                        </li>
                                    </ul>
                                    <h3 class="block-title">AKTIVITI LAIN (AD-HOC)</h3>
                                </div>
                                
                                @if (!Auth::user()->hasRole('jpn'))
                                <div class="block-content block-content-full block-content-mini bg-gray-lighter remove-margin-b border-b text-right">
                                    <button type="button" class="btn btn-primary" onclick="javascript:AddAktivitiAdhocDialog();">
                                        <i class="fa fa-plus push-5-r"></i>Tambah Aktiviti
                                    </button>
                                </div>
                                @endif
                                
                                <div class="block-content">
                                    <table id="XtvtAdhoc" class="table table-striped table-bordered responsive h6">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Bil</th>
                                                <th class="text-center">Nama Aktiviti</th>
                                                <th class="text-center">Tarikh Aktiviti</th>
                                                <th class="text-center">Juruteknik Terlibat</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (App\AktivitiAdhoc::where('kod_ppd',$kod_ppd)->get()->count() > 0)
                                                <?php $i=0; ?>
                                                @foreach (App\AktivitiAdhoc::where('kod_ppd',$kod_ppd)->get() as $xtvt)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td class="text-center">{{ $i }}.</td>
                                                    <td class="h5 font-w300">
                                                        <a href="/smart-team/aktiviti-adhoc-detail/{{ $xtvt->id }}">
                                                            {{ $xtvt->nama_aktiviti }}
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $xtvt->tarikh_dari_formatted }}
                                                        @if (strlen($xtvt->tarikh_hingga) != 0 && ($xtvt->tarikh_dari != $xtvt->tarikh_hingga))
                                                            - {{ $xtvt->tarikh_hingga_formatted }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if (strlen($xtvt->jtk_terlibat) != 0)
                                                            {{ count(explode(',',trim($xtvt->jtk_terlibat,','))) }} Orang
                                                        @else
                                                            Semua
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="/smart-team/aktiviti-adhoc-detail/{{ $xtvt->id }}" class="btn btn-sm btn-primary">
                                                            Lihat Aktiviti
                                                        </a>
                                                        @if (Auth::user()->kod_ppd == $kod_ppd)
                                                        <button type="button" class="btn btn-sm btn-primary" onclick="javascript:EditAktivitiAdhoc('{{ $xtvt->id }}');">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                        @endif
                                                        @if (Auth::user()->hasRole('ppd') || App\AktivitiAdhoc::where('id',$xtvt->id)->where('jtk_terlibat','LIKE','%,'.Auth::user()->id.',%')->count() == 1 || strlen($xtvt->jtk_terlibat) == 0)
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="javascript:PadamAktivitiAdhoc('{{ $xtvt->id }}');">
                                                            <i class="fa fa-trash-o"></i>
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="block block-rounded block-bordered block-themed">
                                <div class="block-header bg-primary-dark">
                                    <ul class="block-options">
                                        <li>
                                            <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                                        </li>
                                    </ul>
                                    <h3 class="block-title">{{ $ppd->ppd }}</h3>
                                </div>
                                <div class="block-content">
                                    <?php $smart_team = App\SmartTeam::where('kod_ppd',$ppd->kod_ppd)->get(); ?>
                                    @if ($smart_team->count() == 0)
                                        <center><p>- Tiada Kumpulan SMART Team -</p></center>
                                    @else
                                        <div class="row">
                                            @foreach ($smart_team as $st)
                                            <div class="col-sm-6 col-md-4">
                                                <a class="block block-bordered block-link-hover3" href="{{ url('/smart-team/detail/'.$st->id.'') }}">
                                                    <div class="block-content bg-gray-lighter block-content-full text-center">
                                                        <div><i class="fa fa-ambulance fa-3x"></i></div>
                                                        <div class="h5 push-15-t push-5">{{ ucwords($st->nama_kumpulan) }}</div>
                                                        <div class="text-muted push-5"><b>Ketua :</b> {{ $st->ketua->name }}</div>
                                                        <div class="text-muted push-10">
                                                            @foreach (explode(',',trim($st->senarai_jtk,',')) as $ahli)
                                                                <img src="/avatar/{{ $ahli }}" class="img-avatar img-avatar32" data-toggle="tooltip" title="{{ App\User::find($ahli)->name }}"> 
                                                            @endforeach
                                                        </div>
                                                        <div class="row push">
                                                            <div class="col-xs-6 border-r">
                                                                <h2 class="font-w300">{{ count($st->aktiviti) }}</h2>
                                                                <span class="text-primary"><small>Aktiviti</small></span>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <h2 class="font-w300">{{ $st->jumlah_ahli }}</h2>
                                                                <span class="text-primary"><small>Ahli</small></span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-block btn-success">
                                                            Lihat Kumpulan
                                                        </button>
                                                    </div>                                                    
                                                </a>
                                                @if (Auth::user()->hasRole('leader') && Auth::user()->kod_ppd == $kod_ppd)
                                                <div class="push-10 text-right">
                                                    <button type="button" class="btn btn-xs btn-primary" onclick="javascript:EditSTTeam('{{ $st->id }}');">
                                                        <i class="fa fa-pencil"></i> Edit
                                                    </button>
                                                    <button type="button" class="btn btn-xs btn-danger" onclick="javascript:DeleteSTTeam('{{ $st->id }}');">
                                                        <i class="fa fa-trash-o"></i> Padam
                                                    </button>
                                                </div>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
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
                                        <a href="/smart-team/{{ $ppd->kod_ppd }}">{{ $ppd->ppd }}</a>
                                    </h3>
                                </div>
                                <div class="block-content">
                                    <?php $smart_team = App\SmartTeam::where('kod_ppd',$ppd->kod_ppd)->get(); ?>
                                    @if ($smart_team->count() == 0)
                                        <center><p>- Tiada Kumpulan SMART Team -</p></center>
                                    @else
                                        <div class="row">
                                            @foreach ($smart_team as $st)
                                            <div class="col-sm-6 col-md-4">
                                                <!--<a class="block block-bordered block-link-hover3" href="{{ url('/smart-team/detail/'.$st->id.'') }}">-->
                                                <a class="block block-bordered block-link-hover3" href="{{ url('/smart-team/'.$st->kod_ppd.'') }}">
                                                    <div class="block-content bg-gray-lighter block-content-full text-center">
                                                        <div><i class="fa fa-ambulance fa-3x"></i></div>
                                                        <div class="h5 push-15-t push-5">{{ ucwords($st->nama_kumpulan) }}</div>
                                                        <div class="text-muted push-5"><b>Ketua :</b> {{ $st->ketua->name }}</div>
                                                        <div class="text-muted push-10">
                                                            @foreach (explode(',',$st->senarai_jtk) as $ahli)
                                                                <?php if (strlen($ahli) == 0) { continue; }?>
                                                                <img src="/avatar/{{ $ahli }}" class="img-avatar img-avatar32" data-toggle="tooltip" title="{{ App\User::find($ahli)->name }}"> 
                                                            @endforeach
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-6 border-r">
                                                                <h2 class="font-w300">{{ count($st->aktiviti) }}</h2>
                                                                <span class="text-primary"><small>Aktiviti</small></span>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <h2 class="font-w300">{{ $st->jumlah_ahli }}</h2>
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

@if (Auth::user()->hasRole('leader'))
<!-- Smart Team Dialog //-->
<div id="STDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popout">
        <div class="modal-content">
            <form method="post" class="form-horizontal" action="{{ url('/smart-team') }}">
                {{ csrf_field() }}
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">
                            <i class="fa fa-user push-10-r"></i>Kumpulan SMART Team
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

@if (!Auth::user()->hasRole('jpn'))
<!-- Aktiviti Adhoc Dialog //-->
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
                    <button id="btn_u_cancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:ClearAktivitiAdhocDialog();">
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
