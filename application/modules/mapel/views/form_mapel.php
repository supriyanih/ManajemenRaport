<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
	$("#ni").focus();
	$("#ni").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
		CariDataMapel();
	});
	function CariDataMapel(){
		var kode = $("#kd_mapel").val()
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>mapel/InfoMapel",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#kd_mapel").val(data.kd_mapel);
				$("#mapel").val(data.nama);
				$("#kkm").val(data.tempat);
				
			}
		});
	}
	
	
	
        
	
	$("#simpan").click(function(){
		
                                var kd_mapel = $("#kd_mapel").val();
				var mapel = $("#mapel").val();
				var kkm = $("#kkm").val();
				
                                var string = $("#form").serialize();
		
		if(kd_mapel.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kode Mapel tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#kd_mapel").focus();
			return false();
		}
		if(mapel.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Mata Pelajaran tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#mapel").focus();
			return false();
		}
		if(kkm.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, KKM tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#kkm").focus();
			return false();
		}
                
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>mapel/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				$.messager.show({
					title:'Info',
					msg:data, 
					timeout:2000,
					showType:'slide'
				});
				CariSimpanan();
			},
			error : function(xhr, teksStatus, kesalahan) {
				$.messager.show({
					title:'Info',
					msg: 'Server tidak merespon :'+kesalahan,
					timeout:2000,
					showType:'slide'
				});
			}
		});
		return false();		
	});
	
});	
</script>
<form name="form" id="form">
<fieldset class="atas">
<table width="100%">
<tr>    
	<td>Kode Mapel</td>
    <td width="5">:</td>
    <td><input type="text" name="kd_mapel" id="kd_mapel" size="12" maxlength="20" class="easyui-validatebox" data-options="required:true,validType:'length[3,20]'" value="<?php echo $kd_mapel;?>" /></td>
</tr>
<tr>    
	<td>Mata Pelajaran </td>
    <td>:</td>
    <td><input type="text" name="mapel" id="mapel"  size="50" maxlength="50" class="easyui-validatebox" data-options="required:true,validType:'length[3,30]'" value="<?php echo $mapel;?>"/></td>
</tr>
<tr>    
	<td>KKM</td>
    <td>:</td>
    <td><input type="text" name="kkm" id="kkm"  size="10" maxlength="20" class="easyui-validatebox" data-options="required:true,validType:'length[3,30]'" value="<?php echo $kkm;?>"/></td>
</tr>

</table>
</fieldset>
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="simpan" id="simpan" 
            class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    <a href="<?php echo base_url();?>mapel/tambah">
    <button type="button" name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH</button>
    </a>
    <a href="<?php echo base_url();?>mapel">
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </a>
    </td>
</tr>
</table>  
</fieldset>   
</form>