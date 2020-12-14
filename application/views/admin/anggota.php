<div class="page header">
	<h3> Data Anggota </h3>
</div>
<a href="<?php echo base_url().'admin/tambah_anggota'; ?>" class="btn btn-primary btn-xs"><span class="glyphicon-plus"></span> Anggota Baru </a>
<div class="navbar-form navbar-right">
	<?php echo form_open('admin/search_anggota') ?>
	<input type="text" name="keyword_anggota" class="form-control" placeholder="Search" autocomplete="off">
	<button type="submit" class="btn btn-primary">Cari</button>
	<?php echo form_close() ?>
</div>
<br><br><br>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover" id="table-datatable">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Gender</th>
				<th>No Telp</th>
				<th>Alamat</th>
				<th>E-mail</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no =1;
			foreach ($anggota as $a) {
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<!--
				<td><img scr= "<?php echo base_url(). 'assets/upload/'. $a->gambar; ?>" width="80" height="80" alt="Tidak Ada Gambar"></td> -->
				<td> <?php echo $a->nama_anggota ?></td>
				<td> <?php echo $a->gender ?></td>
				<td> <?php echo $a->no_telp ?></td>
				<td> <?php echo $a->alamat ?></td>
				<td> <?php echo $a->email ?></td>
				
				<td nowrap="nowrap">
					<a class="btn btn-primary btn-xs" href="<?php echo base_url().'admin/edit_anggota/'.$a->id_anggota; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
					<a class="btn btn-warning btn-xs" href="<?php echo base_url().'admin/hapus_anggota/'.$a->id_anggota; ?>"><span class="glyphicon glyphicon-remove"></span></a>
			</tr><?php
			}?>
		</tbody>
	</table>
</div>