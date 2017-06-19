@inject('jtkc', '\App\Http\Controllers\JTKController')

@extends('master.app')
@section('title', 'Log Tugasan & Senarai Semak Harian')
@section('site.description', 'Log Tugasan & Senarai Semak Harian')

@section('jquery')
    @if (Auth::user()->hasRole('ppd'))

    @else
        @if ($error == 'already_exists')
            SweetAlert('error','Ops !',"Rekod telah wujud dalam pangkalan data!");
        @endif

        jQuery('.js-calendar').fullCalendar({
            firstDay: 1,
            editable: false,
            droppable: false,
            header: {
                left: 'title',
                right: 'today,prev,next'
            },
            eventRender: function(event, element, view) {
                element.attr('title', event.tooltip);
                if (view.name == 'month') {
                    $(element).height(25);
                }
                element.find(".fc-content").addClass("text-center push-5-t");
                if (event.icon) {
                    element.find(".fc-title").prepend("&nbsp;<i class='text-success fa fa-"+event.icon+"'></i> ");
                }
                if (event.semakan_ppd) {
                    element.find(".fc-title").append("&nbsp;<i class='fa fa-"+event.semakan_ppd+"'></i> ");
                }
            },
            events:
            [
                @foreach (\App\TugasanHarian::where('user_id',Auth::user()->id)->get() as $th)
                <?php
                    $event = array();
                    $tarikh = $th->tarikh_semakan;
                    $id = $th->id;

                    $dt = explode('-', $tarikh);
                    $Year = $dt[0];
                    $Mon = $dt[1]-1;
                    $Day = $dt[2];

                    if ($th->ppd_semak == '1') {
                        $_ppdsemak = 'check-circle fa-2x text-success';
                    } else {
                        $_ppdsemak = 'exclamation-circle fa-2x text-warning';
                    }

                    $event[] = "{
                        color: '#FFF',
                        icon: 'check-square fa-2x',
                        semakan_ppd: '$_ppdsemak',
                        start: new Date($Year, $Mon, $Day, 0, 0),
                        allDay: true,
                        id: '$id',
                        tooltip: 'Klik untuk lihat rekod'
                    },";
                    $events = implode(',', $event);
                    echo $events;
                ?>
                @endforeach

                @foreach (\App\AktivitiAdhoc::where('jtk_terlibat','LIKE','%,'.Auth::user()->id.',%')->get() as $ev)
                <?php
                    $event_xtvt = array();
                    $evid = $ev->id;
                    $ev_title = $ev->nama_aktiviti;
                    $tarikh_dari = $ev->tarikh_dari;
                    $tarikh_hingga = $ev->tarikh_hingga;

                    $evsdt = explode('-', $tarikh_dari);
                    $evsYear = $evsdt[0];
                    $evsMon = $evsdt[1]-1;
                    $evsDay = $evsdt[2];

                    $evedt = explode('-', $tarikh_hingga);
                    $eveYear = $evedt[0];
                    $eveMon = $evedt[1]-1;
                    $eveDay = $evedt[2]+1;

                    $event_xtvt[] = "{
                        title: '$ev_title',
                        start: new Date($evsYear, $evsMon, $evsDay, 0, 0),
                        end: new Date($eveYear, $eveMon, $eveDay, 0, 0),
                        allDay: true,
                        xtvt_adhoc_id: '$evid',
                        tooltip: '$ev_title'
                    },";
                    $events_xtvt = implode(',', $event_xtvt);
                    echo $events_xtvt;
                ?>
                @endforeach
            ],
            eventClick: function(calEvent, jsEvent, view) {
                if (calEvent.xtvt_adhoc_id) {
                    window.location.href = '/smart-team/aktiviti-adhoc-detail/' + calEvent.xtvt_adhoc_id;
                } else {
                    EditTugasanHarian(calEvent.id);
                }
            }
        });
    @endif
@endsection

@section('content')

