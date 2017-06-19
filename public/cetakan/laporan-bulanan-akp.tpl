<style type="text/css">
@page {
   margin-top: 0.5cm;
   margin-bottom: 1cm;
}
body,td,th {
  font-family: "Helvetica";
  font-size: 12px;
}
.font14-white {
  font-size: 14px;
  color:#FFF;
  font-weight:bold;
}
.header,
.footer {
  width: 100%;
  text-align: right;
  position: fixed;
}
.header  {
  top: 0px;
}
.footer {
  bottom: 0px;
}
.pagenum:before {
  content: counter(page);
}
</style>
<div class="footer">Halaman #<span class="pagenum"></span></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
    <h2>
    LAPORAN BULANAN ADUAN KEROSAKAN PERALATAN ICT<br />
    #NAMA_SEKOLAH#</h2></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td width="150">Nama Juruteknik :</td>
    <td><strong>#NAMA_JURUTEKNIK#</strong></td>
  </tr>
  <tr>
    <td>Bulan :</td>
    <td><strong>#BULAN#, #TAHUN#</strong></td>
  </tr>
  <tr>
    <td>Jumlah Aduan Kerosakan :</td>
    <td><strong>#JUMLAH_AKP#</strong></td>
  </tr>
  <tr>
    <td colspan="2" height="2"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="5" bgcolor="#333333">
  <tr class="font14-white">
    <td rowspan="2" align="center" bgcolor="#1d79d5">PERALATAN</td>
    <td colspan="3" align="center" bgcolor="#1d79d5" class="font11">
      PENYELENGGARAAN PEMULIHAN (CM)<br>
      <small>(BERPANDUKAN BORANG ADUAN KEROSAKAN)</small>
    </td>
    <td colspan="3" align="center" bgcolor="#1d79d5">STATUS PERALATAN</td>
  </tr>
  <tr class="font14-white">
    <td align="center" bgcolor="#1d79d5" class="font11"><p>SELESAI</p>    </td>
    <td align="center" bgcolor="#1d79d5" class="font11">TIDAK SELESAI</td>
    <td align="center" bgcolor="#1d79d5" class="font11">CATATAN</td>
    <td align="center" bgcolor="#1d79d5" class="font11">BIL BOLEH DIGUNAPAKAI</td>
    <td align="center" bgcolor="#1d79d5" class="font11">BIL ROSAK</td>
    <td align="center" bgcolor="#1d79d5" class="font11">BIL LUPUS</td>
  </tr>
  #DATA#
</table>


<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="10"></td>
      </tr>
      <tr>
        <td>Di Sediakan Oleh :</td>
      </tr>
      <tr>
        <td height="40" align="left" valign="bottom"><br />
          <br />
          <br />
          .................................................<br />
          <strong>#NAMA_JURUTEKNIK#<br />
            #JAWATAN# </strong><strong><br />
              #NAMA_SEKOLAH# </strong></td>
      </tr>
    </table></td>
  </tr>
</table>