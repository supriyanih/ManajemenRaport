<script type="text/javascript">
$(document).ready(function(){
	$("#cari_tgl").datepicker({
			dateFormat:"dd-mm-yy"
    });
});
</script>


<div id="view" style="background-color:#cccccc">
<div style="float:left; padding-bottom:5px;">
    
<a href="<?php echo base_url();?>absen/input1/<?php echo $this->uri->segment(3); ?>">
    <button type="button" name="tambah" id="tambah" class="easyui-linkbutton" 
            data-options="" style="background:#009df9 "><strong>Input Absen semester I</strong></button>
</a>
<a href="<?php echo base_url();?>absen/absenGenap/<?php echo $this->uri->segment(3);  ?>">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" 
        data-options=""style="background:#CFFEF0 ">Lihat Semester II </button>
</a>

</div>

<div id="gird" style="float:left; width:100%;">
<table id="dataTable" width="100%">
    
<tr>
    <th>NO</th>
    <th title="NO INDUK SISWA">NIS</th>
     <th>NAMA</th>
    <th>KELAS</th>
    <th title="SEMESTER">SMSTR</th>
    <th title="SAKIT">S </th>
    <th title="IJIN">I </th>
    <th title="ALPHA">A </th>
    
    <th>Aksi</th>
    
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){ 
                 
		?>    
    	<tr>
             <td align="center" width="10" ><?php echo $no; ?></td>
             <td align="center" width="40" ><?php echo $db['nis']; ?></td>
              <td align="center" width="50" ><?php echo $db['nama']; ?></td>
             <td align="center" width="50" ><?php echo $db['kd_kls']; ?></td>
            <td align="center" width="10" ><?php echo $db['semester']; ?></td>
            <td align="center" width="10" ><?php echo $db['sakit']; ?></td>
            <td align="center" width="10" ><?php echo $db['ijin']; ?></td>
            <td align="center" width="10" ><?php echo $db['alpha']; ?></td>
            
            <td align="center" width="20">
            
            <a href="<?php echo base_url();?>absen/hapus/<?php echo $db['id'];?>"
            onClick="return confirm('Anda yakin ingin menghapus data ini?')">
			 <label style="color:#CC2222">hapus</label>
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
