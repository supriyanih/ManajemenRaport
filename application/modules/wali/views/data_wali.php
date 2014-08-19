<script type="text/javascript">
$(document).ready(function(){
	$("#cari_tgl").datepicker({
			dateFormat:"dd-mm-yy"
    });
});
</script>


<div id="view" style="background-color:#99FFCC">
    <h4>DAFTAR KELAS</h4>
<div id="gird" style="float:left; width:100%;">
<table id="dataTable" width="100%">
    
<tr>
    <th>NO</th>
     <th>KD</th>
    <th>KELAS</th>
    <th>TAHUN</th>
    <th>WAlI KELAS</th>
    <th>STATUS </th>
    <th>AKSI </th>
    
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){ 
                 
		?>    
    	<tr>
             <td align="center" width="50" ><?php echo $no; ?></td>
            <td align="center" width="50" ><?php echo $db['kd_kelas']; ?></td>
            <td align="center" width="50" ><?php echo $db['kelas']; ?></td>
            <td align="center" width="100" ><?php echo $db['thn_ajaran']; ?></td>
            <td align="center" width="50" ><?php echo $db['wali_kelas']; ?></td>
            <td align="center" width="50" ><?php echo $db['status']; ?></td>
            
            <td align="center" width="80">
            <a href="<?php echo base_url();?>wali/menu/<?php echo $db['kd_kelas'];?>">
			MENU WALI KELAS
	    </a>
           
            </td>
    </tr>
    <?php
		$no++;
		}
	}else{
	?>
    	<tr>
        	<td colspan="11" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
</table>
<?php echo "<table align='center'><tr><td>".$paginator."</td></tr></table>"; ?>
</div>
</div>