@if (!Auth::user()->hasRole('ppd'))
<script type="text/javascript">
function ClearSemakan() {
    $('#_speedtest_a').val('');
    $('#_speedtest_b').val('');
    $('#_speedtest_c').val('');
    $('#_speedtest_d').val('');
    $('#_speedtest_e').val('');
    $('#_speedtest_f').val('');
    $('#_speedtest_a1').val('');
    $('#_speedtest_b1').val('');
    $('#_speedtest_c1').val('');
    $('#_speedtest_d1').val('');
    $('#_speedtest_e1').val('');
    $('#_speedtest_f1').val('');

    $('#_ptg_speedtest_a').val('');
    $('#_ptg_speedtest_b').val('');
    $('#_ptg_speedtest_c').val('');
    $('#_ptg_speedtest_d').val('');
    $('#_ptg_speedtest_e').val('');
    $('#_ptg_speedtest_f').val('');
    $('#_ptg_speedtest_a1').val('');
    $('#_ptg_speedtest_b1').val('');
    $('#_ptg_speedtest_c1').val('');
    $('#_ptg_speedtest_d1').val('');
    $('#_ptg_speedtest_e1').val('');
    $('#_ptg_speedtest_f1').val('');

    @foreach ($ss_semua as $ss_h)
        $('#_catatan_{{ $ss_h->id }}').val('');
        $('input[name="_status_{{ $ss_h->id }}"]').filter(':checked').each(function(){
            $(this).prop('checked', false);
        });
    @endforeach
    @foreach ($ss_user as $ss_hu)
        $('#_catatan_{{ $ss_hu->id }}').val('');
        $('input[name="_status_{{ $ss_hu->id }}"]').filter(':checked').each(function(){
            $(this).prop('checked', false);
        });
    @endforeach
    $('#_id_th').val('0');
    $('#_masa_semakan').val('');
    $('#btn_u_print').addClass('hide');
    $('#btn_u_mel').addClass('hide');
    $('#_tarikh_semakan').removeAttr('disabled');
    $('#_semakan_ppd').removeClass('block-content block-content-full block-content-mini text-white bg-success bg-warning');
    $('#_semakan_ppd').html('');
    $('#_tugasan_harian').val('');
}
</script>
@endif

<!-- Page Header -->
<div class="content bg-image overflow-hidden" style="background-image: url('/assets/img/photos/photo12@2x.jpg');">
    <div class="push-100-t push-15">
        <h1 class="h2 font-w300 text-white animated fadeInUp">
            <i class="fa fa-book push-15-r"></i> Log Tugasan & Senarai Semak Harian
        </h1>
    </div>
</div>
<!-- END Page Header -->

