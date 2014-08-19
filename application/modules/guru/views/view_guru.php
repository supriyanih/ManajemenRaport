<script type="text/javascript">
$(document).ready(function(){
	$("#cari_tgl").datepicker({
			dateFormat:"dd-mm-yy"
    });
});
</script>
<div id="view" style="background-color:#cccccc">
<div style="float:left; padding-bottom:5px;">
<a href="<?php echo base_url();?>guru/tambah">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>
</a>
<a href="<?php echo base_url();?>guru">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>

</div>
<div style="float:left; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>guru">
Cari NIP & Nama  : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<div id="gird" style="float:left; width:100%;">
<table id="dataTable" width="100%">
<tr>
    <th>No</th>
    <th>NIP</th>
    <th>Nama </th>
    <th>TTL</th>
    <th>Gender</th>
    <th>telpon</th>
    <th>email</th>
    <th>Alamat</th>
    <th>Aksi</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){ 
                    $tgl = $this->mdl_guru->tgl_indo($db['tgl_lahir']);
		?>    
    	<tr>
            <td align="center" width="20"><?php echo $no; ?></td>
	    <td align="center" width="100"><?php echo $db['nip']; ?></td>
            <td align="center" width="100" ><?php echo $db['nama']; ?></td>
            <td align="center" width="100" ><?php echo $db['tempat']; ?>,<?php echo $tgl; ?></td>
            <td align="center" width="20"><?php echo $db['jenkel']; ?></td>
            <td align="center" width="80" ><?php echo $db['telpon']; ?></td>
            <td align="center" width="80" ><?php echo $db['email']; ?></td>
            <td align="center" width="80" ><?php echo $db['alamat']; ?></td>
            
            
            <td align="center" width="80">
            <a href="<?php echo base_url();?>guru/edit/<?php echo $db['nip'];?>">
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>guru/hapus/<?php echo $db['nip'];?>"
            onClick="return confirm('Anda yakin ingin menghapus data ini?')">
			<img src="<?php echo base_url();?>asset/images/del.png" title='Hapus'>
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
