<script type="text/javascript">
$(function() {
	$("#dataTable.detail tr:even").addClass("stripe1");
	$("#dataTable.detail tr:odd").addClass("stripe2");
	$("#dataTable.detail tr").hover(
		function() {
			$(this).toggleClass("highlight");
		},
		function() {
			$(this).toggleClass("highlight");
		}
	);
});
function pilih(id){
	$("#dlg").dialog('close');
	$("#wali_kelas").val(id);
	$("#wali_kelas").focus();
	
}
</script>
<table id="dataTable" class="detail" width="100%">
<tr>
	<th>No</th>
    <th>NIP</th>
    <th>NAMA</th>
     <th>TELPON</th>
      <th>ALAMAT</th>
    
    <th>Ambil</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1;
		foreach($data->result_array() as $db){  
		
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="100" ><?php echo $db['nip']; ?></td>
            <td align="center" width="100" ><?php echo $db['nama']; ?></td>
            <td align="center" width="80" ><?php echo $db['telpon']; ?></td>
             <td align="center" width="80" ><?php echo $db['alamat']; ?></td>
            <td align="center" width="80">
            <a href="javascript:pilih('<?php echo $db['nip'];?>')" >
        	<img src="<?php echo base_url();?>asset/images/add.png" title='Ambil'>
        	</a>
            </td>
    </tr>
    <?php
		$no++;
		}
	}else{
	?>
    	<tr>
        	<td colspan="7" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
</table>