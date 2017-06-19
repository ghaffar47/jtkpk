/* Ajax */
function Ajx(ajax){ ajax.method = "POST"; ajax.setVar('_token', Laravel.csrfToken); ajax.onCompletion = function(){ var text = ajax.response; eval(text);}; ajax.runAJAX();}

function OpenWindow(theURL,winName,features) {
    window.open(theURL,winName,features);
}
function jump(targ,selObj,restore){
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

/* Remove File */
function RemoveFile(filename) {
    var ajax = new sack();
    ajax.requestFile = "/dev-team/projek/padam-kertas-kerja/" + filename;
    Ajx(ajax);
}

/* Sweet Alert & Notifications */
function Notify(type,msg,pos,time_delay) {
    var tpos, pos_from, pos_align, adelay, aicn;

    if (typeof(time_delay)==='undefined' || time_delay === null || time_delay == '') {
        adelay = 2000;
    } else {
        adelay = time_delay;
    }

    if (typeof(pos) !== 'undefined') {
        tpos = pos.split('-');
        pos_from = tpos[0];
        pos_align = tpos[1];
    } else {
        pos_from = 'top';
        post_align= 'right';
    }

    if (type == 'danger' || type == 'error') {
        aicn = 'fa fa-times-circle';
    } else if (type == 'warning') {
        aicn = 'fa fa-exclamation-triangle';
    } else if (type == 'success') {
        aicn = 'fa fa-check-circle';
    } else {
        aicn = '';
    }

    jQuery.notify({
        icon: aicn,
        message: '<span class="push-5-r"></span><span class="h6">'+msg+'</span>',
        url: ''
    },
    {
        element: 'body',
        type: type,
        allow_dismiss: true,
        newest_on_top: true,
        showProgressbar: false,
        placement: {
            from: pos_from,
            align: pos_align
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: adelay,
        timer: 1000,
        animate: {
            enter: 'animated bounceIn',
            exit: 'animated bounceOut'
        }
    });
}
function SweetAlert(mode,title,txt,func) {
    if (typeof(func)==='undefined')
    {
        if (mode == "success") {
            swal({title: title, text: txt, type: 'success', html: true});
        } else if (mode == "error" || mode == "danger") {
            swal({title: title, text: txt, type: 'error', html: true});
        } else {
            swal(txt);
        }
    }
    else
    {
        swal({
            title: title,
            text: txt,
            type: mode,
            showCancelButton: false,
            closeOnConfirm: true,
            html: true
        },function(){ eval(func); });
    }
}

/* Avatar */
function AvatarTemplate(avatar) {
    if (!avatar.id) { return avatar.text; }
    var $avatar = $(
        '<span><img src="/avatar/' + avatar.element.value.toLowerCase() + '" class="img-avatar img-avatar32 push-5-r" /> ' + avatar.text + '</span>'
    );
    return $avatar;
}

/* Pengguna */
function ClearAddUser() {
	$('#_name').val('');
	$('#_email').val('');
	$('#_pwd').val('');
	$('#_usergroups').val('').trigger('change');
	$('#_kodjpn').val('').trigger('change');
	$('#_kodppd').val('').trigger('change');
	$('#_kodsek').val('').trigger('change');
	$('#_uid').val('0');
}
function AddUserDialog() {
	ClearAddUser();
	$('#UserDialog').modal();
    setTimeout(function(){
        $('#_name').focus();
    },500);
}
function EditUser(id) {
	var ajax = new sack();
	ajax.requestFile = "/admin/users/getuser/" + id;
    Ajx(ajax);
}

/* Kumpulan DevTeam */
function ClearAddGroup() {
	$('#_kodppd').val('').trigger('change');
	$('#_name').val('');
	$('#_ketua').val('').trigger('change');
	$('#_jtk').val('').trigger('change');
	$('#_gid').val('0');
}
function AddGroupDialog() {
	$('#GroupDialog').modal();
}
function EditDevTeam(id) {
	var ajax = new sack();
	ajax.requestFile = "/dev-team/edit/" + id;
    Ajx(ajax);
}
function DeleteDevTeam(id) {
    swal({
        title: "Padam Rekod ?",
        text: "Anda pasti untuk memadam rekod ini ?",
        type: "warning",
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    },
    function()
    {
		var ajax = new sack();
		ajax.requestFile = "/dev-team/delete/" + id;
	    Ajx(ajax);
    });
}

/* Projek Kumpulan Dev Team */
function ClearAddProjek() {
    $('#_devteam').val('').trigger('change');
    $('#_nama_projek').val('');
    $('#_objektif').val('');
    $('#_detail').val('');
    $('#_repo').val('');
    $('#_projekid').val('0');
}
function AddProjekDialog() {
    $('#ProjekDialog').modal();
}
function EditProjek(id) {
    var ajax = new sack();
    ajax.requestFile = "/dev-team/projek/edit/" + id;
    Ajx(ajax);
}
function ViewProjek(id) {
    var ajax = new sack();
    ajax.requestFile = "/dev-team/projek/view/" + id;
    Ajx(ajax);
}
function DeleteProjek(id) {
    swal({
        title: "Padam Projek ?",
        text: "Anda pasti untuk memadam projek ini ?",
        type: "warning",
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    },
    function()
    {
        var ajax = new sack();
        ajax.requestFile = "/dev-team/projek/delete/" + id;
        Ajx(ajax);
    });
}
function PadamKertasKerja(pid,filename) {
    swal({
        title: "Padam Kertas Kerja Projek ?",
        text: "Anda pasti untuk memadam kertas kerja projek ini ?",
        type: "warning",
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    },
    function()
    {
        var ajax = new sack();
        ajax.requestFile = "/dev-team/projek/padam-kertas-kerja/" + filename;
        ajax.setVar('projek_id',pid);
        ajax.setVar('return_alert','1');
        Ajx(ajax);
    });
}

/* Task */
function ClearAddTask() {
    $('#_tajuk_task').val('');
    $('#_assigned').val('').trigger('change');
    $('#_detail').val('');
    $('#_taskid').val('0');
    
    var PeratusSiap = $("#_peratus_siap").data("ionRangeSlider");
    PeratusSiap.update({ from: 0, to: 0});
}
function AddTaskDialog() {
    $('#TaskDialog').modal();
    setTimeout(function(){
        $('#_tajuk_task').focus();
    },500);
}
function EditTask(taskid) {
    var ajax = new sack();
    ajax.requestFile = "/dev-team/projek/task/edit/" + taskid;
    Ajx(ajax);
}
function PadamTask(taskid) {
    swal({
        title: "Padam Task ?",
        text: "Anda pasti untuk memadam task tugasan ini ?",
        type: "warning",
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    },
    function()
    {
        var ajax = new sack();
        ajax.requestFile = "/dev-team/projek/task/delete/" + taskid;
        Ajx(ajax);
    });
}
function SaveTimeline()
{
    var progress_type = 'bg-primary';

    if ($('#_timeline').val().length == 0)
    {
        Notify('danger','Sila masukkan teks anda !');
        $('#_timeline').focus();
        return false;
    }

    $('input[name="_progress_type"]').filter(':checked').each(function(){
        progress_type = this.value;
    });

    var ajax = new sack();
    ajax.requestFile = "/dev-team/projek/task-timeline";
    ajax.setVar('task_id', $('#_task_id').val());
    ajax.setVar('peratus_siap', $('#_peratus_siap').val());
    ajax.setVar('progress_type', progress_type);
    ajax.setVar('timeline_by', $('#_timeline_by').val());
    ajax.setVar('detail', $('#_timeline').val());
    Ajx(ajax);

    $('#btn-save-timeline').attr("disabled","disabled");
}
function PadamTaskDetail(taskid) {
    swal({
        title: "Padam Rekod ?",
        text: "Anda pasti untuk memadam rekod ini ?",
        type: "warning",
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    },
    function()
    {
        var ajax = new sack();
        ajax.requestFile = "/dev-team/projek/task-detail/delete";
        ajax.setVar('task_id',taskid);
        Ajx(ajax);
    });
}

/* Kumpulan SMART Team */
function ClearSTGroup() {
    $('#_kodppd').val('').trigger('change');
    $('#_name').val('');
    $('#_ketua').val('').trigger('change');
    $('#_jtk').val('').trigger('change');
    $('#_gid').val('0');
}
function AddSTDialog() {
    ClearSTGroup();
    $('#STDialog').modal();
}
function EditSTTeam(id) {
    var ajax = new sack();
    ajax.requestFile = "/smart-team/edit/" + id;
    Ajx(ajax);
}
function DeleteSTTeam(id) {
    swal({
        title: "Padam Rekod ?",
        text: "Anda pasti untuk memadam rekod ini ?",
        type: "warning",
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    },
    function()
    {
        var ajax = new sack();
        ajax.requestFile = "/smart-team/delete/" + id;
        Ajx(ajax);
    });
}

/* Aktiviti Smart Team */
function ClearAktivitiDialog() {
    $('#_tajuk_xtvt').val('');
    $('#_sekolah_terlibat').val('').trigger('change');
    $('#_tarikh_xtvt_dari').val('');
    $('#_tarikh_xtvt_hingga').val('');
    $('#_jtk_terlibat').val('').trigger('change');
    $('#_jtk_semua').prop('checked','checked');
    $('#_jtk_adhoc').removeAttr('checked');
    $('#_jtk_terlibat').attr('disabled','disabled');
    $('#_objektif').val('');
    $('#_detail').val('');
    $('#_xtvtid').val('0');
}
function AddAktivitiDialog() {
    ClearAktivitiDialog();
    $('#AktivitiDialog').modal();
}
function EditAktiviti(id) {
    var ajax = new sack();
    ajax.requestFile = "/smart-team/aktiviti/edit/" + id;
    Ajx(ajax);
}
function PadamAktiviti(id) {
    swal({
        title: "Padam Aktiviti ?",
        text: "Anda pasti untuk memadam aktiviti ini ?",
        type: "warning",
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    },
    function()
    {
        var ajax = new sack();
        ajax.requestFile = "/smart-team/aktiviti/delete/" + id;
        Ajx(ajax);
    });
}
function PadamGambar(public_id) {
    var ajax = new sack();
    ajax.requestFile = "/smart-team/aktiviti/padam-gambar/" + public_id;
    Ajx(ajax);
}
function PadamGambarAktivitiConfirm(public_id) {
    swal({
        title: "Padam Gambar Aktiviti ?",
        text: "Anda pasti untuk memadam gambar aktiviti ini ?",
        type: "warning",
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    },
    function()
    {
        var ajax = new sack();
        ajax.requestFile = "/smart-team/aktiviti/padam-gambar/" + public_id;
        ajax.setVar('flag','1');
        Ajx(ajax);
    });    
}
/* Aktiviti Adhoc */
function ClearAktivitiAdhocDialog() {
    $('#_tajuk_xtvt').val('');
    $('#_sekolah_terlibat').val('').trigger('change');
    $('#_tarikh_xtvt_dari').val('');
    $('#_tarikh_xtvt_hingga').val('');
    $('#_jtk_terlibat').val('').trigger('change');
    $('#_jtk_semua').prop('checked','checked');
    $('#_jtk_adhoc').removeAttr('checked');
    $('#_jtk_terlibat').attr('disabled','disabled');
    $('#_objektif').val('');
    $('#_detail').val('');
    $('#_xtvtid').val('0');
}
function AddAktivitiAdhocDialog() {
    ClearAktivitiAdhocDialog();
    $('#AktivitiDialog').modal();
}
function EditAktivitiAdhoc(id) {
    var ajax = new sack();
    ajax.requestFile = "/smart-team/aktiviti/edit/" + id;
    ajax.setVar('flag','1');
    Ajx(ajax);
}
function PadamAktivitiAdhoc(id) {
    swal({
        title: "Padam Aktiviti ?",
        text: "Anda pasti untuk memadam aktiviti ini ?",
        type: "warning",
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    },
    function()
    {
        var ajax = new sack();
        ajax.requestFile = "/smart-team/aktiviti/delete/" + id;
        ajax.setVar('flag','1');
        Ajx(ajax);
    });
}

/* Tugasan Harian */

function ClearSenaraiTugasKhas() {
    $('#_tugasan').val('');
    $('#_keterangan_tugasan').val('');
    $('#_status_laporan').val('');
    $('#_id').val('0');
}
function TugasKhasDialog() {
    ClearSenaraiSemakan();
    $('#TugasKhasDialog').modal();
    setTimeout(function(){
        $('#_tugasan').focus();
    },500);
}
function EditTugasKhas(id) {
    var ajax = new sack();
    ajax.requestFile = "/edit-tugas-khas/" + id;
    Ajx(ajax);
}
function DeleteTugasKhas(id) {
    swal({
        title: "Padam ?",
        text: "Anda pasti untuk memadam rekod ini ?",
        type: "warning",
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    },
    function()
    {
        var ajax = new sack();
        ajax.requestFile = "/delete-tugas-khas/" + id;
        Ajx(ajax);
    });
}
function ClearSenaraiSemakan() {
    $('#_perkara').val('');
    $('#_cara_pengujian').val('');
    $('#_id').val('0');
    $('#_flag').val('0');
}
function TambahSemakanDialog(flag) {
    ClearSenaraiSemakan();
    $('#SenaraiSemakanDialog').modal();
    $('#_flag').val(flag);
    setTimeout(function(){
        $('#_perkara').focus();
    },500);
}
function EditSenaraiSemakan(id) {
    var ajax = new sack();
    ajax.requestFile = "/edit-senarai-semak-harian/" + id;
    Ajx(ajax);
}
function DeleteSenaraiSemakan(id) {
    swal({
        title: "Padam ?",
        text: "Anda pasti untuk memadam rekod ini ?",
        type: "warning",
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    },
    function()
    {
        var ajax = new sack();
        ajax.requestFile = "/delete-senarai-semak-harian/" + id;
        Ajx(ajax);
    });
}
function Semakan() {
    $('#SemakanDialog').modal();
    setTimeout(function(){
        $('#_speedtest_f').select();
    },500);
}
function EditTugasanHarian(id) {
    ClearSemakan();
    var ajax = new sack();
    ajax.requestFile = "/edit-tugasan-harian";
    ajax.setVar('id',id);
    Ajx(ajax);
}
function CetakTH() {
    var id = $('#_id_th').val();
    if (id == '0') {
        SweetAlert('error','Ops !',"Sila pastikan rekod anda telah disimpan dalam pangkalan data.");
    }
    else
    {        
        OpenWindow("/cetak-tugasan-harian/"+id,'CetakTH','top=10,left=10,width=700,height=500');
    }
}
function Cetak_TH(id) {
    OpenWindow("/cetak-tugasan-harian/"+id,'Cetak_TH','top=10,left=10,width=700,height=500');
}
function ViewTH(mon,year) {
    window.location.href = "/tugasan-harian/"+mon+"/"+year;
}
function ViewTK(mon,year) {
    window.location.href = "/senarai-tugas-khas/"+mon+"/"+year;
}
function PPDSemakTH(monyear) {
    swal({
        title: "Buat Semakan ?",
        text: "Anda pasti untuk membuat semakan ?",
        type: "warning",
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    },
    function()
    {
        var ajax = new sack();
        ajax.requestFile = "/ppd-semak-th";
        ajax.setVar('monyear',monyear);
        Ajx(ajax);
    });
}
function EmelTH() {
    var id = $('#_id_th').val();
    if (id == '0') {
        SweetAlert('error','Ops !',"Sila pastikan rekod anda telah disimpan dalam pangkalan data.");
    }
    else
    {        
        swal({
            title: "Hantar E-mel ?",
            text: "Anda pasti untuk menghantar e-mel tugasan harian ?",
            type: "warning",
            html: true,
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        },
        function()
        {
            var ajax = new sack();
            ajax.requestFile = "/emel-th";
            ajax.setVar('id',id);
            Ajx(ajax);
        });
    }
}

/* Aduan Kerosakan */
function AddAKP() {
    $('#AKPDialog').modal();

    var ajax = new sack();
    ajax.requestFile = "/get-latest-nosiriaduan";
    Ajx(ajax);

    setTimeout(function(){
        $('#_nama').focus();
    },500);
}
function EditAKP(id) {
    ClearAKP();
    var ajax = new sack();
    ajax.requestFile = "/edit-aduan-kerosakan";
    ajax.setVar('id',id);
    Ajx(ajax);
}
function PadamAKP(id) {
    swal({
        title: "Padam ?",
        text: "Anda pasti untuk memadam rekod ini ?",
        type: "warning",
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    },
    function()
    {
        var ajax = new sack();
        ajax.requestFile = "/delete-aduan-kerosakan";
        ajax.setVar('id',id);
        Ajx(ajax);
    });
}
function CetakAKP(id) {
    OpenWindow("/cetak-aduan-kerosakan/"+id,'CetakAKP','top=10,left=10,width=700,height=500');
}
function ViewAKP(mon,year) {
    window.location.href = "/aduan-kerosakan/"+mon+"/"+year;
}
function LaporanBulananAKP() {
    $('#LBDialog').modal();   
}
function CetakLBAKP(bulan,tahun) {
    OpenWindow("/cetak-laporan-bulanan-akp/"+bulan+"/"+tahun,'CetakLBAKP','top=10,left=10,width=700,height=500');
}
function LIDialog() {
    $('#LIDialog').modal();   
}
function CetakLI(jtk,bulan,tahun) {
    OpenWindow("/cetak-laporan-individu/"+jtk+"/"+bulan+"/"+tahun,'CetakLI','top=10,left=10,width=700,height=500');
}
function LSpeedtestDialog() {
    $('#LSpeedtestDialog').modal();   
}
function CetakLSpeedtest(jtk,bulan,tahun) {
    OpenWindow("/cetak-laporan-speedtest/"+jtk+"/"+bulan+"/"+tahun,'CetakLSpeedtest','top=10,left=10,width=700,height=500');
}