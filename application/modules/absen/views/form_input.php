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
		CariDataKelas();
	});
	function CariDataKelas(){
		var kode = $("#kd_kelas").val()
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>kelas/InfoKelas",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#kd_kelas").val(data.kd_kelas);
				$("#kelas").val(data.kelas);
				$("#thn_ajaran").val(data.thn_ajaran);
                                $("#siswa_kelas").val(data.siswa_kelas);
                                 $("#nama_siswa").val(data.nama_siswa);
				
			}
		});
	}
	$("#sakit").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
        $("#ijin").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
        $("#alpha").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
        $("#lambat").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
        $("#dispensasi").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
        
	$("#nis").focus();
	$("#nis").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});
	$("#nis").focus(function(e){
		var isi = $(e.target).val();
		//CariSiswa();
	});
	
	$("#nis").keyup(function(){
		//CariSiswa();
		
	});
	
        function CariSiswa(){
		var kode = $("#nis").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>absen/InfoAbsen",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#nis").val(data.nis);
				
			}
		});
	};
        $("#text_cari").keyup(function(){
		AmbilDaftarSiswa();
		//$("#dlg").dialog('open');
	});
        $("#cari_siswa").click(function(){
		AmbilDaftarSiswa();
		$("#dlg").dialog('open');
	});
        
        function AmbilDaftarSiswa(){
		var cari = $("#text_cari").val();
		var kls = $("#kd_kls").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>absen/DataSiswa/"+kls,
			data	: "cari="+cari,
			cache	: false,
			success	: function(data){
				$("#daftar_siswa").html(data);
			}
		});
	}
        
	
	$("#simpan").click(function(){
                                var kd_kls= $("#kd_kls").val();
                                var nis= $("#nis").val();
                                var semester=$("semester").val();
                                var sakit= $("#sakit").val();
			        var ijin=$("#ijin").val();
				var alpha=$("#alpha").val();
                                
                                
                                var string = $("#form").serialize();
		
		
                
		if(nis.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, NIS dan Nama Siswa tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#nis").focus();
			return false();
		}
               
                 if(sakit.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, data tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#sakit").focus();
			return false();
		}
                
                 if(ijin.length===0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, data tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#ijin").focus();
			return false();
		}
                 if(alpha.length===0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, data tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#alpha").focus();
			return false();
		}
                 
                
                
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>absen/simpan",
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
<table width="50%">
<tr>    
	<td>KELAS</td>
    <td width="5">:</td>
    <td><input type="text" name="kd_kls" id="kd_kls" class="easyui-validatebox" 
               size="20" maxlength="20" readonly="readonly" data-options="required:true,validType:'length[3,30]'"
               data-options="required:true,validType:'length[0,5]'" 
               value="<?php echo $this->uri->segment(3);  ?>" /></td>
</tr>

<tr>    
	<td>NIS SISWA</td>
    <td>:</td>
    <td><input type="text" name="nis" id="nis"  size="30" maxlength="50" class="easyui-validatebox" data-options="required:true,validType:'length[3,30]'"  readonly="readonly" value=""/>
    <button type="button" name="cari_siswa" id="cari_siswa" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button></td>
</tr> 

<tr>    
	<td>SEMESTER</td>
    <td width="5">:</td>
    <td><input type="text" name="semester" id="semester" readonly="readonly"
               size="20" maxlength="5" class="easyui-validatebox" 
               data-options="required:true,validType:'length[1,1]'" 
               value="<?php echo $semester; ?>" /></td>
</tr>
    
<tr>    
	<td>SAKIT</td>
    <td width="5">:</td>
    <td><input type="text" name="sakit" id="sakit" 
               size="20" maxlength="5" class="easyui-validatebox" 
               data-options="required:true,validType:'length[0,2]'" 
               value="" /></td>
</tr>
<tr>    
	<td>IJIN</td>
    <td>:</td>
    <td><input type="text" name="ijin" id="ijin"  
               size="20" maxlength="5" class="easyui-validatebox" 
               data-options="required:true,validType:'length[0,2]'" 
               alue=""/></td>
</tr>
<tr>    
	<td>ALPHA</td>
    <td>:</td>
    <td><input type="text" name="alpha" id="alpha"  
               size="20" maxlength="5" class="easyui-validatebox" 
               data-options="required:true,validType:'length[0,2]'" 
               value=""/></td>
</tr>




</table>
</fieldset>
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
      <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" 
              data-options="iconCls:'icon-save'">SIMPAN</button>
    
            <a href="<?php echo $base_url; ?>/<?php echo $this->uri->segment(3);?>">
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </a>
    </td>
</tr>
</table>  
</fieldset>   
</form>
<fieldset>
<div id="tampil_data"></div>
</fieldset>
<div id="dlg" class="easyui-dialog" title="Daftar Siswa" style="width:900px;height:400px; padding:5px;" data-options="closed:true">
	Cari : <input type="text" name="text_cari" id="text_cari" size="50" />
	<div id="daftar_siswa"></div>
</div>