<!-- Menu -->
<div class="content padding-5-t bg-white border-b">
    <div class="push-15 push-10-t">
        <div class="row">
            @if (Auth::user()->hasRole('ppd'))
                <div class="col-md-7">
                    <div class="btn-group">
                        <div class="btn-group">
                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bar-chart push-5-r"></i> Laporan <span class="caret push-5-l"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a tabindex="-1" href="#" onclick="javascript:LIDialog();return false;">
                                        <i class="fa fa-bar-chart push-5-r"></i>Laporan Bulanan Log Tugasan
                                    </a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="#" onclick="javascript:LSpeedtestDialog();return false;">
                                        <i class="si si-speedometer push-5-r"></i>Laporan Bulanan Speedtest
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 pull-right">
                    <div class="row">
                        <div class="col-xs-6">
                            <select name="qmonth" id="qmonth" data-placeholder="Bulan" class="form-control js-select2">
                                <option></option>
                                <?php
                                    $bulan = array('Januari','Februari','Mac','April','Mei','Jun','Julai','Ogos','September','Oktober','November','Disember');
                                    for ($i = 0; $i < 12; $i++) { 
                                ?>
                                @if (str_pad($i+1,2,'0',STR_PAD_LEFT) == date('m'))
                                    <option value="{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}" selected>{{ $bulan[$i] }}</option>
                                @else
                                    <option value="{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}">{{ $bulan[$i] }}</option>
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
                                @if ($i == date('Y'))
                                    <option value="{{ $i }}" selected>{{ $i }}</option>
                                @else
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endif

                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <button type="button" class="btn btn-primary" onclick="javascript:ViewTH($('#qmonth').val(),$('#qyear').val());">
                                <i class="fa fa-eye push-5-r"></i>Lihat
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-xs-6">
                    <div class="btn-group">
                        <div class="btn-group">
                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bar-chart push-5-r"></i> Laporan <span class="caret push-5-l"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a tabindex="-1" href="#" onclick="javascript:LIDialog();return false;">
                                        <i class="fa fa-bar-chart push-5-r"></i>Laporan Bulanan Log Tugasan
                                    </a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="#" onclick="javascript:LSpeedtestDialog();return false;">
                                        <i class="si si-speedometer push-5-r"></i>Laporan Bulanan Speedtest
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 text-right pull-right">
                    <a class="btn btn-primary" href="{{ url('/senarai-tugas-khas') }}">
                        <i class="fa fa-briefcase"></i><span class="push-5-l hidden-xs hidden-sm">Senarai Tugas Khas</span>
                    </a>
                    <a class="btn btn-primary" href="{{ url('/senarai-semak-harian') }}">
                        <i class="fa fa-list-ul"></i><span class="push-5-l hidden-xs hidden-sm">Senarai Semak Harian</span>
                    </a>
                    <button type="button" class="btn btn-success" onclick="javascript:Semakan();">
                        <i class="fa fa-check-square-o"></i><span class="push-5-l hidden-xs hidden-sm">Tugasan Harian</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- END Menu -->


<!-- Page Content -->
<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="block block-themed block-rounded">

                <div class="row">
                    <?php
                        $jumjtk = \App\User::where('kod_ppd',Auth::user()->kod_ppd)->where('kod_jabatan','<>','')->count();
                        $thhi = \App\TugasanHarian::where('tarikh_semakan',date('Y-m-d'))->orderBy('id','asc')->get();
                    ?>
                    <div class="col-md-8">
                        <div class="block-content block-content-full block-content-mini border-b bg-primary-lighter">
                            Log Tugasan Hari Ini - <b>{{ date('d/m/Y') }}</b> 
                            (Buat: <span class="text-success"><b>{{ count($thhi) }}</b> orang</span> &nbsp;  
                            Tak Buat: <span class="text-danger"><b>{{ ($jumjtk-count($thhi)) }}</b> orang</span> )
                        </div>
                        <div class="block-content block-content-full">
                        
                        @if (count($thhi) > 0)
                            @foreach ($thhi as $_thhi)
                                <img src="/avatar/{{ $_thhi->user_id }}" class="push-5 img-avatar img-avatar48 ok" data-toggle="tooltip" title="{{ $_thhi->user->name }}">
                            @endforeach
                        @else
                            -
                        @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="block-content block-content-full block-content-mini border-b bg-primary-lighter">
                            @if (strlen($mon) != 0 && strlen($year) != 0)
                                Peratus Log Tugasan Dibuat - <b><?php echo $jtkc->replaceMonth($mon); ?>, {{ $year }}</b>
                            @else
                                Peratus Log Tugasan Dibuat - <b>{{ $jtkc->replaceMonth(date('n')) }}, {{ date('Y') }}</b>
                            @endif
                        </div>
                        <div class="block-content block-content-full font-s36 font-w300 text-center">
                            <?php
                                if (strlen($mon) != 0 && strlen($year) != 0) {
                                    if (Auth::user()->hasRole('ppd')) {
                                        $total = ($jumjtk * $jtkc->countDays($year,$mon,array(0,6)));
                                        $jumbuat = \App\TugasanHarian::whereMonth('tarikh_semakan',$mon)->whereYear('tarikh_semakan',$year)->count();
                                    } else {
                                        $total = $jtkc->countDays($year,$mon,array(0,6));
                                        $jumbuat = \App\TugasanHarian::whereMonth('tarikh_semakan',$mon)->whereYear('tarikh_semakan',$year)->where('user_id',Auth::user()->id)->count();
                                    }
                                } else {
                                    if (Auth::user()->hasRole('ppd')) {
                                        $total = ($jumjtk * $jtkc->countDays(date('Y'),date('m'),array(0,6)));
                                        $jumbuat = \App\TugasanHarian::whereMonth('tarikh_semakan',date('m'))->whereYear('tarikh_semakan',date('Y'))->count();
                                    } else {
                                        $total = $jtkc->countDays(date('Y'),date('m'),array(0,6));
                                        $jumbuat = \App\TugasanHarian::whereMonth('tarikh_semakan',date('m'))->whereYear('tarikh_semakan',date('Y'))->where('user_id',Auth::user()->id)->count();
                                    }
                                }
                                $peratus = (($jumbuat/$total) * 100);
                                echo number_format($peratus,2,".",",")." %";
                            ?>
                        </div>
                    </div>
                </div>
                

                <div class="block-content block-content-full block-content-mini bg-gray-lighter"></div>

                <div class="block-content block-content-full">
                    @if (Auth::user()->hasRole('ppd'))
                        <div class="row items-push border-b push">
                            <div class="col-xs-12 h5 font-w300 text-right">
                                <span class="push-10-r"><img src="{{ asset('/img/default_avatar.jpg') }}" class="img-avatar img-avatar32 ko push-5-r"> Tiada Tugasan Harian Dibuat</span>
                                <span class="push-10-r"><img src="{{ asset('/img/default_avatar.jpg') }}" class="img-avatar img-avatar32 warning push-5-r"> Perlu Semakan</span>
                                <span><img src="{{ asset('/img/default_avatar.jpg') }}" class="img-avatar img-avatar32 ok push-5-r"> Telah Disemak Oleh PPD</span>
                            </div>
                        </div>
                        
                        @if (strlen($mon) != 0 && strlen($year) != 0)
                            <?php
                                $TotalDay = cal_days_in_month(CAL_GREGORIAN, $mon, $year);
                                $rowday = '';
                                for ($k=1; $k <= $TotalDay; $k++)
                                {
                                    $listjtk = '';
                                    foreach (\App\User::where('kod_ppd',Auth::user()->kod_ppd)->where('kod_jabatan','<>','')->orderBy('name','asc')->get() as $jtk)
                                    {
                                        $date = "$year-$mon-".str_pad($k,2,'0',STR_PAD_LEFT);
                                        $_ssh = $jtk->TugasanHarian->where('tarikh_semakan',$date)->first();
                                        
                                        if (count($_ssh) == 1)
                                        {
                                            if ($_ssh->ppd_semak == '0') {
                                                $status = "warning";
                                                $status_semakan = "(Perlu Semakan)";
                                            } else {
                                                $status = "ok";
                                                $status_semakan = "(OK)";
                                            }

                                            $listjtk .= '<a href="#" onclick="javascript:Cetak_TH(\''.$_ssh->id.'\');return false;">
                                                <img src="/avatar/'.$jtk->id.'" class="push-5 img-avatar img-avatar32 '.$status.'" data-toggle="tooltip" title="'.$jtk->name.' '.$status_semakan.'">
                                            </a> ';
                                        }
                                        else
                                        {
                                            $status = "ko";
                                            $status_semakan = "(Tiada Semakan)";
                                            $listjtk .= '<img src="/avatar/'.$jtk->id.'" class="push-5 img-avatar img-avatar32 '.$status.'" data-toggle="tooltip" title="'.$jtk->name.' '.$status_semakan.'"> ';
                                        }
                                    }

                                    $mon = str_pad($mon,2,'0',STR_PAD_LEFT);
                                    $_k = $k;
                                    $k = str_pad($k,2,'0',STR_PAD_LEFT);

                                    if ($k == date('d') && $mon == date('m')) {
                                        $tr_bgcolor = "bg-success-light";
                                    } else {
                                        if (strtolower(date('D',strtotime("$year-$mon-$_k"))) == 'sun' || strtolower(date('D',strtotime("$year-$mon-$_k"))) == 'sat') {
                                            $tr_bgcolor = "bg-danger-light";
                                        } else {
                                            $tr_bgcolor = "bg-white";
                                        }
                                    }

                                    $hari = strtolower($jtkc->replaceDay(date('l',strtotime("$year-$mon-$_k"))));
                                    if ($hari != 'sabtu' && $hari != 'ahad')
                                    {
                                        $rowday .= '<tr class="'.$tr_bgcolor.'">
                                        <td class="text-center">'.$k.'/'.$mon.'/'.$year.' ('.ucwords($hari).')</td>
                                        <td class="border-l">'.$listjtk.'</td>
                                        </tr>';
                                    }
                                }
                            ?>
                            <div class="row">
                                <div class="col-md-6"><h2 class="text-left">{{ $bulan[ltrim($mon,'0')-1] }}, {{ $year }}</h2></div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn btn-success" onclick="javascript:PPDSemakTH('{{ $mon }}-{{ $year }}');">
                                        <i class="fa fa-check push-5-r"></i>Semak Untuk Bulan Ini ({{ $bulan[ltrim($mon,'0')-1] }})
                                    </button>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">Tarikh</th>
                                        <th>Semakan Harian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo $rowday; ?>
                                </tbody>
                            </table> 
                        @else
                            <div class="row">
                                <div class="col-md-6"><h2 class="text-left">{{ $bulan[date('m')-1] }}, {{ date('Y') }}</h2></div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn btn-success" onclick="javascript:PPDSemakTH('{{ date('m') }}-{{ date('Y') }}');">
                                        <i class="fa fa-check push-5-r"></i>Semak Untuk Bulan Ini ({{ $bulan[date('m')-1] }})
                                    </button>
                                </div>
                            </div>
                            <?php
                                $TotalDay = cal_days_in_month(CAL_GREGORIAN, date('n'), date('Y'));
                                $rowday = '';
                                for ($k=1; $k <= $TotalDay; $k++)
                                {
                                    $listjtk = '';
                                    foreach (\App\User::where('kod_ppd',Auth::user()->kod_ppd)->where('kod_jabatan','<>','')->orderBy('name','asc')->get() as $jtk)
                                    {
                                        $date = date('Y')."-".date('m')."-".str_pad($k,2,'0',STR_PAD_LEFT);
                                        $_ssh = $jtk->TugasanHarian->where('tarikh_semakan',$date)->first();
                                        
                                        if (count($_ssh) == 1)
                                        {
                                            if ($_ssh->ppd_semak == '0') {
                                                $status = "warning";
                                                $status_semakan = "(Perlu Semakan)";
                                            } else {
                                                $status = "ok";
                                                $status_semakan = "(OK)";
                                            }

                                            $listjtk .= '<a href="#" onclick="javascript:Cetak_TH(\''.$_ssh->id.'\');return false;">
                                                <img src="/avatar/'.$jtk->id.'" class="push-5 img-avatar img-avatar32 '.$status.'" data-toggle="tooltip" title="'.$jtk->name.' '.$status_semakan.'">
                                            </a> ';
                                        }
                                        else
                                        {
                                            $status = "ko";
                                            $status_semakan = "(Tiada Semakan)";
                                            $listjtk .= '<img src="/avatar/'.$jtk->id.'" class="push-5 img-avatar img-avatar32 '.$status.'" data-toggle="tooltip" title="'.$jtk->name.' '.$status_semakan.'"> ';
                                        }
                                    }

                                    $i = str_pad($i,2,'0',STR_PAD_LEFT);
                                    $_k = $k;
                                    $k = str_pad($k,2,'0',STR_PAD_LEFT);

                                    if ($k == date('d')) {
                                        $tr_bgcolor = "bg-success-light";
                                    } else {
                                        if (strtolower(date('D',strtotime(date('Y')."-".date('n')."-$_k"))) == 'sun' || strtolower(date('D',strtotime(date('Y')."-".date('n')."-$_k"))) == 'sat') {
                                            $tr_bgcolor = "bg-danger-light";
                                        } else {
                                            $tr_bgcolor = "bg-white";
                                        }
                                    }

                                    $hari = strtolower($jtkc->replaceDay(date('l',strtotime(date('Y')."-".date('m')."-".$_k))));
                                    if ($hari != 'sabtu' && $hari != 'ahad')
                                    {
                                        $rowday .= '<tr class="'.$tr_bgcolor.'">                                        
                                        <td class="text-center">'.$k.'/'.date('m').'/'.date('Y').' ('.ucwords($hari).')</td>
                                        <td class="border-l">'.$listjtk.'</td>
                                        </tr>';
                                    }
                                }
                            ?>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">Tarikh</th>
                                        <th>Semakan Harian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo $rowday; ?>
                                </tbody>
                            </table>                            
                        @endif
                    @else
                        <div class="row items-push">
                            <div class="col-xs-12 h5 font-w300">
                                <span class="push-10-r"><i class="fa fa-check-square text-success push-5-r"></i> Semakan Harian Telah Dibuat</span>
                                <span class="push-10-r"><i class="fa fa-exclamation-circle text-warning push-5-r"></i> PPD Belum Membuat Semakan</span>
                                <span><i class="fa fa-check-circle text-success push-5-r"></i> Telah Disemak Oleh PPD</span>
                            </div>
                        </div>
                        <div class="js-calendar"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->

@if (!Auth::user()->hasRole('ppd'))
<!-- Tugasan Harian Dialog //-->
<div id="SemakanDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popout">
        <div class="modal-content">
            <form method="post" class="form-horizontal" action="{{ url('/save-tugasan-harian') }}">
                {{ csrf_field() }}
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">
                            <i class="fa fa-list-ul push-10-r"></i>Log Tugasan & Senarai Semak Harian
                        </h3>
                    </div>
                    <div id="_semakan_ppd" class="h5 font-w300"></div>
                    <div class="block-content block-content-mini">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="text-right" style="width: 80%;">Tarikh Semakan:</td>
                                    <td class="text-center" style="width: 20%;">
                                        <input class="js-datepicker form-control" type="text" id="_tarikh_semakan" name="_tarikh_semakan" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ date('d/m/Y') }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" style="width: 80%;">Waktu Semakan (24-Jam):</td>
                                    <td class="text-center" style="width: 20%;">
                                        <input class="js-masked-time form-control" type="text" id="_masa_semakan" name="_masa_semakan" placeholder="00:00" value="08:30">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td colspan="4" class="bg-primary-lighter h4 font-w700">SENARAI SEMAK HARIAN</td>
                                </tr>
                                <tr>
                                    <th class="text-center" style="width: 50px;">#</th>
                                    <th>Perkara</th>
                                    <th>Status Semakan</th>
                                    <th>Catatan</th>
                                </tr>
                                <?php $i=1; ?>
                                @foreach ($ss_semua as $ss)
                                <?php
                                    $cara_pengujian = str_replace('#KOD_SEKOLAH#', Auth::user()->kod_jabatan, $ss->cara_pengujian);
                                    $cara_pengujian = str_replace('#WEB_PPD#', Auth::user()->web_ppd, $cara_pengujian);
                                ?>

                                @if ($ss->id == 1)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td colspan="2">
                                        <div class="push-5">{{ $ss->perkara }}</div>
                                        <div class="h6">
                                            <div class="font-w700"><u>Cara Pengujian</u></div>
                                            {{ $cara_pengujian }}
                                        </div>
                                    </td>
                                    <td width="200">
                                        <textarea id="_catatan_{{ $ss->id }}" name="_catatan_{{ $ss->id }}" class="form-control input-sm"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">&nbsp;</td>
                                    <td colspan="3">
                                        <table cellpadding="3" cellspacing="0" class="table table-bordered">
                                            <tr>
                                                <td width="200" class="text-center bg-success-light">PAGI (<i>Mbps</i>)</td>
                                                <td width="200" class="text-center bg-primary-light">PETANG (<i>Mbps</i>)</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" class="text-left">
                                                    <div class="row items-push">
                                                        <div class="col-xs-12 push-5"><b>DIRECT FEED</b></div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                                                <input type="text" id="_speedtest_f" name="_speedtest_f" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Download">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                                                                <input type="text" id="_speedtest_f1" name="_speedtest_f1" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Upload">
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12 push-5"><b>ZOOM-A</b></div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                                                <input type="text" id="_speedtest_a" name="_speedtest_a" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Download">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                                                                <input type="text" id="_speedtest_a1" name="_speedtest_a1" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Upload">
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12 push-5"><b>ZOOM-B</b></div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                                                <input type="text" id="_speedtest_b" name="_speedtest_b" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Download">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                                                                <input type="text" id="_speedtest_b1" name="_speedtest_b1" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Upload">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-xs-12 push-5"><b>ZOOM-C</b></div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                                                <input type="text" id="_speedtest_c" name="_speedtest_c" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Download">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                                                                <input type="text" id="_speedtest_c1" name="_speedtest_c1" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Upload">
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12 push-5"><b>SUPER ZOOM (A)</b></div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                                                <input type="text" id="_speedtest_d" name="_speedtest_d" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Download">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                                                                <input type="text" id="_speedtest_d1" name="_speedtest_d1" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Upload">
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12 push-5"><b>SUPER ZOOM (B)</b></div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                                                <input type="text" id="_speedtest_e" name="_speedtest_e" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Download">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                                                                <input type="text" id="_speedtest_e1" name="_speedtest_e1" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Upload">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td valign="top" class="text-left">
                                                    <div class="row items-push">
                                                        <div class="col-xs-12 push-5"><b>DIRECT FEED</b></div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                                                <input type="text" id="_ptg_speedtest_f" name="_ptg_speedtest_f" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Download">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                                                                <input type="text" id="_ptg_speedtest_f1" name="_ptg_speedtest_f1" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Upload">
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12 push-5"><b>ZOOM-A</b></div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                                                <input type="text" id="_ptg_speedtest_a" name="_ptg_speedtest_a" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Download">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                                                                <input type="text" id="_ptg_speedtest_a1" name="_ptg_speedtest_a1" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Upload">
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12 push-5"><b>ZOOM-B</b></div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                                                <input type="text" id="_ptg_speedtest_b" name="_ptg_speedtest_b" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Download">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                                                                <input type="text" id="_ptg_speedtest_b1" name="_ptg_speedtest_b1" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Upload">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-xs-12 push-5"><b>ZOOM-C</b></div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                                                <input type="text" id="_ptg_speedtest_c" name="_ptg_speedtest_c" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Download">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                                                                <input type="text" id="_ptg_speedtest_c1" name="_ptg_speedtest_c1" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Upload">
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12 push-5"><b>SUPER ZOOM (A)</b></div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                                                <input type="text" id="_ptg_speedtest_d" name="_ptg_speedtest_d" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Download">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                                                                <input type="text" id="_ptg_speedtest_d1" name="_ptg_speedtest_d1" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Upload">
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12 push-5"><b>SUPER ZOOM (B)</b></div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                                                <input type="text" id="_ptg_speedtest_e" name="_ptg_speedtest_e" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Download">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                                                                <input type="text" id="_ptg_speedtest_e1" name="_ptg_speedtest_e1" class="form-control input-sm js-masked-speedtest" placeholder="0.00" title="Upload">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="text-center">&nbsp;</td>
                                </tr>
                                @else
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td>
                                        <div class="push-5">{{ $ss->perkara }}</div>
                                        <div class="h6">
                                            <div class="font-w700"><u>Cara Pengujian</u></div>
                                            {{ $cara_pengujian }}
                                        </div>
                                    </td>
                                    <td width="250">
                                        <label class="css-input css-radio css-radio-success push-10-r">
                                            <input type="radio" value="1" name="_status_{{ $ss->id }}" checked><span></span> <i class="fa fa-check text-success"></i>
                                        </label>
                                        <label class="css-input css-radio css-radio-danger">
                                            <input type="radio" value="0" name="_status_{{ $ss->id }}"><span></span> <i class="fa fa-times text-danger"></i>
                                        </label>
                                    </td>
                                    <td>
                                        <textarea id="_catatan_{{ $ss->id }}" name="_catatan_{{ $ss->id }}" class="form-control input-sm"></textarea>
                                    </td>
                                </tr>
                                @endif
                                @endforeach

                                @foreach ($ss_user as $ssu)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td>
                                        <div class="push-5">{{ $ssu->perkara }}</div>
                                        <div class="h6">
                                            <div class="font-w700"><u>Cara Pengujian</u></div>
                                            {{ $ssu->cara_pengujian }}
                                        </div>
                                    </td>
                                    <td>
                                        <label class="css-input css-radio css-radio-success push-10-r">
                                            <input type="radio" value="1" name="_status_{{ $ssu->id }}" checked><span></span> <i class="fa fa-check text-success"></i>
                                        </label>
                                        <label class="css-input css-radio css-radio-danger">
                                            <input type="radio" value="0" name="_status_{{ $ssu->id }}"><span></span> <i class="fa fa-times text-danger"></i>
                                        </label>
                                    </td>
                                    <td>
                                        <textarea id="_catatan_{{ $ssu->id }}" name="_catatan_{{ $ssu->id }}" class="form-control"></textarea>
                                    </td>
                                </tr>
                                @endforeach

                                <tr>
                                    <td colspan="4" class="bg-primary-lighter h4 font-w700">TUGASAN HARIAN</td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <textarea id="_tugasan_harian" name="_tugasan_harian" class="form-control" rows="10"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    @if (strlen(Auth::user()->emel_kj) != 0)
                        <button id="btn_u_mel" class="btn btn-primary hide" type="button" onClick="javascript:EmelTH();">
                            <i class="fa fa-envelope push-5-r"></i>E-mel ke Ketua Jabatan
                        </button>
                    @endif
                    <button id="btn_u_print" class="btn btn-primary hide" type="button" onClick="javascript:CetakTH();">
                        <i class="fa fa-print push-5-r"></i>Cetak
                    </button>
                    <button id="btn_u_save" class="btn btn-primary" type="submit">
                        <i class="fa fa-save push-5-r"></i>Simpan Rekod
                    </button>
                    <button id="btn_u_cancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:ClearSemakan();">
                        <i class="fa fa-times push-5-r"></i>Batal
                    </button>
                    <input id="_id_th" name="_id_th" type="hidden" value="0" />
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<!-- Laporan Individu Dialog //-->
<div id="LIDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-popout">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">
                        <i class="fa fa-bar-chart push-10-r"></i>Laporan Log Tugasan
                    </h3>
                </div>
                <div class="block-content">
                    <div class="row push">
                        @if (Auth::user()->hasRole('ppd'))
                        <div class="col-sm-12 push-10">
                            <div class="form-group">
                                <span class="col-sm-12 push-5">Juruteknik :</span>
                                <div class="col-sm-12">
                                    <select name="lb_jtk" id="lb_jtk" data-placeholder="Juruteknik" class="form-control js-select2-avatar" style="width: 100%" required>
                                        <option></option>
                                        @foreach (\App\User::where('kod_ppd',Auth::user()->kod_ppd)->where('kod_jabatan','<>','')->orderBy('name','asc')->get() as $jtk)
                                        <option value="{{ $jtk->id }}">{{ $jtk->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @else
                            <input type="hidden" name="lb_jtk" id="lb_jtk" value="{{ Auth::user()->id }}">
                        @endif

                        <div class="col-sm-6">
                            <div class="form-group">
                                <span class="col-sm-12 push-5">Bulan :</span>
                                <div class="col-sm-12">
                                    <select name="lb_month" id="lb_month" data-placeholder="Bulan" class="form-control js-select2" style="width: 100%">
                                        <option></option>
                                        <!--<option value="0">Semua</option>//-->
                                        <?php
                                            for ($i = 1; $i <= 12; $i++) { 
                                        ?>
                                        @if (str_pad($i,2,'0',STR_PAD_LEFT) == date('m'))
                                            <option value="{{ str_pad($i,2,'0',STR_PAD_LEFT) }}" selected>{{ $jtkc->replaceMonth($i) }}</option>
                                        @else
                                            <option value="{{ str_pad($i,2,'0',STR_PAD_LEFT) }}">{{ $jtkc->replaceMonth($i) }}</option>
                                        @endif
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <span class="col-sm-12 push-5">Tahun :</span>
                                <div class="col-sm-12">
                                    <select name="lb_year" id="lb_year" data-placeholder="Tahun" class="form-control js-select2">
                                        <option></option>
                                        <?php
                                            for ($i = date('Y')-3; $i < date('Y')+10; $i++) { 
                                        ?>
                                        @if ($i == date('Y'))
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
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn_cetak_laporan" data-dismiss="modal" class="btn btn-primary" type="button" onclick="javascript:CetakLI($('#lb_jtk').val(),$('#lb_month').val(),$('#lb_year').val());">
                    <i class="fa fa-print push-5-r"></i>Cetak Laporan
                </button>
                <button id="btn_cancel_laporan" data-dismiss="modal" class="btn btn-danger" type="button">
                    <i class="fa fa-times push-5-r"></i>Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Laporan Speedtest Dialog //-->
<div id="LSpeedtestDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-popout">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">
                        <i class="fa fa-bar-chart push-10-r"></i>Laporan Speedtest
                    </h3>
                </div>
                <div class="block-content">
                    <div class="row push">
                        @if (Auth::user()->hasRole('ppd'))
                        <div class="col-sm-12 push-10">
                            <div class="form-group">
                                <span class="col-sm-12 push-5">Juruteknik :</span>
                                <div class="col-sm-12">
                                    <select name="lbs_jtk" id="lbs_jtk" data-placeholder="Juruteknik" class="form-control js-select2-avatar" style="width: 100%" required>
                                        <option></option>
                                        @foreach (\App\User::where('kod_ppd',Auth::user()->kod_ppd)->where('kod_jabatan','<>','')->orderBy('name','asc')->get() as $jtk)
                                        <option value="{{ $jtk->id }}">{{ $jtk->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @else
                            <input type="hidden" name="lbs_jtk" id="lbs_jtk" value="{{ Auth::user()->id }}">
                        @endif

                        <div class="col-sm-6">
                            <div class="form-group">
                                <span class="col-sm-12 push-5">Bulan :</span>
                                <div class="col-sm-12">
                                    <select name="lbs_month" id="lbs_month" data-placeholder="Bulan" class="form-control js-select2" style="width: 100%">
                                        <option></option>
                                        <!--<option value="0">Semua</option>//-->
                                        <?php
                                            for ($i = 1; $i <= 12; $i++) { 
                                        ?>
                                        @if (str_pad($i,2,'0',STR_PAD_LEFT) == date('m'))
                                            <option value="{{ str_pad($i,2,'0',STR_PAD_LEFT) }}" selected>{{ $jtkc->replaceMonth($i) }}</option>
                                        @else
                                            <option value="{{ str_pad($i,2,'0',STR_PAD_LEFT) }}">{{ $jtkc->replaceMonth($i) }}</option>
                                        @endif
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <span class="col-sm-12 push-5">Tahun :</span>
                                <div class="col-sm-12">
                                    <select name="lbs_year" id="lbs_year" data-placeholder="Tahun" class="form-control js-select2">
                                        <option></option>
                                        <?php
                                            for ($i = date('Y')-3; $i < date('Y')+10; $i++) { 
                                        ?>
                                        @if ($i == date('Y'))
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
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn_cetak_laporan_speedtest" data-dismiss="modal" class="btn btn-primary" type="button" onclick="javascript:CetakLSpeedtest($('#lbs_jtk').val(),$('#lbs_month').val(),$('#lbs_year').val());">
                    <i class="fa fa-print push-5-r"></i>Lihat Laporan
                </button>
                <button id="btn_cancel_laporan_speedtest" data-dismiss="modal" class="btn btn-danger" type="button">
                    <i class="fa fa-times push-5-r"></i>Batal
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
