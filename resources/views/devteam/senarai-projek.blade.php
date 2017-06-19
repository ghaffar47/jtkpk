@extends('master.app')
@section('title', 'Senarai Projek')
@section('site.description', 'Senarai Projek Kumpulan Development Team')
@section('app.helper', ",'summernote', 'ckeditor'")

@section('jquery')
$('#Projek').DataTable({ responsive: true });
@endsection

@section('content')
<!-- Page Header -->
<div class="content bg-image overflow-hidden" style="background-image: url('/assets/img/photos/photo12@2x.jpg');">
    <div class="push-100-t push-15">
        <h1 class="h2 font-w300 text-white animated fadeInUp">
            <i class="fa fa-list-ul push-15-r"></i> Senarai Projek
        </h1>
    </div>
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div class="content content-narrow">
    <div class="row">
        <div class="col-xs-12">
            <div id="_users" class="block block-themed block-rounded push-5">
                <div class="block-content block-content-full block-content-mini border-b bg-gray-lighter clearfix">
                    <a href="/dev-team" class="btn btn-primary" data-toggle="tooltip" title="Kembali">
                        <i class="fa fa-arrow-circle-left"></i>
                </a>
                <div class="pull-right">
                    <select name="_ppdsel" id="_ppdsel" data-placeholder="Sila pilih PPD" class="form-control js-select2" onchange="jump('parent',this,1)">
                        <option></option>
                        <option value="/dev-team">LIHAT SEMUA</option>
                        @foreach (App\PPD::all() as $_ppd)
                            <option value="/dev-team/{{ $_ppd->kod_ppd }}">{{ $_ppd->ppd }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                
                <div class="block-content">
                    <table id="Projek" class="table table-striped table-bordered responsive h6">
                        <thead>
                            <tr>
                                <th class="text-center">Bil</th>
                                <th class="text-center">Nama Projek</th>
                                <th class="text-center">Kumpulan DevTeam</th>
                                <th class="text-center">Peratus Siap</th>
                                <th class="text-center">Kertas Kerja</th>
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
                                    <span class="font-w400 h6 text-primary-dark">{{ $prj->nama_projek }}</span>
                                </td>
                                <td class="text-left h3 font-w300">
                                    <div class="font-w600 h6">{{ $prj->devteam->nama_kumpulan }}</div>
                                    <div class="font-w300 h6">PPD : <a href="/dev-team/{{ $prj->devteam->ppd->kod_ppd }}">{{ $prj->devteam->ppd->ppd }}</a></div>
                                </td>
                                <td class="text-center h5 font-w300">
                                    {{ $prj->peratus_siap }} %
                                </td>
                                <td class="text-center font-w300">
                                    @if (strlen($prj->kertas_kerja) != 0)
                                        <a href="/dev-team/kertas-kerja/{{ $prj->kertas_kerja }}" target="_blank"><i class="fa fa-file push-5-r"></i>{{ $prj->nama_kertas_kerja }}</a>
                                    @else
                                    - Tiada Kertas Kerja -
                                    @endif
                                </td>
                                <td class="text-center" width="150">
                                    <a href="#" class="btn btn-primary" data-toggle="tooltip" title="Lihat Detail Projek" onclick="javascript:ViewProjek('{{ $prj->id }}');return false;">
                                        <i class="fa fa-briefcase"></i>
                                    </a>
                                    <a href="/dev-team/projek/{{ $prj->id }}/tasks" class="btn btn-primary" data-toggle="tooltip" title="Lihat Detail Tugasan Projek">
                                        <i class="fa fa-th"></i>
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
