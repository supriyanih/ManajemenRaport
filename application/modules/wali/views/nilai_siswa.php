<script type="text/javascript">
$(document).ready(function(){
	$("#cari_tgl").datepicker({
			dateFormat:"dd-mm-yy"
    });
});
</script>


<div id="view" style="background-color:#cccccc">
<div style="float:left; padding-bottom:5px;">
    
<a href="<?php echo base_url();?>wali/nilaiGanjil/<?php echo $this->uri->segment(3); ?>">
    <button type="button" name="tambah" id="tambah" class="easyui-linkbutton" 
            data-options="" style="background:#CFFEF0 "><strong>SEMESTER I </strong></button>
</a>
<a href="<?php echo base_url();?>wali/nilaiGenap/<?php echo $this->uri->segment(3);  ?>">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" 
        data-options=""style="background:#CFFEF0 "><strong>SEMESTER II </strong></button>
</a>

</div>

<div id="gird" style="float:left; width:100%;">
<table id="dataTable" width="100%">
    
<tr>
    <th>NO</th>
    <th>NIS</th>
     <th>NAMA</th>
    <th>MAPEL</th>
    <th>SMSTR</th>
    <th>Harian </th>
    <th>UAS </th>
    <th>UTS </th>
    
    
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
             <td align="center" width="50" ><?php echo $db['mapel']; ?></td>
            <td align="center" width="10" ><?php echo $db['semester']; ?></td>
            <td align="center" width="10" ><?php echo $db['harian']; ?></td>
            <td align="center" width="10" ><?php echo $db['uts']; ?></td>
            <td align="center" width="10" ><?php echo $db['uas']; ?></td>
            
            
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
