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
		var kode = $("#kd_kls").val()
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>kls/InfoKelas",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#kd_kls").val(data.kd_kls);
				$("#kls").val(data.kls);
				$("#thn_ajaran").val(data.thn_ajaran);
                                $("#siswa_kls").val(data.siswa_kls);
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
                                 var id= $("#id").val();
                                var nis= $("#nis").val();
                               var id_jadwal= $("#id_jadwal").val();
			        var harian=$("#harian").val();
				var uts=$("#uts").val();
                                var uas=$("#uas").val();
                                var praktek=$("#praktek").val();
                                var semester=$("semester").val();
                                
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
		if(kls.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kelas tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#kls").focus();
			return false();
		}
                if(id_jadwal.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Jadwal tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#id_jadwal").focus();
			return false();
		}
                 if(harian.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Nilai harian tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#harian").focus();
			return false();
		}
                
                 if(uts.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Nilai Ujian tengah smester tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#uts").focus();
			return false();
		}
                 if(uas.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Nilai Ujian smester tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#uas").focus();
			return false();
		}
                
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
	<td>ID </td>
    <td width="5">:</td>
    <td><input type="text" name="id" id="id" class="easyui-validatebox" 
               size="20" maxlength="10" readonly="readonly" 
               
               data-options="required:true,validType:'length[0,5]'" 
               value="<?php echo $id;?>"/></td>
</tr>
<tr>    
	<td>JADWAL </td>
    <td width="5">:</td>
    <td><input type="text" name="id_jadwal" id="id_jadwal" class="easyui-validatebox" 
               size="20" maxlength="10" readonly="readonly" 
               
               data-options="required:true,validType:'length[0,5]'" 
               value="<?php echo $id_jadwal;?>"/></td>
</tr>
<tr>    
	<td>Kelas</td>
    <td width="5">:</td>
    <td><input type="text" name="harian" id="harian" readonly="readonly" 
               size="20" maxlength="5" class="easyui-validatebox" readonly="readonly" 
               data-options="required:true,validType:'length[0,5]'" 
               value="<?php echo $kls;?>" /></td>
</tr>
<tr>    
	<td>NIS Siswa</td>
    <td>:</td>
    <td><input type="text" name="nis" id="nis"  
               size="30" maxlength="50" class="easyui-validatebox" 
               data-options="required:true,validType:'length[3,30]'"  
               readonly="readonly" value="<?php echo $nis;?>"/>
    <button type="button" name="cari_siswa" id="cari_siswa" class="easyui-linkbutton" data-options="iconCls:'icon-search '">Cari</button></td>
</tr> 

<tr>    
	<td>Semester</td>
        <td>:</td>
<td>
        <select name="semester" id="semester"  >
        <?php 
		if(empty($semester)){
		?>
       
        <?php
		}
		foreach($l_smstr->result() as $t){
			if($semester==$t->id_smstr){
		?>
        <option value="<?php echo $t->id_smstr;?>" selected="selected" ><?php echo $t->id_smstr;?>  </option>
        <?php }else { ?>
        <option value="<?php echo $t->id_smstr;?>"><?php echo $t->id_smstr;?> </option>
        <?php 
        
        }
		} ?>
        </select>
    </td>
</tr>   
    
<tr>    
	<td>Nilai Harian</td>
    <td width="5">:</td>
    <td><input type="text" name="harian" id="harian" 
               size="20" maxlength="5" class="easyui-validatebox" 
               data-options="required:true,validType:'length[0,5]'" 
               value="<?php echo $harian;?>" /></td>
</tr>
<tr>    
	<td>Ujian Tengah Semester </td>
    <td>:</td>
    <td><input type="text" name="uts" id="uts"  
               size="20" maxlength="5" class="easyui-validatebox" 
               data-options="required:true,validType:'length[0,5]'" 
               value="<?php echo $uts;?>"/></td>
</tr>
<tr>    
	<td>Ujian Akhir Semester</td>
    <td>:</td>
    <td><input type="text" name="uas" id="uas"  
               size="20" maxlength="5" class="easyui-validatebox" 
               data-options="required:true,validType:'length[0,5]'" 
               value="<?php echo $uas;?>"/></td>
</tr>



</table>
</fieldset>
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
      <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" 
              data-options="iconCls:'icon-save'">SIMPAN</button>
    
    <a href="<?php echo base_url();?>nilai/tampilNilai/<?php echo $id_jadwal; ?>">
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