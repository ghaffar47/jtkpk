@inject('jtkc', '\App\Http\Controllers\JTKController')

@extends('master.app')
@section('title', 'Senarai Aduan Kerosakan')
@section('site.description', 'Senarai Aduan Kerosakan Peralatan ICT')

@section('jquery')
$('#data').DataTable({ responsive: true });

@if (Auth::user()->hasRole('ppd') || Auth::user()->hasRole('jpn'))
<?php

# Daily
if (Auth::user()->hasRole('jpn')) {
    foreach (\App\PPD::where('kod_jpn',Auth::user()->kod_jpn)->get() as $ppd) {
        eval("\$daily_akp_".$ppd->kod_ppd." = array();");
    }
} else {
    $daily_akp = array();
}

if (strlen($mon) != 0 && strlen($year) != 0)
{
    $mon = ltrim($mon, '0');
    $TotalDays = cal_days_in_month(CAL_GREGORIAN, $mon, $year);
    for ($i=1; $i <= $TotalDays; $i++) {
        if (Auth::user()->hasRole('jpn')) {
            foreach (\App\PPD::where('kod_jpn',Auth::user()->kod_jpn)->get() as $ppd)
            {
                $TotalAKP = \App\AKP::where('kod_ppd',$ppd->kod_ppd)->whereYear('tarikh_aduan',$year)->whereMonth('tarikh_aduan',$mon)->whereDay('tarikh_aduan',$i)->count();
                eval("\$daily_akp_".$ppd->kod_ppd."[] = array(".$i.", intval(".$TotalAKP."));");
            }
        } else {
            $TotalAKP = \App\AKP::where('kod_ppd',Auth::user()->kod_ppd)->whereYear('tarikh_aduan',$year)->whereMonth('tarikh_aduan',$mon)->whereDay('tarikh_aduan',$i)->count();
            $daily_akp[] = array($i, intval($TotalAKP));
        }
    }
}
else
{
    $TotalDays = cal_days_in_month(CAL_GREGORIAN, date('n'), date('Y'));
    for ($i=1; $i <= $TotalDays; $i++) {
        if (Auth::user()->hasRole('jpn')) {
            foreach (\App\PPD::where('kod_jpn',Auth::user()->kod_jpn)->get() as $ppd)
            {
                $TotalAKP = \App\AKP::where('kod_ppd',$ppd->kod_ppd)->whereYear('tarikh_aduan',date('Y'))->whereMonth('tarikh_aduan',date('n'))->whereDay('tarikh_aduan',$i)->count();
                eval("\$daily_akp_".$ppd->kod_ppd."[] = array(".$i.", intval(".$TotalAKP."));");
            }
        } else {
            $TotalAKP = \App\AKP::where('kod_ppd',Auth::user()->kod_ppd)->whereYear('tarikh_aduan',date('Y'))->whereMonth('tarikh_aduan',date('n'))->whereDay('tarikh_aduan',$i)->count();
            $daily_akp[] = array($i, intval($TotalAKP));
        }
    }
}

if (Auth::user()->hasRole('jpn')) {
    foreach (\App\PPD::where('kod_jpn',Auth::user()->kod_jpn)->get() as $ppd) {
        eval("\$stats_daily_".$ppd->kod_ppd." = json_encode(\$daily_akp_".$ppd->kod_ppd.");");
    }
} else {
    $stats_daily = json_encode($daily_akp);
}

# Monthly
$_month = array();
if (Auth::user()->hasRole('jpn')) {
    foreach (\App\PPD::where('kod_jpn',Auth::user()->kod_jpn)->get() as $ppd) {
        eval("\$monthly_akp_".$ppd->kod_ppd." = array();");
    }
} else {
    $monthly_akp = array();
}

