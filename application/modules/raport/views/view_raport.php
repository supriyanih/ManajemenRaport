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
			url		: "<?php echo site_url(); ?>raport/DataSiswa/<?php echo $this->uri->segment(3);?>",
			data	: "cari="+cari,
			cache	: false,
			success	: function(data){
				$("#daftar_siswa").html(data);
			}
		});
	}
        
        $("#cari").click(function(){
		AmbilDaftarRaport();
		$("#dlg1").dialog('open');
                
	});
        function AmbilDaftarRaport(){
		var cari = $("#text_cari").val();
                var nis =$("#nis").val();
                var semester=$("#semester").val();
                var string = $("#form").serialize();
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>raport/DataRaport/<?php echo $this->uri->segment(3);?>",
			data	:string,
			cache	: false,
			success	: function(data){
				$("#daftar_raport").html(data);
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
<div id="view" style="background-color:#cccccc">

<div style="float:left; padding-bottom:5px;">
    <form name="form" id="form" method="post" action="<?php echo base_url();?>raport/raportSiswa/">
<button type="button" name="cari_siswa" id="cari_siswa" class="easyui-linkbutton" 
        style="background: #99FFCC"    
        data-options="iconCls:'icon-add'">Tampilkan Siswa</button>
<input type="text" name="nis" id="nis"  size="30" maxlength="50" class="easyui-validatebox"  readonly="readonly" value=""/>
    
<select name="semester" id="semester">
    <option value="" selected="selected">Pilih Semester</option>
    <option value="1">Semester I</option>
    <option value="2">Semester II</option>
</select>
<button type="button" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">TAMPILKAN RAPORT</button>
</form>
    

    
</div>
<div id="gird" style="float:left; width:100%;">
<table id="dataTable" width="100%">

        
        <fieldset>
<div id="tampil_data"></div>
</fieldset>
<div id="dlg" class="easyui-dialog" title="Daftar Siswa" style="width:900px;height:400px; padding:5px;" data-options="closed:true">
	Cari : <input type="text" name="text_cari" id="text_cari" size="50" />
	<div id="daftar_siswa"></div>
</div>  
  <div id="dlg1" class="easyui-dialog" title="Raport Siswa" style="width:900px;height:600px; padding:5px;" data-options="closed:true">
	
  <div id="daftar_raport"></div>
</div>       
        
</table>
<?php echo "<table align='center'><tr><td>".$paginator."</td></tr></table>"; ?>
</div>
</div>

