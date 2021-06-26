<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<title>Maulidul Bilhuda</title>
</head>
<div class="container mt-5">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalaAdd">Add</button>
	<div class="text-center mt-3">
		<h4> Data Barang</h4>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Created</th>
				<th style="text-align: right;">Aksi</th>
			</tr>
		</thead>
		<tbody id="show_data">

		</tbody>
	</table>

</div>

<body>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			tampil_data_barang();

			function tampil_data_barang() {
				$.ajax({
					type: 'GET',
					url: '<?php echo base_url() ?>welcome/getbarang',
					async: true,
					dataType: 'json',
					success: function(data) {
						var html = '';
						var i;
						for (i = 0; i < data.length; i++) {
							html += '<tr>' +
								'<td>' + data[i].name + '</td>' +
								'<td>' + data[i].description + '</td>' +
								'<td>' + data[i].created_at + '</td>' +
								'<td style="text-align:right;">' +
								'<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="' + data[i].id + '">Edit</a>' + ' ' +
								'<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="' + data[i].id + '">Hapus</a>' +
								'</td>' +
								'</tr>';
						}
						$('#show_data').html(html);
					}

				});
			}
			//Simpan Barang
			$('#btn_simpan').on('click', function() {
				var name = $('#name').val();
				var description = $('#description').val();
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('welcome/save') ?>",
					dataType: "JSON",
					data: {
						name: name,
						description: description
					},
					success: function(data) {
						$('#ModalaAdd').modal('hide');
						tampil_data_barang();
					}
				});
				return false;
			});

			//GET UPDATE Barang
			$('#show_data').on('click', '.item_edit', function() {
				var id = $(this).attr('data');
				$.ajax({
					type: "GET",
					url: "<?php echo site_url('welcome/barangid') ?>/" + id,
					dataType: "JSON",
					data: {
						id: id,
					},
					success: function(data) {
						$('[name="id_edit"]').val(data.id);
						$('[name="name_edit"]').val(data.name);
						$('[name="description_edit"]').val(data.description);
						$('#Modalupdate').modal('show');
					},
				});
				return false;
			});
			// get_hapus data
			$('#show_data').on('click', '.item_hapus', function() {
				var id = $(this).attr('data');
				$.ajax({
					type: "GET",
					url: "<?php echo site_url('welcome/barangid') ?>/" + id,
					dataType: "JSON",
					data: {
						id: id,
					},
					success: function(data) {
						$('[name="id_hapus"]').val(data.id);
						$('#hapus').text(data.name);
						$('#Modalhapus').modal('show');
					},
				});
				return false;
			});
			//Hapus Barang
			$('#btn_hapus').on('click', function() {
				var id_hapus = $('#id_hapus').val();
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('welcome/delete') ?>",
					dataType: "JSON",
					data: {
						id_hapus: id_hapus
					},
					success: function(data) {
						$('#Modalhapus').modal('hide');
						tampil_data_barang();
					}
				});
				return false;
			});

			//Update Barang
			$('#btn_update').on('click', function() {
				var id_edit = $('#id_edit').val();
				var name_edit = $('#name_edit').val();
				var description_edit = $('#description_edit').val();
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('welcome/update') ?>",
					dataType: "JSON",
					data: {
						id_edit: id_edit,
						name_edit: name_edit,
						description_edit: description_edit
					},
					success: function(data) {
						$('[name="id_edit"]').val("");
						$('[name="name_edit"]').val("");
						$('[name="description_edit"]').val("");
						$('#Modalupdate').modal('hide')
						tampil_data_barang();
					}
				});
				return false;
			});

		});
	</script>
</body>

</html>
<!-- modal add -->
<!-- Modal -->
<form>
	<div class="modal fade" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="name">Nama</label>
						<input type="text" name="name" class="form-control" id="name">
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<input type="text" name="description" class="form-control" id="description">
					</div>
				</div>
				<div class="modal-footer">
					<button id="btn_simpan" type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- edit modal -->
<form>
	<div class="modal fade" id="Modalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">update Barang</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="id_edit" class="form-control" id="id_edit">
						<label for="name">Nama</label>
						<input type="text" name="name_edit" class="form-control" id="name_edit">
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<input type="text" name="description_edit" class="form-control" id="description_edit">
					</div>
				</div>
				<div class="modal-footer">
					<button id="btn_update" type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</form>

<form>
	<div class="modal fade" id="Modalhapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Yakin Mau Hapus Data Ini.?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id_hapus" class="form-control" id="id_hapus">
					<span id="hapus"></span>
				</div>
				<div class="modal-footer">
					<button id="btn_hapus" type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</form>
