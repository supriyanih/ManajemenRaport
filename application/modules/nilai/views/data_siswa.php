<script type="text/javascript">
$(document).ready(function(){
	$("#cari_tgl").datepicker({
			dateFormat:"dd-mm-yy"
    });
});
</script>
<?php $jadwal = $this->session->userdata('jadwal'); ?>

<div id="view" style="background-color:#cccccc">
<div style="float:left; padding-bottom:5px;">
<a href="<?php echo base_url();?>nilai/input/<?php echo $this->session->userdata('jadwal'); ?>">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>
</a>
<a href="<?php echo base_url();?>nilai/tampilNilai/<?php echo $jadwal; ?>">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>

</div>

<div id="gird" style="float:left; width:100%;">
<table id="dataTable" width="100%">
    
<tr>
    <th>NO</th>
     <th>nis</th>
    <th>nama</th>
    <th>kelas</th>
    <th>semester</th>
     <th>mapel</th>
    <th>Harian </th>
    <th>UAS </th>
    <th>UTS </th>
    
    <th>Aksi</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){ 
                 
		?>    
    	<tr>
             <td align="center" width="20" ><?php echo $no; ?></td>
            <td align="center" width="20" ><?php echo $db['nis']; ?></td>
            <td align="center" width="20" ><?php echo $db['nama']; ?></td>
            <td align="center" width="20" ><?php echo $db['kls']; ?></td>
            <td align="center" width="20" ><?php echo $db['semester']; ?></td>
            <td align="center" width="20" ><?php echo $db['mapel']; ?></td>
            <td align="center" width="20" ><?php echo $db['harian']; ?></td>
            <td align="center" width="20" ><?php echo $db['uts']; ?></td>
            <td align="center" width="20" ><?php echo $db['uas']; ?></td>
            
            <td align="center" width="50">
            <a href="<?php echo base_url();?>nilai/edit/<?php echo $db['id_nilai'];?>">
			EDIT
	    </a>
           <a href="<?php echo base_url();?>nilai/hapus/<?php echo $db['id_nilai'];?>/<?php echo $db['id_jadwal']; ?>">
			HAPUS
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