for ($i=1; $i <= 12; $i++) {
    $_month[] = substr($jtkc->replaceMonth($i),0,3);
    if (Auth::user()->hasRole('jpn')) {
        foreach (\App\PPD::where('kod_jpn',Auth::user()->kod_jpn)->get() as $ppd)
        {
            $TotalM_AKP = \App\AKP::where('kod_ppd',$ppd->kod_ppd)->whereYear('tarikh_aduan',date('Y'))->whereMonth('tarikh_aduan',$i)->count();
            eval("\$monthly_akp_".$ppd->kod_ppd."[] = array(".$i.", intval(".$TotalM_AKP."));");
        }
    } else {
        $TotalM_AKP = \App\AKP::where('kod_ppd',Auth::user()->kod_ppd)->whereYear('tarikh_aduan',date('Y'))->whereMonth('tarikh_aduan',$i)->count();
        $monthly_akp[] = array(intval($i), intval($TotalM_AKP));
    }
}
$MonthNames = json_encode($_month);
if (Auth::user()->hasRole('jpn')) {
    foreach (\App\PPD::where('kod_jpn',Auth::user()->kod_jpn)->get() as $ppd) {
        eval("\$stats_monthly_".$ppd->kod_ppd." = json_encode(\$monthly_akp_".$ppd->kod_ppd.");");
    }
} else {
    $stats_monthly = json_encode($monthly_akp);
}

# Yearly
$_year = array();
if (Auth::user()->hasRole('jpn')) {
    foreach (\App\PPD::where('kod_jpn',Auth::user()->kod_jpn)->get() as $ppd) {
        eval("\$yearly_akp_".$ppd->kod_ppd." = array();");
    }
} else {
    $yearly_akp = array();
}
for ($i=1; $i <= 6; $i++) {
    $last_year = (date('Y')-1);
    if ($i == 1) {
        $ayear = $last_year;
    } else {
        $ayear = ($last_year-1) + $i;
    }
    $_year[] = intval($ayear);

    if (Auth::user()->hasRole('jpn')) {
        foreach (\App\PPD::where('kod_jpn',Auth::user()->kod_jpn)->get() as $ppd)
        {
            $TotalY_AKP = \App\AKP::where('kod_ppd',$ppd->kod_ppd)->whereYear('tarikh_aduan',$ayear)->count();
            eval("\$yearly_akp_".$ppd->kod_ppd."[] = array(".$i.", intval(".$TotalY_AKP."));");
        }
    } else {
        $TotalY_AKP = \App\AKP::where('kod_ppd',Auth::user()->kod_ppd)->whereYear('tarikh_aduan',$ayear)->count();
        $yearly_akp[] = array(intval($i),intval($TotalY_AKP));
    }
}
$YearNames = json_encode($_year);
if (Auth::user()->hasRole('jpn')) {
    foreach (\App\PPD::where('kod_jpn',Auth::user()->kod_jpn)->get() as $ppd) {
        eval("\$stats_yearly_".$ppd->kod_ppd." = json_encode(\$yearly_akp_".$ppd->kod_ppd.");");
    }
} else {
    $stats_yearly = json_encode($yearly_akp);
}
?>
var MonthNames = <?php echo $MonthNames ?>; var YearNames = <?php echo $YearNames ?>;
var StatDaily = [
    @if (Auth::user()->hasRole('jpn'))
        @foreach (\App\PPD::where('kod_jpn',Auth::user()->kod_jpn)->get() as $ppd)
            {label: "{{ $ppd->ppd }} ({{ $ppd->kod_ppd }})", data: <?php eval("\$data = \$stats_daily_".$ppd->kod_ppd.";"); echo $data; ?> },
        @endforeach
    @else
        {label: "Jumlah Aduan Kerosakan", color: "#5c90d2", data: {{ $stats_daily }} }
    @endif
];

var StatMonthly = [
    @if (Auth::user()->hasRole('jpn'))
        @foreach (\App\PPD::where('kod_jpn',Auth::user()->kod_jpn)->get() as $ppd)
            {label: "{{ $ppd->ppd }} ({{ $ppd->kod_ppd }})", data: <?php eval("\$data = \$stats_monthly_".$ppd->kod_ppd.";"); echo $data; ?> },
        @endforeach
    @else
        {label: "Jumlah Aduan Kerosakan", color: "#5c90d2", data: {{ $stats_monthly }} }
    @endif
];

var StatYearly = [
    @if (Auth::user()->hasRole('jpn'))
        @foreach (\App\PPD::where('kod_jpn',Auth::user()->kod_jpn)->get() as $ppd)
            {label: "{{ $ppd->ppd }} ({{ $ppd->kod_ppd }})", data: <?php eval("\$data = \$stats_yearly_".$ppd->kod_ppd.";"); echo $data; ?> },
        @endforeach
    @else
        {label: "Jumlah Aduan Kerosakan", color: "#5c90d2", data: {{ $stats_yearly }} }
    @endif
];


