@extends('master.app')
@section('title', 'Detail Task')
@section('site.description', 'Detail Task Projek')
@section('app.helper', ",'summernote', 'ckeditor'")

@section('jquery')
setTimeout(function(){
    $('.progress-bar').each(function(){
        var value = $('#progress_' + $(this).attr('data-name')).val();
        $(this).css('width', value+'%');
        $(this).html(value + ' %');
    });
    $('#_peratus_siap').data('ionRangeSlider').update({ from: {{ $task->peratus_siap }}});
},1000);
@endsection

@section('content')
<!-- Page Header -->
<div class="content bg-image overflow-hidden" style="background-image: url('/assets/img/photos/photo12@2x.jpg');">
    <div class="push-100-t push-15">
        <h1 class="h2 font-w300 text-white animated fadeInUp">
            <i class="fa fa-tags push-15-r"></i> <span class="font-w300">Detail Tugasan :</span> {{ $task->tajuk_task }}
        </h1>
    </div>
</div>
<!-- END Page Header -->

<!-- Menu -->
<div class="content padding-5-t bg-white border-b">
    <div class="push-15 push-10-t">
        <div class="row">
            <div class="col-xs-6">
                <a href="/dev-team/projek/{{ $task->projek_id }}/tasks" class="btn btn-primary" data-toggle="tooltip" title="Kembali">
                    <i class="fa fa-arrow-circle-left"></i>
                </a>
            </div>
            <div class="col-xs-6 pull-right text-right">
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
                    <div class="row">
                        <div class="col-md-8 text-left">
                            <h5>
                                <span class="font-w300">TASK TUGASAN : </span>
                            </h5>
                            <h3 class="font-w300">{{ $task->tajuk_task }}</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <h5>
                                <span class="font-w300">PERATUS SIAP (%) : </span>
                            </h5>
                            <div class="push-5-t">
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
                                <div class="progress active remove-margin-b">
                                    <div data-name="{{ $task->id }}" class="progress-bar progress-bar-{{ $progress_stat }} progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                </div>
                                <input type="hidden" id="progress_{{ $task->id }}" value="{{ $task->peratus_siap }}">
                            </div>
                        </div>
                    </div>
                    <h5 class="font-w300 push-10-t panel panel-primary padding-10-all remove-margin-b">
                        <span class="font-w400">Detail Tugasan :</span><br>
                        <?php $detail = \Emojione\Emojione::toImage($task->detail_task); echo nl2br($detail); ?>
                    </h5>
                </div>
                <div class="block-content">
                    <!-- Projek Timeline -->
                    @if ($task->timeline->count() == 0)
                        <center>
                            <h1><i class="fa fa-question fa-3x"></i></h1>
                            <p>- Tiada Rekod -</p>
                        </center>
                    @else
                        <ul class="list list-timeline pull-t">
                            @foreach ($task->timeline as $timeline)
                                <li>
                                    <div class="list-timeline-time">{{ $timeline->date }}</div>
                                    <i class="fa fa-tasks list-timeline-icon {{ $timeline->progress_type }}"></i>
                                    <div class="list-timeline-content">
                                        <div class="font-w300 h6">
                                            <?php $_user = App\User::find($timeline->timeline_by); ?>
                                            <img class="img-avatar img-avatar20 push-5-r" src="/avatar/{{ $timeline->timeline_by }}" title="{{ $_user->name }}"> {{ $_user->name }}
                                        </div>
                                        <div class="push-10 font-w300 h6">
                                            {{ $timeline->updated_at_formatted }} (<i>{{ $timeline->nicetime_u }}</i>) 
                                            
                                            @if (Auth::user()->id == $timeline->timeline_by)
                                                [ <a href="#" class="text-danger font-w400" onclick="javascript:PadamTaskDetail('{{ $timeline->id }}');return false;">Padam</a> ]
                                            @endif
                                        </div>
                                        <p class="font-w300">
                                            <?php $tldetail = \Emojione\Emojione::toImage($timeline->detail); echo nl2br($tldetail); ?>
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                @if (Auth::user()->devteam == $devteam_id)
                <div class="block-content block-content-full border-t">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="push-10">
                                <label for="_peratus_siap" class="h5 font-w400 push-5">Set Peratus Siap kepada : </label>
                                <input id="_peratus_siap" name="_peratus_siap" class="js-rangeslider" type="text" value="0" data-postfix=" %" data-grid="true" data-min="0" data-max="100" data-step="5">
                            </div>
                            <div>
                                <p class="h5 font-w400 remove-margin-b">Set Warna :</p>
                                <label class="css-input css-radio css-radio-primary push-10-r">
                                    <input type="radio" id="_r_primary" name="_progress_type" value="bg-primary" checked><span></span>
                                </label>
                                <label class="css-input css-radio css-radio-warning push-10-r">
                                    <input type="radio" id="_r_warning" name="_progress_type" value="bg-warning"><span></span>
                                </label>
                                <label class="css-input css-radio css-radio-danger push-10-r">
                                    <input type="radio" id="_r_danger" name="_progress_type" value="bg-danger"><span></span>
                                </label>
                                <label class="css-input css-radio css-radio-success push-10-r">
                                    <input type="radio" id="_r_success" name="_progress_type" value="bg-success"><span></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-8 text-right">
                            <textarea id="_timeline" class="form-control js-emojis push-10" rows="4"></textarea>
                            <button id="btn-save-timeline" type="button" class="btn btn-primary" onclick="javascript:SaveTimeline();">
                                <i class="fa fa-send push-5-r"></i> Kemaskini Tugasan
                            </button>
                            <input type="hidden" id="_task_id" name="_task_id" value="{{ $task->id }}">
                            <input type="hidden" id="_timeline_by" name="_timeline_by" value="{{ Auth::user()->id }}">
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection
