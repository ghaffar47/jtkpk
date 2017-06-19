@inject('jtkc', '\App\Http\Controllers\JTKController')

@extends('master.single')
@section('title', 'Laporan Speedtest')
@section('site.description', 'Laporan Speedtest')

@section('jquery')
<?php

# Daily
$daily = array();

if (strlen($month) != 0 && strlen($year) != 0)
{
    // MONTH
    $mon = ltrim($month, '0');
    $TotalDays = cal_days_in_month(CAL_GREGORIAN, $mon, $year);
    for ($i=1; $i <= $TotalDays; $i++)
    {
        $hari = strtolower($jtkc->replaceDay(date('l',strtotime("$year-$mon-$i"))));
        if ($hari != 'sabtu' && $hari != 'ahad')
        {
            $i = intval(date('j',strtotime("$year-$mon-$i")));
            $tarikh = "$year-$mon-$i";
            $th = \App\TugasanHarian::whereYear('tarikh_semakan',$year)->whereMonth('tarikh_semakan',$mon)->whereDay('tarikh_semakan',$i)->where('user_id',$user_id)->first();
            if (count($th) == 0) {
                $daily_DPG_DIRECT_FEED[] = array($i, intval(0));
                $daily_DPG_ZOOM_A[] = array($i, intval(0));
                $daily_DPG_ZOOM_B[] = array($i, intval(0));
                $daily_DPG_ZOOM_C[] = array($i, intval(0));                
                $daily_DPG_SUPER_ZOOM_A[] = array($i, intval(0));
                $daily_DPG_SUPER_ZOOM_B[] = array($i, intval(0));
                $daily_UPG_DIRECT_FEED[] = array($i, intval(0));
                $daily_UPG_ZOOM_A[] = array($i, intval(0));
                $daily_UPG_ZOOM_B[] = array($i, intval(0));
                $daily_UPG_ZOOM_C[] = array($i, intval(0));                
                $daily_UPG_SUPER_ZOOM_A[] = array($i, intval(0));
                $daily_UPG_SUPER_ZOOM_B[] = array($i, intval(0));

                $daily_DPTG_DIRECT_FEED[] = array($i, intval(0));
                $daily_DPTG_ZOOM_A[] = array($i, intval(0));
                $daily_DPTG_ZOOM_B[] = array($i, intval(0));
                $daily_DPTG_ZOOM_C[] = array($i, intval(0));
                $daily_DPTG_SUPER_ZOOM_A[] = array($i, intval(0));
                $daily_DPTG_SUPER_ZOOM_B[] = array($i, intval(0));
                $daily_UPTG_DIRECT_FEED[] = array($i, intval(0));
                $daily_UPTG_ZOOM_A[] = array($i, intval(0));
                $daily_UPTG_ZOOM_B[] = array($i, intval(0));
                $daily_UPTG_ZOOM_C[] = array($i, intval(0));
                $daily_UPTG_SUPER_ZOOM_A[] = array($i, intval(0));
                $daily_UPTG_SUPER_ZOOM_B[] = array($i, intval(0));
            } else {
                $s = json_decode($th->status_semakan);
                if (count($s) > 0)
                {
                    foreach ($s as $v)
                    {
                        if ($v->id == '1')
                        {
                            $_speedtest_a = isset($v->_speedtest_a) ? $v->_speedtest_a:"";
                            $_speedtest_b = isset($v->_speedtest_b) ? $v->_speedtest_b:"";
                            $_speedtest_c = isset($v->_speedtest_c) ? $v->_speedtest_c:"";
                            $_speedtest_d = isset($v->_speedtest_d) ? $v->_speedtest_d:"";
                            $_speedtest_e = isset($v->_speedtest_e) ? $v->_speedtest_e:"";
                            $_speedtest_f = isset($v->_speedtest_f) ? $v->_speedtest_f:"";
                            $_speedtest_a1 = isset($v->_speedtest_a1) ? $v->_speedtest_a1:"";
                            $_speedtest_b1 = isset($v->_speedtest_b1) ? $v->_speedtest_b1:"";
                            $_speedtest_c1 = isset($v->_speedtest_c1) ? $v->_speedtest_c1:"";
                            $_speedtest_d1 = isset($v->_speedtest_d1) ? $v->_speedtest_d1:"";
                            $_speedtest_e1 = isset($v->_speedtest_e1) ? $v->_speedtest_e1:"";
                            $_speedtest_f1 = isset($v->_speedtest_f1) ? $v->_speedtest_f1:"";

                            $daily_DPG_DIRECT_FEED[] = array($i, floatval($_speedtest_f));
                            $daily_DPG_ZOOM_A[] = array($i, floatval($_speedtest_a));
                            $daily_DPG_ZOOM_B[] = array($i, floatval($_speedtest_b));
                            $daily_DPG_ZOOM_C[] = array($i, floatval($_speedtest_c));
                            $daily_DPG_SUPER_ZOOM_A[] = array($i, floatval($_speedtest_d));
                            $daily_DPG_SUPER_ZOOM_B[] = array($i, floatval($_speedtest_e));
                            $daily_UPG_DIRECT_FEED[] = array($i, floatval($_speedtest_f1));
                            $daily_UPG_ZOOM_A[] = array($i, floatval($_speedtest_a1));
                            $daily_UPG_ZOOM_B[] = array($i, floatval($_speedtest_b1));
                            $daily_UPG_ZOOM_C[] = array($i, floatval($_speedtest_c1));
                            $daily_UPG_SUPER_ZOOM_A[] = array($i, floatval($_speedtest_d1));
                            $daily_UPG_SUPER_ZOOM_B[] = array($i, floatval($_speedtest_e1));

                            $_ptg_speedtest_a = isset($v->_ptg_speedtest_a) ? $v->_ptg_speedtest_a:"";
                            $_ptg_speedtest_b = isset($v->_ptg_speedtest_b) ? $v->_ptg_speedtest_b:"";
                            $_ptg_speedtest_c = isset($v->_ptg_speedtest_c) ? $v->_ptg_speedtest_c:"";
                            $_ptg_speedtest_d = isset($v->_ptg_speedtest_d) ? $v->_ptg_speedtest_d:"";
                            $_ptg_speedtest_e = isset($v->_ptg_speedtest_e) ? $v->_ptg_speedtest_e:"";
                            $_ptg_speedtest_f = isset($v->_ptg_speedtest_f) ? $v->_ptg_speedtest_f:"";
                            $_ptg_speedtest_a1 = isset($v->_ptg_speedtest_a1) ? $v->_ptg_speedtest_a1:"";
                            $_ptg_speedtest_b1 = isset($v->_ptg_speedtest_b1) ? $v->_ptg_speedtest_b1:"";
                            $_ptg_speedtest_c1 = isset($v->_ptg_speedtest_c1) ? $v->_ptg_speedtest_c1:"";
                            $_ptg_speedtest_d1 = isset($v->_ptg_speedtest_d1) ? $v->_ptg_speedtest_d1:"";
                            $_ptg_speedtest_e1 = isset($v->_ptg_speedtest_e1) ? $v->_ptg_speedtest_e1:"";
                            $_ptg_speedtest_f1 = isset($v->_ptg_speedtest_f1) ? $v->_ptg_speedtest_f1:"";

                            $daily_DPTG_DIRECT_FEED[] = array($i, floatval($_ptg_speedtest_f));
                            $daily_DPTG_ZOOM_A[] = array($i, floatval($_ptg_speedtest_a));
                            $daily_DPTG_ZOOM_B[] = array($i, floatval($_ptg_speedtest_b));
                            $daily_DPTG_ZOOM_C[] = array($i, floatval($_ptg_speedtest_c));
                            $daily_DPTG_SUPER_ZOOM_A[] = array($i, floatval($_ptg_speedtest_d));
                            $daily_DPTG_SUPER_ZOOM_B[] = array($i, floatval($_ptg_speedtest_e));
                            $daily_UPTG_DIRECT_FEED[] = array($i, floatval($_ptg_speedtest_f1));
                            $daily_UPTG_ZOOM_A[] = array($i, floatval($_ptg_speedtest_a1));
                            $daily_UPTG_ZOOM_B[] = array($i, floatval($_ptg_speedtest_b1));
                            $daily_UPTG_ZOOM_C[] = array($i, floatval($_ptg_speedtest_c1));
                            $daily_UPTG_SUPER_ZOOM_A[] = array($i, floatval($_ptg_speedtest_d1));
                            $daily_UPTG_SUPER_ZOOM_B[] = array($i, floatval($_ptg_speedtest_e1));
                        }
                    }
                }
            }
        }
    }
}

$stats_daily_DPG_DIRECT_FEED = json_encode($daily_DPG_DIRECT_FEED);
$stats_daily_DPG_ZOOM_A = json_encode($daily_DPG_ZOOM_A);
$stats_daily_DPG_ZOOM_B = json_encode($daily_DPG_ZOOM_B);
$stats_daily_DPG_ZOOM_C = json_encode($daily_DPG_ZOOM_C);
$stats_daily_DPG_SUPER_ZOOM_A = json_encode($daily_DPG_SUPER_ZOOM_A);
$stats_daily_DPG_SUPER_ZOOM_B = json_encode($daily_DPG_SUPER_ZOOM_B);
$stats_daily_DPTG_DIRECT_FEED = json_encode($daily_DPTG_DIRECT_FEED);
$stats_daily_DPTG_ZOOM_A = json_encode($daily_DPTG_ZOOM_A);
$stats_daily_DPTG_ZOOM_B = json_encode($daily_DPTG_ZOOM_B);
$stats_daily_DPTG_ZOOM_C = json_encode($daily_DPTG_ZOOM_C);
$stats_daily_DPTG_SUPER_ZOOM_A = json_encode($daily_DPTG_SUPER_ZOOM_A);
$stats_daily_DPTG_SUPER_ZOOM_B = json_encode($daily_DPTG_SUPER_ZOOM_B);

$stats_daily_UPG_DIRECT_FEED = json_encode($daily_UPG_DIRECT_FEED);
$stats_daily_UPG_ZOOM_A = json_encode($daily_UPG_ZOOM_A);
$stats_daily_UPG_ZOOM_B = json_encode($daily_UPG_ZOOM_B);
$stats_daily_UPG_ZOOM_C = json_encode($daily_UPG_ZOOM_C);
$stats_daily_UPG_SUPER_ZOOM_A = json_encode($daily_UPG_SUPER_ZOOM_A);
$stats_daily_UPG_SUPER_ZOOM_B = json_encode($daily_UPG_SUPER_ZOOM_B);
$stats_daily_UPTG_DIRECT_FEED = json_encode($daily_UPTG_DIRECT_FEED);
$stats_daily_UPTG_ZOOM_A = json_encode($daily_UPTG_ZOOM_A);
$stats_daily_UPTG_ZOOM_B = json_encode($daily_UPTG_ZOOM_B);
$stats_daily_UPTG_ZOOM_C = json_encode($daily_UPTG_ZOOM_C);
$stats_daily_UPTG_SUPER_ZOOM_A = json_encode($daily_UPTG_SUPER_ZOOM_A);
$stats_daily_UPTG_SUPER_ZOOM_B = json_encode($daily_UPTG_SUPER_ZOOM_B);

?>

var DPG_StatDaily = [
    {label: "DIRECT FEED", data: {{ $stats_daily_DPG_DIRECT_FEED }} },
    {label: "ZOOM-A", data: {{ $stats_daily_DPG_ZOOM_A }} },
    {label: "ZOOM-B", data: {{ $stats_daily_DPG_ZOOM_B }} },
    {label: "ZOOM-C", data: {{ $stats_daily_DPG_ZOOM_C }} },
    {label: "SUPER ZOOM (A)", data: {{ $stats_daily_DPG_SUPER_ZOOM_A }} },
    {label: "SUPER ZOOM (B)", data: {{ $stats_daily_DPG_SUPER_ZOOM_B }} },
];
var DPTG_StatDaily = [
    {label: "DIRECT FEED", data: {{ $stats_daily_DPTG_DIRECT_FEED }} },
    {label: "ZOOM-A", data: {{ $stats_daily_DPTG_ZOOM_A }} },
    {label: "ZOOM-B", data: {{ $stats_daily_DPTG_ZOOM_B }} },
    {label: "ZOOM-C", data: {{ $stats_daily_DPTG_ZOOM_C }} },
    {label: "SUPER ZOOM (A)", data: {{ $stats_daily_DPTG_SUPER_ZOOM_A }} },
    {label: "SUPER ZOOM (B)", data: {{ $stats_daily_DPTG_SUPER_ZOOM_B }} },
];
var UPG_StatDaily = [
    {label: "DIRECT FEED", data: {{ $stats_daily_UPG_DIRECT_FEED }} },
    {label: "ZOOM-A", data: {{ $stats_daily_UPG_ZOOM_A }} },
    {label: "ZOOM-B", data: {{ $stats_daily_UPG_ZOOM_B }} },
    {label: "ZOOM-C", data: {{ $stats_daily_UPG_ZOOM_C }} },
    {label: "SUPER ZOOM (A)", data: {{ $stats_daily_UPG_SUPER_ZOOM_A }} },
    {label: "SUPER ZOOM (B)", data: {{ $stats_daily_UPG_SUPER_ZOOM_B }} },
];
var UPTG_StatDaily = [
    {label: "DIRECT FEED", data: {{ $stats_daily_UPTG_DIRECT_FEED }} },
    {label: "ZOOM-A", data: {{ $stats_daily_UPTG_ZOOM_A }} },
    {label: "ZOOM-B", data: {{ $stats_daily_UPTG_ZOOM_B }} },
    {label: "ZOOM-C", data: {{ $stats_daily_UPTG_ZOOM_C }} },
    {label: "SUPER ZOOM (A)", data: {{ $stats_daily_UPTG_SUPER_ZOOM_A }} },
    {label: "SUPER ZOOM (B)", data: {{ $stats_daily_UPTG_SUPER_ZOOM_B }} },
];