"use strict";

function showTooltip(x, y, contents) {
    jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css({
        position: 'absolute',
        display: 'none',
        top: y + 5,
        left: x + 5
    }).appendTo("body").fadeIn(200);
}
/* STATISTICS DAILY */
var PlotDaily = jQuery.plot(jQuery("#DailyChart"),StatDaily,
{
    series: {
        lines: {
            show: false
        },
        splines: {
            show: true,
            tension: 0.4,
            lineWidth: 1,
            fill: 0
        },
        shadowSize: 0
    },
    points: {
        show: true,
    },
    legend: {
        container: '#DC_Legend',
        noColumns: 3
    },
    grid: {
        hoverable: true,
        clickable: true,
        borderColor: '#ddd',
        borderWidth: 0,
        labelMargin: 5,
        backgroundColor: '#fff'
    },
    yaxis: {
        label: "test",
        min: 0,
        color: '#eee'
    },
    xaxis: {
        color: '#eee',
        tickSize: 1,
        tickDecimals: 0
    }
});
var iDaily = null;
jQuery("#DailyChart").bind("plothover",function(event,pos,item){
    if (item) {
        if (iDaily != item.dataIndex) {
            iDaily = item.dataIndex;           
            jQuery("#tooltip").remove();
            var x = item.datapoint[0],y = item.datapoint[1];
            showTooltip(item.pageX, item.pageY, y);
        }
    } else {
        jQuery("#tooltip").remove();
        iDaily = null;
    }
});
jQuery("#DailyChart").bind("plotclick",function(event,pos,item){
    /*alert("You clicked at " + item.datapoint[0]);*/
});

/* STATISTICS MONTHLY */
var PlotMonthly = jQuery.plot(jQuery("#MonthlyChart"),StatMonthly,
{
    series: {
        lines: {
            show: false
        },
        splines: {
            show: true,
            tension: 0.4,
            lineWidth: 1,
            fill: 0
        },
        shadowSize: 0
    },
    points: {
        show: true,
    },
    legend: {
        container: '#MC_Legend',
        noColumns: 3
    },
    grid: {
        hoverable: true,
        clickable: true,
        borderColor: '#ddd',
        borderWidth: 0,
        labelMargin: 5,
        backgroundColor: '#fff'
    },
    yaxis: {
        min: 0,
        color: '#eee'
    },
    xaxis: {
        color: '#eee',
        tickSize: 1,
        tickFormatter: function(v) {
            v = MonthNames[v-1];
            return v;
        }
    }
});
var iMonthly = null;
jQuery("#MonthlyChart").bind("plothover",function(event,pos,item){
    if (item) {
        if (iMonthly != item.dataIndex) {
            iMonthly = item.dataIndex;           
            jQuery("#tooltip").remove();
            var x = item.datapoint[0],y = item.datapoint[1];
            showTooltip(item.pageX, item.pageY, y);
        }
    } else {
        jQuery("#tooltip").remove();
        iMonthly = null;
    }
});
jQuery("#MonthlyChart").bind("plotclick",function(event,pos,item){
    /*alert("You clicked at " + item.datapoint[0]);*/
});

/* STATISTICS YEARLY */
var PlotYearly = jQuery.plot(jQuery("#YearlyChart"),StatYearly,
{
    series: {
        lines: {
            show: false
        },
        splines: {
            show: true,
            tension: 0.4,
            lineWidth: 1,
            fill: 0
        },
        shadowSize: 0
    },
    points: {
        show: true,
    },
    legend: {
        container: '#YC_Legend',
        noColumns: 3
    },
    grid: {
        hoverable: true,
        clickable: true,
        borderColor: '#ddd',
        borderWidth: 0,
        labelMargin: 5,
        backgroundColor: '#fff'
    },
    yaxis: {
        min: 0,
        color: '#eee'
    },
    xaxis: {
        color: '#eee',
        tickSize: 1,
        tickFormatter: function(v) {
            v = YearNames[v-1];
            return v;
        }
    }
});
var iYearly = null;
jQuery("#YearlyChart").bind("plothover",function(event,pos,item){
    if (item) {
        if (iYearly != item.dataIndex) {
            iYearly = item.dataIndex;           
            jQuery("#tooltip").remove();
            var x = item.datapoint[0],y = item.datapoint[1];
            showTooltip(item.pageX, item.pageY, y);
        }
    } else {
        jQuery("#tooltip").remove();
        iYearly = null;
    }
});
jQuery("#YearlyChart").bind("plotclick",function(event,pos,item){
    /*alert("You clicked at " + YearNames[item.datapoint[0]-1]);*/
});



