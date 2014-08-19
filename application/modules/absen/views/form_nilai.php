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
		CariDataSiswa();
	});
	function CariDataSiswa(){
		var kode = $("#nis").val()
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>siswa/InfoSiswa",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#nis").val(data.nis);
				$("#nama").val(data.nama);
				
			}
		});
	}
	$("#nis").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
	$("#telpon_wali").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
	
        $("#tgl_lahir").datepicker({
			dateFormat:"dd-mm-yy"
    });
        
	
	$("#simpan").click(function(){
		
                                var nis = $("#nis").val();
				var nama = $("#nama").val();
				
                                var string = $("#form").serialize();
		
		if(nis.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, NIS tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#nis").focus();
			return false();
		}
		if(nama.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Nama Siswa tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#nama").focus();
			return false();
		}
		if(tempat.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Tempat Lahir tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#tempat").focus();
			return false();
		}
                if(tgl_lahir.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, tgl Lahir tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#tgl_lahir").focus();
			return false();
		}
                if(jenkel.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Jenis Kelamin  tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#jenkel").focus();
			return false();
		}
                
                if(alamat.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, alamat tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#alamat").focus();
			return false();
		}
                if(thn_masuk.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, tahun masuk tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#thn_masuk").focus();
			return false();
		}
                if(wali_siswa.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, wali siswa tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#wali_siswa").focus();
			return false();
		}
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>siswa/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				$.messager.show({
					title:'Info',
					msg:data, 
					timeout:2000,
					showType:'slide'
				});
				
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
	<td>NIS</td>
    <td width="5">:</td>
    <td><input type="text" name="nis" id="nis" size="12" maxlength="20" class="easyui-validatebox" data-options="required:true,validType:'length[3,20]'" value="<?php echo $nis;?>" /></td>
</tr>
<tr>    
	<td>Nama </td>
    <td>:</td>
    <td><input type="text" name="nama" id="nama"  size="50" maxlength="50" class="easyui-validatebox" data-options="required:true,validType:'length[3,30]'" value="<?php echo $nama;?>"/></td>
</tr>

<tr>    
	<td>Semester</td>
    <td>:</td>
    <td>
        <select name="semester" id="semester" >
        <?php 
		if(empty($semester)){
		?>
       
        <?php
		}
		foreach($l_smstr->result() as $t){
			if($semester==$t->id_smstr){
		?>
        <option value="<?php echo $t->id_smstr;?>" selected="selected"><?php echo $t->id_smstr;?> </option>
        <?php }else { ?>
        <option value="<?php echo $t->id_smstr;?>"><?php echo $t->id_smstr;?> </option>
        <?php }
		} ?>
        </select>
    </td>
</tr>
<tr>    
	<td>alamat</td>
    <td>:</td>
    <td><input type="text" name="alamat" id="alamat"  
               size="50" maxlength="50" class="easyui-validatebox" 
               data-options="required:true,validType:'length[10,50]'" 
               value=""/></td>
</tr>
<tr>    
	<td>Tahun Masuk</td>
    <td>:</td>
    <td><input type="text" name="thn_masuk" id="thn_masuk"  
               size="20" maxlength="20" class="easyui-validatebox" 
               data-options="required:true,validType:'length[3,30]'" 
               value=""/></td>
</tr>
<tr>    
	<td>Wali Siswa</td>
    <td>:</td>
    <td><input type="text" name="wali_siswa" id="wali_siswa"  
               size="30" maxlength="20" class="easyui-validatebox" 
               data-options="required:true,validType:'length[3,30]'" 
               value=""/></td>
</tr>
<tr>    
	<td>Telpon Wali</td>
    <td>:</td>
    <td><input type="text" name="telpon_wali" id="telpon_wali"  
               size="20" maxlength="10" class="easyui-validatebox" 
               data-options="required:true,validType:'length[3,30]'" 
               value=""/></td>
</tr>
</table>
</fieldset>
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
   
    <a href="<?php echo base_url();?>nilai/tampilSiswa">
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </a>
    </td>
</tr>
</table>  
</fieldset>   
</form>