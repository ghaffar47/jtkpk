@extends('master.app')
@section('title', 'Senarai Task Projek')
@section('site.description', 'Senarai Task Projek')
@section('app.helper', ",'summernote', 'ckeditor'")

@section('jquery')
$('#Tasks').DataTable({ responsive: true });
setTimeout(function(){
    $('.progress-bar').each(function(){
        var value = $('#progress_' + $(this).attr('data-name')).val();
        $(this).css('width', value+'%');
        $(this).html(value + ' %');
    });
},1000);
@endsection

@section('content')
<!-- Page Header -->
<div class="content bg-image overflow-hidden" style="background-image: url('/assets/img/photos/photo12@2x.jpg');">
    <div class="push-100-t push-15">
        <h1 class="h2 font-w300 text-white animated fadeInUp">
            <i class="fa fa-th push-15-r"></i> Senarai Task Projek
        </h1>
    </div>
</div>
<!-- END Page Header -->

<!-- Menu -->
<div class="content padding-5-t bg-white border-b">
    <div class="push-15 push-10-t">
        <div class="row">
            <div class="col-xs-6">
                <a href="/dev-team/projek/{{ $devteam_id }}" class="btn btn-primary" data-toggle="tooltip" title="Kembali">
                    <i class="fa fa-arrow-circle-left"></i>
                </a>
            </div>
            <div class="col-xs-6 pull-right text-right">
                @if (Auth::user()->devteam == $devteam_id)
                    <button type="button" class="btn btn-success" onclick="javascript:AddTaskDialog();" data-toggle="tooltip" title="Tambah Task">
                        <i class="fa fa-plus push-5-r"></i>Tambah Task
                    </button>
                @endif
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
                <div class="block-content block-content-full border-b clearfix">
                    <div class="pull-left">
                        <h5>
                            <span class="font-w300">PROJEK : </span>
                        </h5>
                        <h3 class="font-w300">{{ $nama_projek }}</h3>
                    </div>
                    <div class="pull-right text-right">
                        <h5>
                            <span class="font-w300">Kumpulan : </span>
                            <b>{{ $nama_kumpulan }}</b>
                        </h5>
                        <h5>
                            <span class="font-w300">PPD : </span>
                            <b>{{ App\Projek::find($projek_id)->devteam->ppd->ppd }}</b>
                        </h5>
                    </div>
                </div>
                <div class="block-content">
                    <table id="Tasks" class="table table-striped table-bordered responsive h6">
                        <thead>
                            <tr>
                                <th class="text-center"><i class="fa fa-percent"></i></th>
                                <th class="text-center">Tajuk Task</th>
                                <th class="text-center">Ditugaskan Kepada</th>
                                <th class="text-center">Kemaskini Terakhir</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            <?php
                                if ($task->peratus_siap < 40) {
                                    $progress_stat = 'danger';
                                } else if ($task->peratus_siap >= 40 && $task->peratus_siap < 50) {
                                    $progress_stat = 'warning';
                                } else if ($task->peratus_siap >= 50 && $task->peratus_siap < 75) {
                                    $progress_stat = 'primary';
                                } else {
                                    $progress_stat = 'success';
                                }
                            ?>
                            <tr>
                                <td class="text-center h3 font-w300" width="80">{{ $task->peratus_siap }} %</td>
                                <td>
                                    <a href="/dev-team/projek/task/{{ $task->id }}">
                                        <span class="h5 text-primary">{{ $task->tajuk_task }}</span>
                                    </a>
                                    <div class="push-5-t">
                                        <div class="progress active remove-margin-b">
                                            <div data-name="{{ $task->id }}" class="progress-bar progress-bar-{{ $progress_stat }} progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                        <input type="hidden" id="progress_{{ $task->id }}" value="{{ $task->peratus_siap }}">
                                    </div>
                                </td>
                                <td class="text-left h6 font-w300">
                                    @if (strlen($task->assigned) != 0)
                                        @foreach (explode(',',$task->assigned) as $userid)
                                            <?php if (strlen($userid) == 0) { continue; } $_user = App\User::find($userid); ?>
                                            <div class="push-5">
                                                <img class="img-avatar img-avatar32 push-5-r" src="/avatar/{{ $userid }}" title="{{ $_user->name }}"> {{ $_user->name }}
                                            </div>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-left h6 font-w300" width="135">{{ $task->updated_at_formatted }}<br>(<i>{{ $task->nicetime_u }}</i>)</td>
                                <td class="text-center" width="150">
                                    <a href="/dev-team/projek/task/{{ $task->id }}" class="btn btn-primary" data-toggle="tooltip" title="Lihat Detail">
                                        <i class="fa fa-tags"></i>
                                    </a>
                                    @if (Auth::user()->devteam == $devteam_id)
                                        <button type="button" class="btn btn-primary" onclick="javascript:EditTask('{{ $task->id }}');" data-toggle="tooltip" title="Edit Task">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="javascript:PadamTask('{{ $task->id }}');" data-toggle="tooltip" title="Padam Task">
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

@if (Auth::user()->devteam == $devteam_id)
<!-- Task Dialog //-->
<div id="TaskDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popout">
        <div class="modal-content">
            <form method="post" class="form-horizontal" action="{{ url('/dev-team/projek/task') }}">
                {{ csrf_field() }}
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">
                            <i class="fa fa-user push-10-r"></i>Task Tugasan
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label class="col-sm-12 h5 font-w300 push-5">Tajuk Tugasan (Task) :</label>
                            <div class="col-sm-12">
                                <input type="text" id="_tajuk_task" name="_tajuk_task" class="form-control" maxlength="255" placeholder="Tajuk tugasan..." required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group push-5">
                                    <label class="col-sm-12 h5 font-w300 push-5">Ditugaskan Kepada :</label>
                                    <div class="col-sm-12">
                                        <select multiple id="_assigned" name="_assigned[]" data-placeholder="Siapa ?" class="form-control js-select2-avatar" style="width:100%;" required>
                                            @foreach (explode(',', trim($senarai_jtk,',')) as $jtk)
                                                <?php $_user = App\User::find($jtk); ?>
                                                <option value="{{ $_user->id }}">{{ $_user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group push-5">
                                    <label class="col-sm-12 h5 font-w300 push-5">Peratus Siap (%) :</label>
                                    <div class="col-sm-12">
                                        <input id="_peratus_siap" name="_peratus_siap" class="js-rangeslider" type="text" value="0" data-postfix=" %" data-grid="true" data-min="0" data-max="100" data-step="5">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 h5 font-w300 push-5">Detail Tugasan :</label>
                            <div class="col-sm-12">
                                <textarea id="_detail" name="_detail" class="form-control js-emojis" placeholder="Keterangan detail berkaitan dengan task tugasan..." rows="5" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_u_save" class="btn btn-primary" type="submit">
                        <i class="fa fa-save push-5-r"></i>Simpan Rekod
                    </button>
                    <button id="btn_u_cancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:ClearAddTask();">
                        <i class="fa fa-times push-5-r"></i>Batal
                    </button>                
                    <input id="_taskid" name="_taskid" type="hidden" value="0" />
                    <input id="_projekid" name="_projekid" type="hidden" value="{{ $projek_id }}" />
                </div>
            </form>
        </div>
    </div>
</div>
@endif
<!-- END Page Content -->
@endsection
