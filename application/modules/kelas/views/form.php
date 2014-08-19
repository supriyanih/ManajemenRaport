<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
	
	tampil_data();
	
	function tampil_data(){
		var kode = $("#kd_kelas").val();
		//alert(kode);
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>kelas/InfoKelas",
			data	: "kode="+kode,
			cache	: false,
			success	: function(data){
				$("#tampil_data").html(data);
			}
		});
		//return false();
	}
	
	//$("#kelas").datepicker({
			//dateFormat:"dd-mm-yy"
    });
	
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
			url		: "<?php echo site_url(); ?>kelas/InfoWali",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#nama_wali").val(data.nama_wali);
				$("#telpon").val(data.telpon);
				
			}
		});
	};
	$("#harga").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
	$("#jml").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
	
	function hitung(){
		var jml = $("#jml").val();
		var harga = $("#harga").val();
		
		var total = parseInt(jml)*parseInt(harga);
		$("#total").val(total);
	}
	$("#jml").keyup(function(){
		hitung();
	});
	$("#harga").keyup(function(){
		hitung();
	});
	
	$("#simpan").click(function(){
		var kode	= $("#kd_kelas").val();
		var kelas		= $("#kelas").val();
		
		var wali_kelas	= $("#wali_kelas").val();
		var jml	= $("#jml").val();
		var total		= $("#total").val();
		
		var string = $("#form").serialize();
		
		if(kode.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kode Beli tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#kode").focus();
			return false();
		}
		if(kelas.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Tanggal tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#kelas").focus();
			return false();
		}
		if(supplier.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Supplier tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#supplier").focus();
			return false();
		}
		if(wali_kelas.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Kode Wali tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#wali_kelas").focus();
			return false();
		}
		if(nama_wali.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Nama Wali tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#nama_wali").focus();
			return false();
		}
		if(jml.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, jumlah tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#jml").focus();
			return false();
		}
		if(total<=0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, jumlah tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#jml").focus();
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
				tampil_data();
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
	
	$("#tambah_data").click(function(){
		$(".detail").val('');
		$("#wali_kelas").val('');
		$("#wali_kelas").focus();
	});
	
	$("#cetak").click(function(){
		var kode	= $("#kd_kelas").val();
		window.open('<?php echo site_url();?>/pembelian/cetak/'+kode);
		return false();
	});
	
	$("#cari_wali").click(function(){
		AmbilDaftarWali();
		$("#dlg").dialog('open');
	});
	
	$("#text_cari").keyup(function(){
		AmbilDaftarWali();
		//$("#dlg").dialog('open');
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
});	
</script>
<form name="form" id="form">
<table width="100%">
<tr>
<td valign="top" width="50%">
    <fieldset>
    <table width="100%">
    <tr>    
        <td width="150">Kode Pembelian</td>
        <td width="5">:</td>
        <td><input type="text" name="kd_kelas" id="kd_kelas" size="12" maxlength="12" readonly="readonly" value="<?php echo $kd_kelas;?>" /></td>
    </tr>
    <tr>    
        <td>Tanggal Beli</td>
        <td>:</td>
        <td><input type="text" name="kelas" id="kelas"  size="15" maxlength="15" class="easyui-validatebox" data-options="required:true,validType:'length[3,10]'" value="<?php echo $kelas;?>"/></td>
    </tr>
   
    </table>
    </fieldset>
</td>
<td valign="top" width="50%">
    <fieldset class="atas">
    <table width="100%">
    <tr>    
        <td width="150">Kode Wali</td>
        <td width="5">:</td>
        <td><input type="text" name="wali_kelas" id="wali_kelas" size="12" maxlength="12" class="easyui-validatebox" data-options="required:true,validType:'length[3,10]'" />
        <button type="button" name="cari_wali" id="cari_wali" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
        </td>
    </tr>
    <tr>    
        <td>Nama Wali</td>
        <td>:</td>
        <td><input type="text" name="nama_wali" id="nama_wali"  size="50" class="detail" maxlength="50" readonly="readonly"/></td>
    </tr>
    <tr>    
        <td>Satuan</td>
        <td>:</td>
        <td><input type="text" name="telpon" id="telpon"  size="20" class="detail" maxlength="20" readonly="readonly"/></td>
    </tr>
    <tr>    
        <td>Harga</td>
        <td>:</td>
        <td><input type="text" name="harga" id="harga"  size="20"class="detail" maxlength="20" readonly="readonly"/></td>
    </tr>
    <tr>    
        <td>Jumlah</td>
        <td>:</td>
        <td><input type="text" name="jml" id="jml"  size="20" class="detail" maxlength="20"/></td>
    </tr>
    <tr>    
        <td>Total</td>
        <td>:</td>
        <td><input type="text" name="total" id="total" class="detail" size="20" maxlength="20" readonly="readonly"/></td>
    </tr>
    </table>
    </fieldset>
</td>
</tr>
</table>    
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    <button type="button" name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH</button>
    <button type="button" name="cetak" id="cetak" class="easyui-linkbutton" data-options="iconCls:'icon-print'">CETAK</button>
    <a href="<?php echo base_url();?>index.php/pembelian/">
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-logout'">TUTUP</button>
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