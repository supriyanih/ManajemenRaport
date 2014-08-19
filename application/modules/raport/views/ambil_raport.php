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
	$("#dlg1").dialog('close');
	$("#nis").val(id);
	$("#nis").focus();
	
}
</script>

<a href="<?php echo base_url();?>raport/download_excel/<?php echo $kls; ?>/<?php echo $nis; ?>/<?php echo $semester; ?>">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-print'">EXCELL</button>
</a>
<a href="<?php echo base_url();?>raport/cetak/<?php echo $kls; ?>/<?php echo $nis; ?>/<?php echo $semester; ?>">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-print'">PRINT</button>
</a>

<table id="dataTable" class="detail" width="100%">
<tr>
	<th>No</th>
    <th>NIS</th>
    <th>Nama</th>
    <th>SMTR</th>
    <th>MAPEL</th>
    <th>KKM</th>
    <th>HARIAN</th>
    <th>UTS</th>
    <th>UAS</th>
    <th>Nilai Akhir</th>
    <th>Tuntas</th>
    
    
</tr>
<?php
	if($data->num_rows()>0){
            $total=0;
            $kkm=0;
		$no =1;
		foreach($data->result_array() as $db){  
		
		?>    
    	<tr>
	    <td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="20" ><?php echo $db['nis']; ?></td>
            <td align="center" width="20" ><?php echo $db['nama']; ?></td>
            <td align="center" width="20" ><?php echo $db['semester']; ?></td>
            <td align="center" width="40" ><?php echo $db['mapel']; ?></td>
            <td align="center" width="20" ><?php echo $db['kkm']; ?></td>
            <td align="center" width="20" ><?php echo $db['harian']; ?></td>
            <td align="center" width="20" ><?php echo $db['uts']; ?></td>
            <td align="center" width="20" ><?php echo $db['uas']; ?></td>
            
            <?php $total= $db['harian']+$db['uts']+$db['uas'];
                    $nil=$total/3;
            $kkm =$db['kkm'];
            ?>
            <td align="center" width="20" ><?php echo $nil; ?></td>
            <?php 
               if($nil > $kkm){
                   $tuntas="TUNTAS";
               }  else {
                   $tuntas="TIDAK";
               }
            ?>
            
            <td align="center" width="20" style="font-style:bold;"><?php echo $tuntas; ?></td>
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