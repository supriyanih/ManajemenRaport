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
		var kode = $("#kd_jurusan").val()
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>jurusan/InfoMapel",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#kd_jurusan").val(data.kd_jurusan);
				$("#jurusan").val(data.nama);
				
				
			}
		});
	}
	
	
	
        
	
	$("#simpan").click(function(){
		
                                var kd_jurusan = $("#kd_jurusan").val();
				var nama = $("#jurusan").val();
				
				
                                var string = $("#form").serialize();
		
		if(kd_jurusan.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kode Mapel tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#kd_jurusan").focus();
			return false();
		}
		if(jurusan.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Mata Pelajaran tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#jurusan").focus();
			return false();
		}
		
                
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>jurusan/simpan",
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
	<td>Kode Jurusan</td>
    <td width="5">:</td>
    <td><input type="text" name="kd_jurusan" id="kd_jurusan" size="12" maxlength="20" class="easyui-validatebox" data-options="required:true,validType:'length[3,20]'" value="<?php echo $kd_jurusan;?>" /></td>
</tr>
<tr>    
	<td>Jurusan </td>
    <td>:</td>
    <td><input type="text" name="jurusan" id="jurusan"  size="50" maxlength="50" class="easyui-validatebox" data-options="required:true,validType:'length[3,30]'" value="<?php echo $jurusan;?>"/></td>
</tr>


</table>
</fieldset>
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    
    <a href="<?php echo base_url();?>jurusan">
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </a>
    </td>
</tr>
</table>  
</fieldset>   
</form>