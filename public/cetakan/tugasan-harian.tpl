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
<div class="footer">Tarikh : #TARIKH_SEMAKAN# &nbsp; &nbsp; Halaman #<span class="pagenum"></span></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
    <h2>
    LOG TUGASAN & SENARAI SEMAK HARIAN JURUTEKNIK KOMPUTER<br />
    #NAMA_SEKOLAH#</h2></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td width="150">Nama Juruteknik:</td>
    <td><strong>#NAMA_JURUTEKNIK#</strong></td>
  </tr>
  <tr>
    <td>Tarikh & Masa Semakan:</td>
    <td><strong>#TARIKH_SEMAKAN#</strong></td>
  </tr>
  <tr>
    <td colspan="2" height="2"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="5" bgcolor="#333333">
  <tr class="font14-white">
    <td align="left" bgcolor="#004070" colspan="5">SENARAI SEMAK HARIAN</td>
  </tr>
  <tr class="font14-white">
    <td align="center" bgcolor="#1d79d5">BIL</td>
    <td bgcolor="#1d79d5" class="font11">PERKARA</td>
    <td bgcolor="#1d79d5">CARA PENGUJIAN</td>
    <td align="center" bgcolor="#1d79d5">STATUS SEMAKAN</td>
    <td align="center" bgcolor="#1d79d5">CATATAN</td>
  </tr>
  #DATA#
</table>

<table style="page-break-before: always;" width="100%" border="0" cellspacing="1" cellpadding="5" bgcolor="#333333">
  <tr class="font14-white">
    <td align="left" bgcolor="#004070" colspan="5">TUGASAN HARIAN</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" align="left" colspan="5">#TUGASAN_HARIAN#</td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="10"></td>
      </tr>
      <tr>
        <td>Disediakan Oleh :</td>
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
    <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="10"></td>
      </tr>
      <tr>
        <td>Disemak Oleh :</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="100%" align="left" valign="top">#DATA_SEMAK#</td>
  </tr>
</table>