@endif
@endsection

@section('js')
@if (Auth::user()->hasRole('ppd') || Auth::user()->hasRole('jpn'))
<script src="/assets/js/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="/assets/js/plugins/easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="/assets/js/plugins/chartjs/Chart.min.js"></script>
<script src="/assets/js/plugins/flot/jquery.flot.min.js"></script>
<script src="/assets/js/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="/assets/js/plugins/flot/jquery.flot.stack.min.js"></script>
<script src="/assets/js/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="/assets/js/plugins/flot/jquery.flot.spline.min.js"></script>
@endif
@endsection

@section('content')
@if (!Auth::user()->hasRole('ppd') && !Auth::user()->hasRole('jpn'))
<script type="text/javascript">
function ClearAKP() {
    $('#_tarikh_aduan').val('');
    $('#_tarikh_aduan').removeAttr('disabled');
    $('#_no_siri_aduan').val('');
    $('#_no_siri_aduan').removeAttr('disabled');
    $('#_nama').val('');
    $('#_email').val('');
    $('#_jawatan').val('');
    $('#_no_telefon').val('');

    @foreach (\App\KategoriKerosakan::where('parent_id','0')->get() as $_kk)
        @foreach (\App\KategoriKerosakan::where('parent_id',$_kk->id)->get() as $_skk)
        $('#_kerosakan_{{ $_skk->id }}').prop('checked', false);
        @if (strtolower($_skk->kategori) == 'lain-lain')
            $('#_lainlain_{{ $_skk->id }}').val('');            
        @endif
        @endforeach
    @endforeach

    $('input[name="_hakmilik"]').prop('checked', false);
    $('input[name="_kategori_aduan"]').prop('checked', false);
    $('input[name="_status_aduan"]').prop('checked', false);
    $('#_lokasi_peralatan').val('');    
    $('#_no_dhm').val('');
    $('#_keterangan_kerosakan').val('');    
    $('#_laporan_tindakan').val('');
    $('#_tarikh_pemeriksaan').val('');
    $('#_tarikh_selesai').val('');

    $('#_id').val('0');
}
</script>
@endif

<!-- Page Header -->
<div class="content bg-image overflow-hidden" style="background-image: url('/assets/img/photos/photo12@2x.jpg');">
    <div class="push-100-t push-15">
        <h1 class="h2 font-w300 text-white animated fadeInUp">
            <i class="fa fa-wrench push-15-r"></i> Aduan Kerosakan Peralatan ICT
        </h1>
    </div>
</div>
<!-- END Page Header -->

