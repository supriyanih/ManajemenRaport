<script type="text/javascript">
$(document).ready(function(){
	$("#cari_tgl").datepicker({
			dateFormat:"dd-mm-yy"
    });
});
</script>
<div id="view" style="background-color:#cccccc">

<div style="float:left; padding-bottom:5px;">

</div>
<div id="gird" style="float:left; width:100%;">
<table id="dataTable" width="100%">
<tr>
    <th>no</th>
    <th>id</th>
    <th>Mapel</th>
    <th>kelas </th>
    <th>Jurusan </th>
    <th>Pengajar</th>
    <th>Ruangan</th>
    <th>Hari</th>
    <th>Jam</th>
    
    <th>Aksi</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){ 
                   
		?>    
    	<tr>
            <td align="center" width="20"><?php echo $no; ?></td>
	    <td align="center" width="20"><?php echo $db['id']; ?></td>
            <td align="center" width="100" ><?php echo $db['mapel']; ?></td>
            <td align="center" width="80" ><?php echo $db['kelas']; ?></td>
            <td align="center" width="80" ><?php echo $db['jurusan']; ?></td>
            <td align="center" width="80" ><?php echo $db['pengajar']; ?></td>
            <td align="center" width="100"><?php echo $db['ruangan']; ?></td>
            <td align="center" width="80" ><?php echo $db['hari']; ?></td>
            <td align="center" width="100" ><?php echo $db['jam_mulai']; ?>-<?php echo $db['jam_selesai']; ?></td> 
            <td align="center" width="80">
            <a href="<?php echo base_url();?>nilai/tampilNilai/<?php echo $db['id'];?>">
                <strong>Input Nilai</strong>
			
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
