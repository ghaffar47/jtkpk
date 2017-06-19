@extends('master.app')
@section('title', 'Senarai Pengguna')
@section('site.description', 'Senarai Pengguna Sistem')

@section('jquery')
$('#Users').DataTable({ responsive: true });
@endsection

@section('content')
<!-- Page Header -->
<div class="content bg-image overflow-hidden" style="background-image: url('/assets/img/photos/photo12@2x.jpg');">
    <div class="push-100-t push-15">
        <h1 class="h2 font-w300 text-white animated fadeInUp">
            <i class="fa fa-users push-15-r"></i> Senarai Pengguna
        </h1>
    </div>
</div>
<!-- END Page Header -->

<!-- Menu -->
<div class="content padding-5-t bg-white border-b">
    <div class="push-15 push-10-t">
        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-primary" onclick="javascript:AddUserDialog();" data-toggle="tooltip" title="Tambah Pengguna">
                    <i class="fa fa-plus push-5-r"></i><i class="fa fa-user"></i>
                </button>
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
            <div id="_users" class="block block-themed block-rounded push-5">
                <div class="block-content">
                    <table id="Users" class="table table-striped table-bordered responsive h6">
                        <thead>
                            <tr>
                                <th class="text-center">Bil</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">E-mel</th>
                                <th class="text-center">Peranan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($users as $user)
                            <?php $i++; ?>
                            <tr>
                                <td class="text-center">{{ $i }}.</td>
                                <td>
                                    <a href="#" onclick="javascript:EditUser('{{ $user->id }}');return false;">
                                        <div class="font-w300 h5 text-primary">
                                            <img class="img-avatar img-avatar32 push-5-r" src="/avatar/{{ $user->id }}" title="{{ $user->name }}">
                                            {{ $user->name }}
                                        </div>
                                    </a>
                                </td>
                                <td class="text-left">
                                    <i class="fa fa-envelope push-5-r"></i>{{ $user->email }}
                                </td>
                                <td class="text-left">
                                    @if ($user->roles()->count() > 0)
                                        @foreach ($user->roles()->get() as $role)
                                            <span class="badge badge-primary">
                                                <i class="fa fa-user"></i> {{ $role->role_name }}
                                            </span>
                                        @endforeach
                                    @else
                                    -
                                    @endif
                                </td>
                                <td class="text-center" width="150">
                                    <button class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit Pengguna" onclick="javascript:EditUser('{{ $user->id }}');return false;">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <a href="{{ url('/admin/users/'.$user->id.'/delete') }}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Padam Pengguna">
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

<!-- User Dialog //-->
<div id="UserDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popout">
        <div class="modal-content">
            <form method="post" class="form-horizontal" action="{{ url('/admin/users') }}">
                {{ csrf_field() }}
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">
                            <i class="fa fa-user push-10-r"></i>Pengguna
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group items-push border-b">
                            <label class="col-sm-4 control-label">Nama Penuh :</label>
                            <div class="col-sm-8">
                                <input type="text" id="_name" name="_name" class="form-control" maxlength="255" placeholder="Nama Penuh" required>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-4 control-label">Alamat E-mel :</label>
                            <div class="col-sm-8">
                                <input type="email" id="_email" name="_email" class="form-control" maxlength="255" placeholder="Alamat E-mel" required>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-4 control-label">Kata Laluan :</label>
                            <div class="col-sm-8">
                                <input type="password" id="_pwd" name="_pwd" class="form-control" maxlength="255" placeholder="Kata Laluan" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-4 control-label">Kumpulan Pengguna :</label>
                            <div class="col-sm-8">
                                <select multiple id="_usergroups" name="_usergroups[]" data-placeholder="Kumpulan Pengguna" class="form-control js-select2" style="width:100%;">
                                    @foreach (App\Roles::all() as $role)
                                        <option value="{{ $role->role }}">{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-4 control-label">Gred Jabatan :</label>
                            <div class="col-sm-8">
                                <select id="_gred" name="_gred" data-placeholder="Gred" class="form-control js-select2" style="width:100%;">
                                    <option></option>
                                    @foreach (App\Gred::all() as $gred)
                                        <option value="{{ $gred->id }}">{{ $gred->gred_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-4 control-label">Jabatan (JPN) :</label>
                            <div class="col-sm-8">
                                <select id="_kodjpn" name="_kodjpn" data-placeholder="JPN" class="form-control js-select2" style="width:100%;">
                                    <option></option>
                                    @foreach (App\JPN::all() as $jpn)
                                        <option value="{{ $jpn->kod_jpn }}">{{ $jpn->jpn }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-4 control-label">Jabatan (PPD) :</label>
                            <div class="col-sm-8">
                                <select id="_kodppd" name="_kodppd" data-placeholder="PPD" class="form-control js-select2" style="width:100%;">
                                    <option></option>
                                    @foreach (App\PPD::all() as $ppd)
                                        <option value="{{ $ppd->kod_ppd }}">{{ $ppd->ppd }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-4 control-label">Jabatan (Sekolah) :</label>
                            <div class="col-sm-8">
                                <select id="_kodsek" name="_kodsek" data-placeholder="Sekolah" class="form-control js-select2" style="width:100%;">
                                    <option></option>
                                    @foreach (App\Sekolah::all() as $sek)
                                        <option value="{{ $sek->kod_sekolah }}">{{ $sek->kod_sekolah }} - {{ $sek->nama_sekolah }}</option>
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
                    <button id="btn_u_cancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:ClearAddUser();">
                        <i class="fa fa-times push-5-r"></i>Batal
                    </button>                
                    <input id="_uid" name="_uid" type="hidden" value="0" />
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
