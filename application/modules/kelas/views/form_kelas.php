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
                                $("#wali_kelas").val(data.wali_kelas);
                                 $("#nama_wali").val(data.nama_wali);
				
			}
		});
	}
	
	$("#wali_kelas").focus();
	$("#wali_kelas").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});
	$("#wali_kelas").focus(function(e){
		var isi = $(e.target).val();
		CariWali();
	});
	
	$("#wali_kelas").keyup(function(){
		CariWali();
		
	});
	
        function CariWali(){
		var kode = $("#wali_kelas").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>kelas/InfoGuru",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#nama_wali").val(data.nama_wali);
				
			}
		});
	};
        $("#text_cari").keyup(function(){
		AmbilDaftarWali();
		//$("#dlg").dialog('open');
	});
        $("#cari_wali").click(function(){
		AmbilDaftarWali();
		$("#dlg").dialog('open');
	});
        
        function AmbilDaftarWali(){
		var cari = $("#text_cari").val();
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>kelas/DataWali",
			data	: "cari="+cari,
			cache	: false,
			success	: function(data){
				$("#daftar_wali").html(data);
			}
		});
	}
        
	
	$("#simpan").click(function(){
		
                                var kd_kelas = $("#kd_kelas").val();
				var kelas = $("#kelas").val();
				var thn_ajaran = $("#thn_ajaran ").val();
				var wali_kelas = $("#wali_kelas").val();
                                
                                var string = $("#form").serialize();
		
		if(kd_kelas.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kode Kelas tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#kd_kelas").focus();
			return false();
		}
		if(kelas.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kelas tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#kelas").focus();
			return false();
		}
		if(thn_ajaran.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Tahun ajaran tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#thn_ajaran").focus();
			return false();
		}
                if(wali_kelas.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Wali Kelas tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#wali_kelas").focus();
			return false();
		}
                
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>kelas/simpan",
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
	<td>Kode Kelas</td>
    <td width="5">:</td>
    <td><input type="text" name="kd_kelas" id="kd_kelas" size="12" maxlength="20" class="easyui-validatebox" data-options="required:true,validType:'length[3,20]'" value="<?php echo $kd_kelas;?>" /></td>
</tr>
<tr>    
	<td>Kelas </td>
    <td>:</td>
    <td><input type="text" name="kelas" id="kelas"  size="50" maxlength="50" class="easyui-validatebox" data-options="required:true,validType:'length[3,30]'" value="<?php echo $kelas;?>"/></td>
</tr>
<tr>    
	<td>Tahun Ajaran</td>
    <td>:</td>
    <td><input type="text" name="thn_ajaran" id="thn_ajaran"  size="20" maxlength="20" class="easyui-validatebox" data-options="required:true,validType:'length[3,30]'" value="<?php echo $thn_ajaran;?>"/></td>
</tr>
<tr>    
	<td>NIP Wali Kelas </td>
    <td>:</td>
    <td><input type="text" name="wali_kelas" id="wali_kelas"  size="50" maxlength="50" class="easyui-validatebox" data-options="required:true,validType:'length[3,30]'" value="<?php echo $wali_kelas;?>"/>
    <button type="button" name="cari_wali" id="cari_wali" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button></td>
</tr>

</table>
</fieldset>
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    <a href="<?php echo base_url();?>kelas/tambah">
    <button type="button" name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH</button>
    </a>
    <a href="<?php echo base_url();?>kelas">
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
<div id="dlg" class="easyui-dialog" title="Daftar Wali" style="width:900px;height:400px; padding:5px;" data-options="closed:true">
	Cari : <input type="text" name="text_cari" id="text_cari" size="50" />
	<div id="daftar_wali"></div>
</div>