<!-- Menu -->
<div class="content padding-5-t bg-white border-b">
    <div class="push-15 push-10-t">
        <div class="row">
            @if (Auth::user()->hasRole('ppd') || Auth::user()->hasRole('jpn'))
                <div class="col-md-7">
                    <a class="btn btn-primary" href="#" onclick="javascript:window.print();return false;">
                        <i class="fa fa-print"></i> Cetak
                    </a>
                    @if (strlen($mon) != 0 && strlen($year) != 0)
                    <a class="btn btn-primary" href="{{ url('/aduan-kerosakan') }}">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    @endif
                </div>
                <div class="col-md-5 pull-right">
                    <div class="row">
                        <div class="col-xs-6">
                            <select name="qmonth" id="qmonth" data-placeholder="Bulan" class="form-control js-select2">
                                <option></option>
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
                        <div class="col-xs-3">
                            <select name="qyear" id="qyear" data-placeholder="Tahun" class="form-control js-select2">
                                <option></option>
                                <?php
                                    for ($i = date('Y'); $i < date('Y')+10; $i++) { 
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
                            <button type="button" class="btn btn-primary" onclick="javascript:ViewAKP($('#qmonth').val(),$('#qyear').val());">
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
                                    <a tabindex="-1" href="#" onclick="javascript:LaporanBulananAKP();return false;">
                                        <i class="fa fa-bar-chart push-5-r"></i>Laporan Bulanan Aduan Kerosakan Peralatan ICT
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 text-right">
                    <button type="button" class="btn btn-primary" onclick="javascript:AddAKP();return false;">
                        <i class="fa fa-plus"></i> <span class="hidden-xs hidden-sm">Tambah Aduan</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- END Menu -->

<!-- Page Content -->
<div class="content">
    @if ($error == 'already_exists')
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-exclamation push-5-r text-danger"></i> Rekod telah wujud dalam pangkalan data.
        </div>
    @endif
    <div class="row">
        @if (Auth::user()->hasRole('ppd') || Auth::user()->hasRole('jpn'))
            <div class="col-xs-12">
                <div class="block block-bordered">
                    <div class="block-header bg-gray-lighter">
                        @if (Auth::user()->hasRole('jpn'))
                            <h3 class="block-title"><i class="fa fa-line-chart push-10-r"></i>Statistik Aduan Kerosakan - <b>{{ Auth::user()->nama_jpn }}</b></h3>
                        @else
                            <h3 class="block-title"><i class="fa fa-line-chart push-10-r"></i>Statistik Aduan Kerosakan - <b>{{ Auth::user()->nama_ppd }}</b></h3>
                        @endif
                    </div>
                    <div class="block-content block-content-full">
                        @if (strlen($mon) != 0 && strlen($year) != 0)
                            <h5 class="push-5"><b>Harian ({{ $jtkc->replaceMonth($mon) }}, {{ $year }})</b></h5>
                        @else
                            <h5 class="push-5"><b>Harian ({{ $jtkc->replaceMonth(date('m')) }}, {{ date('Y') }})</b></h5>
                        @endif
                        <div id="DC_Legend" class="flotLegend"></div>
                        <div id="DailyChart" class="flotGraph"></div>
                    </div>
                    @if (strlen($mon) == 0 && strlen($year) == 0)
                        <hr class="remove-margin">
                        <div class="block-content block-content-full">
                            <h5 class="push-5"><b>Bulanan ({{ date('Y') }})</b></h5>
                            <div id="MC_Legend" class="flotLegend"></div>
                            <div id="MonthlyChart" class="flotGraph"></div>
                        </div>
                        <hr class="remove-margin">
                        <div class="block-content block-content-full">
                            <h5 class="push-5"><b>Tahunan</b></h5>
                            <div id="YC_Legend" class="flotLegend"></div>
                            <div id="YearlyChart" class="flotGraph"></div>
                        </div>
                    @endif
                </div>
            </div>

            @if (strlen($mon) != 0 && strlen($year) != 0)
            <div class="col-xs-12">
                <div class="block block-themed block-rounded push-5">
                    <div class="block-content">
                        <table id="data" class="table table-striped table-bordered responsive h6">
                            <thead>
                                <tr>
                                    <th class="text-center">Bil</th>
                                    <th class="text-center">Tarikh Aduan</th>
                                    <th class="text-center">No. Siri Aduan</th>
                                    @if (Auth::user()->hasRole('jpn'))
                                        <th class="text-center">PPD</th>
                                    @endif
                                    <th class="text-center">Sekolah</th>
                                    <th class="text-center">Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @if (Auth::user()->hasRole('jpn'))
                                    @foreach (\App\AKP::where('kod_jpn',Auth::user()->kod_jpn)->whereYear('tarikh_aduan',$year)->whereMonth('tarikh_aduan',ltrim($mon,'0'))->orderBy('id','desc')->get() as $akpd)
                                    <?php $i++; ?>
                                    <tr>
                                        <td class="text-center">{{ $i }}.</td>
                                        <td class="text-center">
                                            {{ $akpd->tarikh_aduan_formatted }}
                                        </td>
                                        <td class="text-center">                                        
                                            {{ $akpd->no_siri_akp }}                                        
                                        </td>
                                        <td class="text-center">
                                            {{ $akpd->user->nama_ppd }}
                                        </td>                                        
                                        <td class="text-center">
                                            {{ $akpd->user->jabatan->nama_sekolah_detail_cetakan }}
                                        </td>
                                        <td class="text-center">
                                            {{ $akpd->status_aduan_view }}
                                        </td>
                                        <td class="text-center" width="150">
                                            <button id="btn_print" class="btn btn-sm btn-primary" type="button" onClick="javascript:CetakAKP('{{ $akpd->id }}');return false;">
                                                <i class="fa fa-print push-5-r"></i>Cetak
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    @foreach (\App\AKP::where('kod_ppd',Auth::user()->kod_ppd)->whereYear('tarikh_aduan',$year)->whereMonth('tarikh_aduan',ltrim($mon,'0'))->orderBy('id','desc')->get() as $akpd)
                                    <?php $i++; ?>
                                    <tr>
                                        <td class="text-center">{{ $i }}.</td>
                                        <td class="text-center">
                                            {{ $akpd->tarikh_aduan_formatted }}
                                        </td>
                                        <td class="text-center">                                        
                                            {{ $akpd->no_siri_akp }}                                        
                                        </td>
                                        <td class="text-center">
                                            {{ $akpd->user->jabatan->nama_sekolah_detail_cetakan }}
                                        </td>
                                        <td class="text-center">
                                            {{ $akpd->status_aduan_view }}
                                        </td>
                                        <td class="text-center" width="150">
                                            <button id="btn_print" class="btn btn-sm btn-primary" type="button" onClick="javascript:CetakAKP('{{ $akpd->id }}');return false;">
                                                <i class="fa fa-print push-5-r"></i>Cetak
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

        @else
            <div class="col-xs-12">
                <div class="block block-themed block-rounded push-5">
                    <div class="block-content">
                        <table id="data" class="table table-striped table-bordered responsive h6">
                            <thead>
                                <tr>
                                    <th class="text-center">Bil</th>
                                    <th class="text-center">Tarikh Aduan</th>
                                    <th class="text-center">No. Siri Aduan</th>
                                    <th class="text-center">Nama Pengadu</th>
                                    <th class="text-center">Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($akp as $akpd)
                                <?php $i++; ?>
                                <tr>
                                    <td class="text-center">{{ $i }}.</td>
                                    <td class="text-center">
                                        {{ $akpd->tarikh_aduan_formatted }}
                                    </td>
                                    <td class="text-center">
                                        <a href="#" onclick="javascript:EditAKP('{{ $akpd->id }}');return false;">
                                            <div class="font-w300 text-primary">
                                                {{ $akpd->no_siri_akp }}
                                            </div>
                                        </a>
                                    </td>
                                    <td class="text-left">
                                        {{ $akpd->nama }}
                                    </td>
                                    <td class="text-center">
                                        {{ $akpd->status_aduan_view }}
                                    </td>
                                    <td class="text-center" width="150">
                                        <button id="btn_print" class="btn btn-sm btn-primary" type="button" onClick="javascript:CetakAKP('{{ $akpd->id }}');return false;">
                                            <i class="fa fa-print push-5-r"></i>Cetak
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit" onclick="javascript:EditAKP('{{ $akpd->id }}');return false;">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Padam" onclick="javascript:PadamAKP('{{ $akpd->id }}');return false;">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<!-- END Page Content -->

@if (!Auth::user()->hasRole('ppd') && !Auth::user()->hasRole('jpn'))
<!-- Laporan Bulanan Dialog //-->
<div id="LBDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-popout">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">
                        <i class="fa fa-wrench push-10-r"></i>Laporan Bulanan
                    </h3>
                </div>
                <div class="block-content">
                    <div class="row push">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <span class="col-sm-12 push-5">Bulan :</span>
                                <div class="col-sm-12">
                                    <select name="lb_month" id="lb_month" data-placeholder="Bulan" class="form-control js-select2" style="width: 100%">
                                        <option></option>
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
                <button id="btn_cetak_laporan" data-dismiss="modal" class="btn btn-primary" type="button" onclick="javascript:CetakLBAKP($('#lb_month').val(),$('#lb_year').val());">
                    <i class="fa fa-print push-5-r"></i>Cetak Laporan
                </button>
                <button id="btn_cancel_laporan" data-dismiss="modal" class="btn btn-danger" type="button">
                    <i class="fa fa-times push-5-r"></i>Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- AKP Dialog //-->
<div id="AKPDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popout">
        <div class="modal-content">
            <form method="post" class="form-horizontal" action="{{ url('/aduan-kerosakan') }}">
                {{ csrf_field() }}
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">
                            <i class="fa fa-wrench push-10-r"></i>Aduan Kerosakan
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="row push">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <span class="col-sm-12 push-5">Tarikh Aduan :</span>
                                    <div class="col-sm-12">
                                        <input type="text" id="_tarikh_aduan" name="_tarikh_aduan" class="js-datepicker form-control" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ date('d/m/Y') }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span class="col-sm-12 push-5">No. Siri Aduan :</span>
                                    <div class="col-sm-12">
                                        <input type="text" id="_no_siri_aduan" name="_no_siri_aduan" class="form-control" maxlength="255" placeholder="No. Siri Aduan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 border-l">

                                <div class="block block-themed block-transparent remove-margin-b">
                                    <div class="block-header bg-primary-dark">
                                        <h3 class="block-title">
                                            <i class="fa fa-user push-10-r"></i>Maklumat Pengadu
                                        </h3>
                                    </div>
                                    <div class="block-content">
                                        <div class="form-group push">
                                            <label class="col-sm-4 control-label">Nama Pengadu :</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="_nama" name="_nama" class="form-control" maxlength="255" placeholder="Nama Pengadu" required>
                                            </div>
                                        </div>
                                        <div class="form-group push">
                                            <label class="col-sm-4 control-label">Alamat E-mel :</label>
                                            <div class="col-sm-8">
                                                <input type="email" id="_email" name="_email" class="form-control" maxlength="255" placeholder="Alamat E-mel">
                                            </div>
                                        </div>
                                        <div class="form-group push">
                                            <label class="col-sm-4 control-label">Jawatan :</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="_jawatan" name="_jawatan" class="form-control" maxlength="255" placeholder="Jawatan">
                                            </div>
                                        </div>
                                        <div class="form-group push">
                                            <label class="col-sm-4 control-label">No. Telefon :</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="_no_telefon" name="_no_telefon" class="form-control" maxlength="255" placeholder="No. Telefon">
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>

                                <div class="block block-themed block-transparent remove-margin-b">
                                    <div class="block-header bg-primary-dark">
                                        <h3 class="block-title">
                                            <i class="fa fa-wrench push-10-r"></i>Maklumat Kerosakan
                                        </h3>
                                    </div>
                                    <div class="block-content">
                                        <div class="row push border-b">
                                            @foreach (\App\KategoriKerosakan::where('parent_id','0')->get() as $_kk)
                                            <div class="col-sm-12 h5 font-w700 push-5"><u>{{ $_kk->kategori }}</u></div>
                                                <div class="col-sm-12 push-10 h6">
                                                    <div class="row">
                                                        @foreach (\App\KategoriKerosakan::where('parent_id',$_kk->id)->get() as $_skk)
                                                        <div class="col-sm-4">
                                                            <label class="css-input css-checkbox css-checkbox-primary">
                                                                <input type="checkbox" value="{{ $_skk->id }}" id="_kerosakan_{{ $_skk->id }}" name="_kerosakan_{{ $_skk->id }}"><span></span> {{ $_skk->kategori }}
                                                            </label>
                                                        </div>
                                                        @if (strtolower($_skk->kategori) == 'lain-lain')
                                                            <div class="col-sm-4">                                                            
                                                                <input type="text" id="_lainlain_{{ $_skk->id }}" name="_lainlain_{{ $_skk->id }}" class="form-control input-sm" maxlength="255" placeholder="Jika Lain-Lain">
                                                            </div>
                                                        @endif

                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="form-group push">
                                            <label class="col-sm-4 control-label">Hak Milik Peralatan :</label>
                                            <div class="col-sm-8">
                                                <label class="css-input css-radio css-radio-primary push-10-r">
                                                    <input type="radio" value="KERAJAAN" name="_hakmilik" checked><span></span> Kerajaan
                                                </label>
                                                <label class="css-input css-radio css-radio-primary">
                                                    <input type="radio" value="PERSENDIRIAN" name="_hakmilik"><span></span> Persendirian
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group push">
                                            <label class="col-sm-4 control-label">Kategori Aduan :</label>
                                            <div class="col-sm-8">
                                                <label class="css-input css-radio css-radio-primary push-10-r">
                                                    <input type="radio" value="BIASA" name="_kategori_aduan" checked><span></span> Biasa
                                                </label>
                                                <label class="css-input css-radio css-radio-primary">
                                                    <input type="radio" value="SEGERA" name="_kategori_aduan"><span></span> Segera
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group push">
                                            <label class="col-sm-4 control-label">Lokasi Peralatan :</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="_lokasi_peralatan" name="_lokasi_peralatan" class="form-control" maxlength="255" placeholder="Lokasi Peralatan">
                                            </div>
                                        </div>
                                        <div class="form-group push">
                                            <label class="col-sm-4 control-label">No. Siri DHM Peralatan :</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="_no_dhm" name="_no_dhm" class="form-control" maxlength="255" placeholder="No. Siri DHM Peralatan">
                                            </div>
                                        </div>
                                        <div class="form-group push">
                                            <span class="col-sm-12 push-5">Keterangan Kerosakan/Masalah :</span>
                                            <div class="col-sm-12">
                                                <textarea id="_keterangan_kerosakan" name="_keterangan_kerosakan" class="form-control" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="block block-themed block-transparent remove-margin-b">
                                    <div class="block-header bg-primary-dark">
                                        <h3 class="block-title">
                                            <i class="fa fa-wrench push-10-r"></i>Laporan Tindakan
                                        </h3>
                                    </div>
                                    <div class="block-content">
                                        <div class="form-group push">
                                            <span class="col-sm-12 push-5">Laporan Tindakan :</span>
                                            <div class="col-sm-12">
                                                <textarea id="_laporan_tindakan" name="_laporan_tindakan" class="form-control" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group push">
                                            <label class="col-sm-4 control-label">Tarikh Pemeriksaan :</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="_tarikh_pemeriksaan" name="_tarikh_pemeriksaan" class="js-datepicker form-control" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy">
                                            </div>
                                        </div>
                                        <div class="form-group push">
                                            <label class="col-sm-4 control-label">Tarikh Selesai :</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="_tarikh_selesai" name="_tarikh_selesai" class="js-datepicker form-control" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy">
                                            </div>
                                        </div>
                                        <div class="form-group push">
                                            <label class="col-sm-4 control-label">Status Aduan :</label>
                                            <div class="col-sm-8">
                                                <label class="css-input css-radio css-radio-primary push-10-r">
                                                    <input type="radio" value="SELESAI" name="_status_aduan"><span></span> Selesai
                                                </label>
                                                <label class="css-input css-radio css-radio-primary push-10-r">
                                                    <input type="radio" value="TIDAK SELESAI" name="_status_aduan"><span></span> Tidak Selesai
                                                </label>
                                                <label class="css-input css-radio css-radio-primary">
                                                    <input type="radio" value="HANTAR KE PEMBEKAL" name="_status_aduan"><span></span> Hantar ke Pembekal
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Added by Zul : 15/01/2017 //-->
                                        <div class="form-group push">
                                            <label class="col-sm-4 control-label">Status Peralatan :</label>
                                            <div class="col-sm-8">
                                                <label class="css-input css-radio css-radio-primary push-10-r">
                                                    <input type="radio" value="OK" name="_status_peralatan"><span></span> Boleh Digunapakai
                                                </label>
                                                <label class="css-input css-radio css-radio-primary push-10-r">
                                                    <input type="radio" value="ROSAK" name="_status_peralatan"><span></span> Rosak
                                                </label>
                                                <label class="css-input css-radio css-radio-primary">
                                                    <input type="radio" value="LUPUS" name="_status_peralatan"><span></span> Lupus
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_save" class="btn btn-primary" type="submit">
                        <i class="fa fa-save push-5-r"></i>Simpan Rekod
                    </button>
                    <button id="btn_cancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:ClearAKP();">
                        <i class="fa fa-times push-5-r"></i>Batal
                    </button>                
                    <input id="_id" name="_id" type="hidden" value="0" />
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
