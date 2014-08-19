<style type="text/css">
*{
font-family: Arial;
margin:0px;
padding:0px;
}
@page {
 margin-left:3cm 2cm 2cm 2cm;
}
table.grid{
width:29.7cm ;
font-size: 12px;
border-collapse:collapse;
}
table.grid th{
	padding:5px;
}
table.grid th{
background: #F0F0F0;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
text-align:center;
border:1px solid #000;
}
table.grid tr td{
	padding:2px;
	border-bottom:0.2mm solid #000;
	border:1px solid #000;
}
h1{
font-size: 18px;
}
h2{
font-size: 14px;
}
h3{
font-size: 12px;
}
p {
font-size: 10px;
}
center {
	padding:8px;
}
.atas{
display: block;
width:29.7cm ;
margin:0px;
padding:0px;
}
.kanan tr td{
	font-size:12px;
}
.attr{
font-size:9pt;
width: 100%;
padding-top:2pt;
padding-bottom:2pt;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
}
.pagebreak {
width:29.7cm ;
page-break-after: always;
margin-bottom:10px;
}
.akhir {
width:29.7cm ;
font-size:13px;
}
.page {
width:29.7cm ;
font-size:12px;
padding:10px;
}
table.footer{
width:29.7cm ;
font-size: 12px;
border-collapse:collapse;
}
</style>


<?php

$kiri = '<h1>'.$instansi.'</h1>';
$kiri .= '<p>'.$alamat_instansi.'</p> <br>'
        . '<br>'
        . '<br>'
        . '<br>'
        . '<table >'
        . '<tr>'
        . '<td ><h5>Nama  </h5> </td>'
        . '<td ><h5>:&nbsp'.$nama_siswa.'</h5></td>'
        
        . '</tr>'
        . '<tr>'
        . '<td  ><h5>Nis </h5> </td>'
        . '<td ><h5>:&nbsp'.$nis_siswa.'</h5></td>'
        . '</tr>'
         . '<tr>'
        . '<td  ><h5>Jurusan</h5> </td>'
        . '<td  ><h5>:&nbsp'.$jurusan.'</h5></td>'
        . '</tr>'
        . '</table>';
        


$kanan = "<table class='kanan' width='100%'>
		  <tr>
		  	
			<td ><h2>$judul $siswa_smstr</h2></td>
                            <tr>
			<td><h2>&nbsp &nbsp &nbspTAHUN AJARAN $thn_ajaran</h2></td>
                            </tr>
                            <tr>
                            <td></td>
                            </tr>
                            <tr>
                            
                            </tr>
		  </tr>
		  </table>";
function myheader($kiri,$kanan,$judul){
?>

<div class="atas">
<table width="70%">
<tr>
	<td width="60%" valign="top">
   		<?php echo $kiri;?>
    </td>
    
	
    <td width="100%" valign="center">
    	<?php echo $kanan;?>
        
    </td>
<td width="100%" valign="right">

    </td>

</tr>    
</table>


</div>
		

<table class="grid" width="100%">
	<tr>
    	<th width="20">No</th>
        
        <th width="100">MAPEL</th>
        
        
        <th width="50">KKM</th>
        
        <th width="50" >Nilai Rata-Rata</th>
        <th width="50">Ketuntasan</th>
	</tr>   
        
<?php
}
function myfooter(){	
	echo "</table>";
}
	$g_total=0;
        $rata=0;
	$no=1;
	$page =1;
	foreach($data->result_array() as $r){
	$total = '';
	
	if(($no%25) == 1){
   	if($no > 1){
        myfooter();
        echo "<div class=\"pagebreak\" align='right'>
		<div class='page' align='center'>Hal - $page</div>
		</div>";
		$page++;
  	}
   	myheader($kiri,$kanan,$judul);
	}
	?>
        
      
    <tr>
    	<td align="center" width="10"><?php echo $no; ?></td>
            
            <td align="center" width="50" ><?php echo $r['mapel']; ?></td>
           
            
            <td align="center" width="10" ><?php echo $r['kkm']; ?></td>
           
            
            <?php $total= $r['harian']+$r['uts']+$r['uas'];
                    $nil=  round($total/3,2);
            $kkm =$r['kkm'];
            ?>
            <td align="center" width="10" ><?php echo $nil; ?></td>
            <?php 
               if($nil > $kkm){
                   $tuntas="Tuntas";
               }  else {
                   $tuntas="Tidak";
               }
            ?>
            
            <td align="center" width="20" style="font-style:bold;"><?php echo $tuntas; ?></td>
    </tr>
    <?php
	$no++;
        
        $bagi=$no-1;
	$g_total = $g_total+$nil;
        
        $rata=  round($g_total/$bagi,2);
        
        
	}
	
myfooter();
        echo"<br>"
. "<center><table class='grid' style='width:300px; float:center;' >"
. "<tr>"
       

                . "<th>JUMLAH NILAI</th>"
                . "<td align='center'><strong>$g_total</strong></td>"
                . "</tr>"
                . "<tr>"
                . "<th>Nilai Rata-rata</th>"
                . "<td align='center'><strong>$rata</strong></td>"
                . "</tr>"
                . "</table></center>";
	echo "</table>";
      
?>
   
<div style="padding:10px"></div>
<table class="grid" style="width:300px;">
    <tr>
        <th colspan="3">Kehadiran</th>
    </tr>
    <tr>
        <td title="sakit">Sakit</td>
        <td title="Ijin">Ijin</td>
        <td title="tidak ada keterangan">Alpha</td>
        
        
    </tr>
    <tr>
        <td><?php echo $sakit_siswa;?></td>
        <td><?php echo $ijin_siswa; ?></td>
        <td><?php echo $alpha_siswa;?></td>
        
    </tr>
</table>
<br />

<table width="100%" class="footer">
<tr>
	<td width="20%"></td>
	<td width="40%" valign="top" align="center">
     
    <br /> Wali Kelas <?php echo $kelas_siswa; ?><br /><br /><br /><br /><br />
    <b><u><?php echo $this->session->userdata('nama');?></u></b>
    </td>
    <td width="20%" valign="center" align="left">
    Tangerang, <?php echo $this->mdl_raport->tgl_indo(date('Y-m-d'));?>
    <br />Kepala Sekolah<br /><?php echo $instansi; ?><br /><br /> <br /><br />
    <b><u>________________</u></b>
    </td>
</tr>
</table>    
<div class="page" align="center"></div>