"use strict";

var choiceContainer_DPG = $("#DPG_Toggle");
var choiceContainer_DPTG = $("#DPTG_Toggle");
var choiceContainer_UPG = $("#UPG_Toggle");
var choiceContainer_UPTG = $("#UPTG_Toggle");
var i = 0;

$.each(DPG_StatDaily, function(key, val) {
    val.color = i; i++;
    //"&nbsp;<input type='checkbox' name='" + key + "' checked='checked' id='dpg_id_" + key + "'></input> <label for='dpg_id_" + key + "'>" + val.label + "</label> &nbsp;"
    choiceContainer_DPG.append("&nbsp;<label class='css-input css-checkbox css-checkbox-sm css-checkbox-rounded css-checkbox-primary'><input type='checkbox' name='"+key+"' id='dpg_id_"+key+"' checked='checked'><span></span>"+val.label+"</label> &nbsp;");
});
i = 0; 
$.each(DPTG_StatDaily, function(key, val) {
    val.color = i; i++;
    choiceContainer_DPTG.append("&nbsp;<label class='css-input css-checkbox css-checkbox-sm css-checkbox-rounded css-checkbox-primary'><input type='checkbox' name='"+key+"' id='dptg_id_"+key+"' checked='checked'><span></span>"+val.label+"</label> &nbsp;");
});
i = 0; 
$.each(UPG_StatDaily, function(key, val) {
    val.color = i; i++;
    choiceContainer_UPG.append("&nbsp;<label class='css-input css-checkbox css-checkbox-sm css-checkbox-rounded css-checkbox-primary'><input type='checkbox' name='"+key+"' id='upg_id_"+key+"' checked='checked'><span></span>"+val.label+"</label> &nbsp;");
});
i = 0; 
$.each(UPTG_StatDaily, function(key, val) {
    val.color = i; i++;
    choiceContainer_UPTG.append("&nbsp;<label class='css-input css-checkbox css-checkbox-sm css-checkbox-rounded css-checkbox-primary'><input type='checkbox' name='"+key+"' id='uptg_id_"+key+"' checked='checked'><span></span>"+val.label+"</label> &nbsp;");
});

plotAccordingToChoices('DPG',DPG_StatDaily);
plotAccordingToChoices('DPTG',DPTG_StatDaily);
plotAccordingToChoices('UPG',UPG_StatDaily);
plotAccordingToChoices('UPTG',UPTG_StatDaily);

choiceContainer_DPG.find("input").click(function(){ plotAccordingToChoices('DPG',DPG_StatDaily) });
choiceContainer_DPTG.find("input").click(function(){ plotAccordingToChoices('DPTG',DPTG_StatDaily) });
choiceContainer_UPG.find("input").click(function(){ plotAccordingToChoices('UPG',UPG_StatDaily) });
choiceContainer_UPTG.find("input").click(function(){ plotAccordingToChoices('UPTG',UPTG_StatDaily) });

