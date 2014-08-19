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
		CariDataAdmin();
	});
	function CariDataAdmin(){
		var kode = $("#nip").val()
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>admin/InfoAdmin",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#nip").val(data.nip);
				$("#nama").val(data.nama);
				$("#tempat").val(data.tempat);
				$("#tgl_lahir").val(data.tgl_lahir);
				$("#jenkel").val(data.jenkel);
                                $("#telpon").val(data.telpon);
                                $("#email").val(data.email);
                                $("#alamat").val(data.alamat);
                                
			}
		});
	}
	$("#nip").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
	
	
        $("#tgl_lahir").datepicker({
			dateFormat:"dd-mm-yy"
    });
        
	
	$("#simpan").click(function(){
		
                                var nip = $("#nip").val();
				var nama = $("#nama").val();
				var tempat = $("#tempat").val();
				var tgl_lahir = $("#tgl_lahir").val();
				var jenkel = $("#jenkel").val();
                                var telpon = $("#telpon").val();
                                var email = $("#email").val();
                                var alamat = $("#alamat").val();
                                var string = $("#form").serialize();
		
		if(nip.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, NIP tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#nip").focus();
			return false();
		}
		if(nama.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Nama Admin tidak boleh kosong', 
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
               
                if(telpon.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Jurusan tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#telpon").focus();
			return false();
		}
                if(email.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, email tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#email").focus();
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
                
                
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>admin/simpan",
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
	<td>NIP</td>
    <td width="5">:</td>
    <td><input type="text" name="nip" id="nip" size="30" maxlength="30" class="easyui-validatebox" data-options="required:true,validType:'length[3,20]'" value="<?php echo $nip;?>" /></td>
</tr>
<tr>    
	<td>Nama </td>
    <td>:</td>
    <td><input type="text" name="nama" id="nama"  size="50" maxlength="50" class="easyui-validatebox" data-options="required:true,validType:'length[3,30]'" value="<?php echo $nama;?>"/></td>
</tr>
<tr>    
	<td>Tempat Lahir</td>
    <td>:</td>
    <td><input type="text" name="tempat" id="tempat"  size="30" maxlength="30" class="easyui-validatebox" data-options="required:true,validType:'length[3,30]'" value="<?php echo $tempat;?>"/></td>
</tr>
<tr>    
	<td>TGL Lahir</td>
    <td>:</td>
    <td><input type="text" name="tgl_lahir" id="tgl_lahir"  size="20" maxlength="20" class="easyui-validatebox" data-options="required:true,validType:'length[4,20]'" value="<?php echo $tgl_lahir;?>" /></td>
</tr>
<tr>
    <td>Jenis Kelamin:</td>
    <td>:</td>
 <td>
   <select class="easyui-combobox" name="jenkel" id="jenkel"><option value="L">Laki-Laki</option><option value="P">Perempuan</option></select>
   
 </td>
                         
 </tr>
<tr>    
	<td>Telpon</td>
    <td>:</td>
    <td><input type="text" name="telpon" id="telpon"  size="30" maxlength="30" class="easyui-validatebox" data-options="required:true,validType:'length[10,15]'" value="<?php echo $telpon;?>"/></td>
</tr>
<tr>    
	<td>Email</td>
    <td>:</td>
    <td><input type="text" name="email" id="email"  size="50" maxlength="50" class="easyui-validatebox" data-options="required:true,validType:'length[3,50]'" value="<?php echo $email;?>"/></td>
</tr>
<tr>    
	<td>alamat</td>
    <td>:</td>
    <td><input type="text" name="alamat" id="alamat"  size="70" maxlength="70" class="easyui-validatebox" data-options="required:true,validType:'length[10,70]'" value="<?php echo $alamat;?>"/></td>
</tr>


</table>
</fieldset>
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    
    <a href="<?php echo base_url();?>admin">
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </a>
    </td>
</tr>
</table>  
</fieldset>   
</form>