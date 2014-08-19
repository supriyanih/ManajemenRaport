<div id="view">
    <div id="gird" style="width:100%; background:#99FFCC" border="1">
    <table id="data" style="width: 100%;" >
        <tr>
            <th colspan="2" ><h2>Profil Guru </h2></th>
        </tr>
    <tr>
        <th>Nama</th>
        <td><?php echo $nama; ?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?php echo $email; ?></td>
    </tr>
    <tr>
        <th>Telpon</th>
        <td><?php echo $telpon; ?></td>
    </tr>
    <tr>
        <th>alamat</th>
        <td><?php echo $alamat; ?></td>
    </tr>
    <tr>
        <th colspan="2">
           <a href="<?php echo base_url();?>guru/editGuru/<?php echo $nip; ?>">
    <button type="button" name="tambah" id="tambah" class="easyui-linkbutton" 
            data-options="" style="background:#99FFCC "><strong>Edit Profil & password</strong></button>
           </a>
            
            
        </th>
    </tr>
</table>
    
</div>
</div>