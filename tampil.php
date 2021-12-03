<?php 
	//koneksi database
	$server = "localhost";
	$user = "root";
	$password = "zxayn123";
	$database = "db_smkti";

	$koneksi = mysqli_connect($server, $user, $password, $database)or die
	(mysqli_error($koneksi));

	//jika tombol simpan di klik
	if (isset($_POST['bsimpan']))
	{
		//apakah data akan di edit atau disimpan baru
	if(isset($_GET['hal']))
	{
		if($_GET['hal'] == "edit")
		{
			//data akan di edit
			$edit = mysqli_query($koneksi, "UPDATE smkti set 
												nama = '$_POST[tnama]',
												email = '$_POST[temail]',
												alamat = '$_POST[talamat]',
												telp = '$_POST[ttelp]',
												jurusan = '$_POST[tjurusan]'
											WHERE id_siswa = '$_GET[id]'
										   ");
			if ($edit) //jika simpan sukses
			{
				echo "<script>
					alert('Edit Data SUKSES!');
					document.location='tampil.php'
					  </script>";
			}
			else
			{
				echo "<script>
					alert('Edit Data GAGAL!');
					document.location='tampil.php'
					  </script>";
			}
		}
	}
		else
		{
			//data akan di simpan baru
			$simpan = mysqli_query($koneksi, "INSERT INTO smkti (nama, email, alamat, telp, jurusan)
							VALUES ('$_POST[tnama]', 
									'$_POST[temail]', 
									'$_POST[talamat]', 
									'$_POST[ttelp]', 
									'$_POST[tjurusan]')
								");
			if ($simpan) //jika simpan sukses
			{
				echo "<script>
					alert('Simpan Data SUKSES!');
					document.location='tampil.php'
					  </script>";
			}
			else
			{
				echo "<script>
					alert('Simpan Data GAGAL!');
					document.location='tampil.php'
					  </script>";
			}
		}
	}

	//jika tombol edit di klik / hapus klik
	if(isset($_GET['hal']))
	{
		//pengujian data yang akan di edit
		if($_GET['hal'] == "edit")
		{
			//tampilkan data yang akan di edit
			$tampil = mysqli_query($koneksi, "SELECT * FROM smkti WHERE id_siswa = '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
			if ($data) 
			{
				//jika data di temukan maka data di tampung dulu kedalam variable
				$vnama = $data['Nama'];
				$vemail = $data['Email'];
				$valamat = $data['Alamat'];
				$vtelp = $data['Telp'];
				$vjurusan = $data['Jurusan'];
			}
		}
	}
	if(isset($_GET['hal']))
	{
		if($_GET['hal'] == "hapus")
		{
				//persiapan hapus data
				$hapus = mysqli_query($koneksi, "DELETE FROM smkti WHERE id_siswa = 
					'$_GET[id]' ");
			if($hapus){
				echo "<script>
						alert('Hapus Data SUKSES!!');
						document.location='tampil.php'
					  </script>";
			}		
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RPL</title>
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
</head>
<body>

<div class="container mt-3">

	<h1 class="text-center" data-aos="zoom-out" data-aos-duration="800">
			<i class="bi bi-file-person"></i> 
			Data Siswa SMKTI
	</h1>

<!-- Awal Card Data RPL -->
<div class="card mt-5">
  <div class="card-header bg-warning">
  	<i class="bi bi-person-lines-fill"></i> 
  	Input Data
  </div>
  <div class="card-body">
  	<form method="post" action="">
  		<div class="form-group" data-aos="zoom-in" data-aos-delay="100" data-aos-duration="700">
  			<label><i class="bi bi-pencil-square"></i> Nama</label>
  			<input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" placeholder="Input Nama" required>
  		</div>
  		<div class="form-group" data-aos="zoom-out" data-aos-delay="150" data-aos-duration="700">
  			<label><i class="bi bi-pencil-square"></i> Email</label>
  			<input type="email" name="temail" value="<?=@$vemail?>" class="form-control" placeholder="Input Email" required>
  		</div>
  		<div class="form-group" data-aos="zoom-in" data-aos-delay="200" data-aos-duration="700">
  			<label><i class="bi bi-pencil-square"></i> Alamat</label>
  			<textarea class="form-control" name="talamat" placeholder="Input Alamat" data-aos-duration="700"><?=@$valamat?></textarea>
  		</div>
  		<div class="form-group" data-aos="zoom-out" data-aos-delay="250" data-aos-duration="700">
  			<label><i class="bi bi-pencil-square"></i> Telp</label>
  			<input type="text" name="ttelp" value="<?=@$vtelp?>" class="form-control" placeholder="Input Telp" required>
  		</div>
  		<div class="form-group" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="700">
  			<label><i class="bi bi-pencil-square"></i> Jurusan</label>
  			<select class="form-control" name="tjurusan">
  				<option value="<?=@$vjurusan?>"><?=@$vjurusan?></option>
  				<option value="RPL">RPL</option>
  				<option value="MM">MM</option>
  				<option value="TKJ">TKJ</option>
  			</select>
  		</div>

  		<button type="submit" class="btn btn-warning" name="bsimpan">Simpan
  		</button>
  		<button type="reset" class="btn btn-danger" name="breset">Batal
  		</button>

  	</form>
  </div>
</div>
<!-- Akhir Card Data RPL -->

<!-- Awal Card Tabel RPL -->
<div class="card mt-5">
  <div class="card-header bg-warning">
  	<i class="bi bi-person-video2"></i>
    Daftar Siswa
  </div>
  <div class="card-body">
  	
  	<table class="table table-bordered table-striped">
  		<tr>
  			<th>No.</th>
  			<th>Nama</th>
  			<th>Email</th>
  			<th>Alamat</th>
  			<th>Telp</th>
  			<th>Jurusan</th>
  			<th>Aksi</th>
  		</tr>
  		<?php
  		$no = 1;
  		$tampil = mysqli_query($koneksi, "SELECT * FROM smkti order by id_siswa desc");
  		while ($data = mysqli_fetch_array($tampil)) :

  		?>
  		<tr>
  			<td><?=$no++?></td>
  			<td><?=$data['Nama']?></td>
  			<td><?=$data['Email']?></td>
  			<td><?=$data['Alamat']?></td>
  			<td><?=$data['Telp']?></td>
  			<td><?=$data['Jurusan']?></td>
  			<td>
  				<a href="tampil.php?hal=edit&id=<?=$data['id_siswa']?>" 
  				class="btn btn-warning">Edit </a>
  				<a href="tampil.php?hal=hapus&id=<?=$data['id_siswa']?>
  				"onclick="return confirm('Anda yakin ingin Hapus Data Ini?')" 
  				class="btn btn-danger">Hapus </a>
  			</td>
  		</tr>
  		<?php endwhile; //pemutus perulangan ?>
  	</table>

  </div>
</div>
<!-- Akhir Card Tabel RPL -->

</div>
<script type="js/bootstrap.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>