function plotAccordingToChoices(Div,datasets) {
    var data = [];

    $('#'+Div+'_Toggle').find("input:checked").each(function()
    {
        var key = $(this).attr("name");
        if (key && datasets[key]) {
            data.push(datasets[key]);
        }
    });

    if (data.length > 0)
    {
        var p = $.plot('#' + Div + '_DailyChart', data, {
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
                container: '#'+Div+'_DC_Legend',
                noColumns: 5
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
                tickDecimals: 0
            },

            axisLabels: {
                show: true
            },
            xaxes: [{
                axisLabel: 'HARIBULAN',
            }],
            yaxes: [{
                position: 'left',
                axisLabel: 'KELAJUAN INTERNET (Mbps)',
                axisLabelPadding: 5,
            }, {
                position: 'right',
                axisLabel: 'bleem'
            }]
        });

        var DataDaily = null;
        jQuery("#" + Div + "_DailyChart").bind("plothover",function(event,pos,item)
        {
            if (item)
            {
                if (DataDaily != item.dataIndex)
                {
                    DataDaily = item.dataIndex;           
                    jQuery("#tooltip").remove();
                    var x = item.datapoint[0],y = item.datapoint[1];
                    showTooltip(item.pageX, item.pageY, y);
                }
            } else {
                jQuery("#tooltip").remove();
                DataDaily = null;
            }
        });

        for (z=0; z < data.length; z++)
        {
            $.each(p.getData()[z].data, function(i, el){
                var o = p.pointOffset({x: el[0], y: el[1]});
                if (el[1] != 0)
                {
                    $('<div class="data-point-label">' + el[1] + '</div>').css({
                        position: 'absolute',
                        left: o.left + 8,
                        top: o.top - 12,
                        display: 'none'
                    }).appendTo(p.getPlaceholder()).show();
                }
            });
        }
    }
}

function showTooltip(x, y, contents) {
    jQuery('<div id="tooltip" class="tooltipflot"><span class="h5">' + contents + ' Mbps</span></div>').css({
        position: 'absolute',
        display: 'none',
        top: y + 5,
        left: x + 5
    }).appendTo("body").fadeIn(200);
}
@endsection

@section('js')
<script src="/assets/js/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="/assets/js/plugins/easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="/assets/js/plugins/chartjs/Chart.min.js"></script>
<script src="/assets/js/plugins/flot/jquery.flot.min.js"></script>
<script src="/assets/js/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="/assets/js/plugins/flot/jquery.flot.stack.min.js"></script>
<script src="/assets/js/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="/assets/js/plugins/flot/jquery.flot.spline.min.js"></script>
<script src="/assets/js/plugins/flot/jquery.flot.axislabels.js"></script>
@endsection

@section('content')
<!-- Menu -->
<div class="content content-mini bg-white border-b">
    <div class="push-15 text-center">
        <p>
            LAPORAN BULANAN KELAJUAN INTERNET 1BESTARINET BAGI BULAN<br>
            <b>{{ strtoupper($bulan_tahun) }}</b> - <b>{{ $nama_sekolah }}</b>
        </p>
    </div>
</div>
<!-- END Menu -->

<div class="content content-mini">
    <div class="row">
        <div class="col-xs-12 push">
            <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                <i class="fa fa-print push-5-r"></i> Cetak
            </button>
        </div>
        <div class="col-xs-12">
            <div class="block block-bordered">
                <div class="block-header bg-gray-lighter">
                    <h3>
                        <i class="fa fa-line-chart push-10-r"></i><b>DOWNLOAD - PAGI</b>
                        <div id="DPG_Toggle" class="pull-right"></div>
                    </h3>
                </div>
                <div class="block-content block-content-full">
                    <div id="DPG_DC_Legend" class="flotLegend"></div>
                    <div id="DPG_DailyChart" class="flotGraph"></div>
                </div>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="block block-bordered">
                <div class="block-header bg-gray-lighter">
                    <h3>
                        <i class="fa fa-line-chart push-10-r"></i><b>DOWNLOAD - PETANG</b>
                        <div id="DPTG_Toggle" class="pull-right"></div>
                    </h3>
                </div>
                <div class="block-content block-content-full">
                    <div id="DPTG_DC_Legend" class="flotLegend"></div>
                    <div id="DPTG_DailyChart" class="flotGraph"></div>
                </div>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="block block-bordered">
                <div class="block-header bg-gray-lighter">
                    <h3>
                        <i class="fa fa-line-chart push-10-r"></i><b>UPLOAD - PAGI</b>
                        <div id="UPG_Toggle" class="pull-right"></div>
                    </h3>
                </div>
                <div class="block-content block-content-full">
                    <div id="UPG_DC_Legend" class="flotLegend"></div>
                    <div id="UPG_DailyChart" class="flotGraph"></div>
                </div>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="block block-bordered">
                <div class="block-header bg-gray-lighter">
                    <h3>
                        <i class="fa fa-line-chart push-10-r"></i><b>UPLOAD - PETANG</b>
                        <div id="UPTG_Toggle" class="pull-right"></div>
                    </h3>
                </div>
                <div class="block-content block-content-full">
                    <div id="UPTG_DC_Legend" class="flotLegend"></div>
                    <div id="UPTG_DailyChart" class="flotGraph"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
