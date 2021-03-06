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
			url		: "<?php echo site_url(); ?>nilai/InfoNilai",
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
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>nilai/DataSiswa",
			data	: "cari="+cari,
			cache	: false,
			success	: function(data){
				$("#daftar_siswa").html(data);
			}
		});
	}
        
	
	$("#simpan").click(function(){
		
                                var nis= $("#nis").val();
                                var nis= $("#id_jadwal").val();
			        var harian=$("#harian").val();
				var uts=$("#uts").val();
                                var uas=$("#uas").val();
                                var praktek=$("#praktek").val();
                                var semester=$("semester").val();
                                var string = $("#form").serialize();
		
		
                
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>nilai/simpan",
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
	<td>Kode Jadwal</td>
    <td width="5">:</td>
    <td><input type="text" name="id_jadwal" id="id_jadwal" class="easyui-validatebox" 
               size="20" maxlength="10" readonly="readonly" data-options="required:true,validType:'length[3,30]'"
               data-options="required:true,validType:'length[0,5]'" 
               value="<?php echo $jadwal;?>" /></td>
</tr>
<tr>    
	<td>Kelas</td>
    <td width="5">:</td>
    <td><input type="text" name="harian" id="harian" readonly="readonly" 
               size="20" maxlength="5" class="easyui-validatebox" 
               data-options="required:true,validType:'length[0,5]'" 
               value="<?php echo $kelas;?>" /></td>
</tr>
<tr>    
	<td>NIP Siswa</td>
    <td>:</td>
    <td><input type="text" name="nis" id="nis"  size="30" maxlength="50" class="easyui-validatebox" data-options="required:true,validType:'length[3,30]'"  readonly="readonly" value=""/>
    <button type="button" name="cari_siswa" id="cari_siswa" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button></td>
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

</fieldset>
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
      <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" 
              data-options="iconCls:'icon-save'">SIMPAN</button>
    
    <a href="<?php echo base_url();?>nilai/tampilNilai/<?php echo $this->session->userdata('jadwal'); ?>">
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