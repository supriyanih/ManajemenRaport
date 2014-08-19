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
		CariDataJadwal();
	});
	function CariDataJadwal(){
		var kode = $("#nis").val()
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>jadwal/InfoJadwal",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#id").val(data.nis);
				$("#mapel").val(data.nama);
				$("#kelas").val(data.tempat);
				$("#jurusan").val(data.tgl_lahir);
				$("#pengajar").val(data.jenkel);
                                $("#ruangan").val(data.jurusan);
                                $("#hari").val(data.kelas);
                                $("#jam_mulai").val(data.alamat);
                                $("#jam_selesai").val(data.thn_masuk);
                                
                               
			}
		});
	}
	
	
        $("#tgl_lahir").datepicker({
			dateFormat:"dd-mm-yy"
    });
        
	
	$("#simpan").click(function(){
		
                                var id = $("#id").val();
				var mapel = $("#mapel").val();
				var kelas = $("#kelas").val();
				var jurusan = $("#jurusan").val();
				var pengajar = $("#pengajar").val();
                                var ruangan = $("#ruangan").val();
                                var hari = $("#hari").val();
                                var jam_mulai = $("#jam_mulai").val();
                                var jam_selesai = $("#jam_selesai").val();
                               
                                var string = $("#form").serialize();
		
		
		
                if(mapel.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Mata pelajaran tidak boleh  kosong ,Anda harus memilih mata pelajaran ', 
				timeout:2000,
				showType:'show'
			});
			$("#mapel").focus();
			return false();
		}
                  if(kelas.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf,Kelas tidak boleh kosong, Anda harus memilih Kelas ', 
				timeout:2000,
				showType:'show'
			});
			$("#mapel").focus();
			return false();
		}
                
                 if(jurusan.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf,Jurusan tidak boleh kosong, Anda harus memilih Jurusan ', 
				timeout:2000,
				showType:'show'
			});
			$("#jurusan").focus();
			return false();
		}
                 if(pengajar.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf,Pengajar tidak boleh kosong, Anda harus memilih Pengajar ', 
				timeout:2000,
				showType:'show'
			});
			$("#pengajar").focus();
			return false();
		}
                if(ruangan.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf,Ruangan tidak boleh kosong, Anda harus memilih Ruangan ', 
				timeout:2000,
				showType:'show'
			});
			$("#ruangan").focus();
			return false();
		}
                 if(hari.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf,Hari mengajar tidak boleh kosong, Anda harus memilih Hari ', 
				timeout:2000,
				showType:'show'
			});
			$("#hari").focus();
			return false();
		}
                if(jam_mulai.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Jenis Kelamin  tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#jam_mulai").focus();
			return false();
		}
                
                if(jam_selesai.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, alamat tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#selesai").focus();
			return false();
		}
                
                
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>jadwal/simpan",
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
	<td>ID</td>
    <td width="5">:</td>
    <td><input type="text" name="id" id="id" size="12" maxlength="20" readonly="readonly" value="<?php echo $id;?>" /></td>
</tr>
<tr>    
	<td>Mata Pelajaran </td>
    <td>:</td>
    <td>
      <select name="mapel" id="mapel" >
        <?php 
		if(empty($mapel)){
		?>
        <option value="">-PILIH-</option>
        <?php
		}
		foreach($l_mapel->result() as $t){
			if($mapel==$t->kd_mapel){
		?>
        <option value="<?php echo $t->kd_mapel;?>" selected="selected"><?php echo $t->kd_mapel;?>--<?php echo $t->mapel;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->kd_mapel;?>"><?php echo $t->kd_mapel;?>--<?php echo $t->mapel;?> </option>
        <?php }
		} ?>
        </select>
    </td>
</tr>
<tr>    
	<td>Kelas</td>
    <td>:</td>
    <td>
        <select name="kelas" id="kelas" >
        <?php 
		if(empty($kelas)){
		?>
        <option value="">-PILIH-</option>
        <?php
		}
		foreach($l_kelas->result() as $t){
			if($kelas==$t->kd_kelas){
		?>
        <option value="<?php echo $t->kd_kelas;?>" selected="selected"><?php echo $t->kd_kelas;?> </option>
        <?php }else { ?>
        <option value="<?php echo $t->kd_kelas;?>"><?php echo $t->kd_kelas;?> </option>
        <?php }
		} ?>
        </select>
    </td>
</tr>
<tr>    
    <td>Jurusan</td>
    <td>:</td>
    <td>
        <select name="jurusan" id="jurusan" >
        <?php 
		if(empty($jurusan)){
		?>
        <option value="">-PILIH-</option>
        <?php
		}
		foreach($l_jurusan->result() as $t){
			if($jurusan==$t->jurusan){
		?>
        <option value="<?php echo $t->jurusan;?>" selected="selected"><?php echo $t->jurusan;?> </option>
        <?php }else { ?>
        <option value="<?php echo $t->jurusan;?>"><?php echo $t->jurusan;?> </option>
        <?php }
		} ?>
        </select>
    </td>
</tr>
<tr>
    <td>Pengajar</td>
    <td>:</td>
    <td>
        <select name="pengajar" id="pengajar" >
        <?php 
		if(empty($pengajar)){
		?>
        <option value="">-PILIH-</option>
        <?php
		}
		foreach($l_guru->result() as $t){
			if($pengajar==$t->nip){
		?>
        <option value="<?php echo $t->nip;?>" selected="selected"><?php echo $t->nip;?>-<?php echo $t->nama;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->nip;?>"><?php echo $t->nip;?>-<?php echo $t->nama;?></option>
        <?php }
		} ?>
        </select>
    </td>
                         
 </tr>


<tr>    
	<td>Ruang Kelas</td>
    <td>:</td>
    <td><input type="text" name="ruangan" id="ruangan"  size="50" maxlength="50" class="easyui-validatebox" data-options="required:true,validType:'length[10,50]'" value="<?php echo $ruangan;?>"/></td>
</tr>
<tr>    
	<td>Hari</td>
    <td>:</td>
    <td><input type="text" name="hari" id="hari"  size="20" maxlength="20" class="easyui-validatebox" data-options="required:true,validType:'length[3,30]'" value="<?php echo $hari;?>"/></td>
</tr>
<tr>    
	<td>Jam</td>
    <td>:</td>
    <td>
        <input type="text" name="jam_mulai" id="jam_mulai"  size="10" maxlength="10" class="easyui-validatebox" data-options="required:true,validType:'length[3,30]'" value="<?php echo $jam_mulai;?>"/>
        sampai
        <input type="text" name="jam_selesai" id="jam_selesai"  size="30" maxlength="20" class="easyui-validatebox" data-options="required:true,validType:'length[3,30]'" value="<?php echo $jam_selesai;?>"/>
    </td>
</tr>

</table>
</fieldset>
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
   
    <a href="<?php echo base_url();?>jadwal">
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </a>
    </td>
</tr>
</table>  
</fieldset>   
</form>