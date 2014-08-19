<script type="text/javascript">
$(document).ready(function(){
	$("#cari_tgl").datepicker({
			dateFormat:"dd-mm-yy"
    });
});
</script>

<div id="view" style="background-color:#cccccc">
<div style="float:center; padding-bottom:5px;">

 <div id="gird" style="float:left; width:100%;">
<table id="dataTable" width="100%">
    
<tr>
    <th>
    <a href="<?php echo base_url();?>wali/nilaiGanjil/<?php echo $kd_kelas; ?>">
    LIHAT NILAI SISWA
        </a>
    </th>
    <th>
        <a href="<?php echo base_url();?>absen/absenGanjil/<?php echo $kd_kelas; ?>">
    INPUT ABSEN SISWA
        </a>
    </th>
    <th>
       <a href="<?php echo base_url();?>raport/raportSiswa/<?php echo $kd_kelas; ?>">
    RAPORT SISWA
        </a> 
    </th>
   
    
    
</tr>

</table>

</div>  
</div>


</div>
