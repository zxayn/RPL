	<?php
    //buat session
    if(!isset($_SESSION)) {
        session_start();
    }

    //biar dipaksa login dahulu
    if(!isset($_SESSION['username'])) {
    	header("location: index.php");
    }



    require_once("koneksi.php");
	//jika tombol simpan di klik
	if (isset($_POST['bsimpan']))
	{
		//apakah data akan di edit atau disimpan baru
	if(isset($_GET['hal']))
	{
		if($_GET['hal'] == "edit")
		{
			//data akan di edit
			$edit = mysqli_query($conn, "UPDATE tb_admin set 
												username = '$_POST[tusername]',
												email = '$_POST[temail]',
												password = md5('$_POST[tpassword]'),
												alamat = '$_POST[talamat]',
												jurusan = '$_POST[tjurusan]'
											WHERE id_users = '$_GET[id]'
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
			$simpan = mysqli_query($conn, "INSERT INTO tb_admin (username, email, password, alamat, jurusan)
							VALUES ('$_POST[tusername]', 
									'$_POST[temail]', 
									md5('$_POST[tpassword]'), 
									'$_POST[talamat]', 
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
			$tampil = mysqli_query($conn, "SELECT * FROM tb_admin WHERE id_users = '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
			if ($data) 
			{
				//jika data di temukan maka data di tampung dulu kedalam variable
				$vusername = $data['Username'];
				$vemail = $data['Email'];
				$vpassword = $data['Password'];
				$valamat = $data['Alamat'];
				$vjurusan = $data['Jurusan'];
			}
		}
	}
	if(isset($_GET['hal']))
	{
		if($_GET['hal'] == "hapus")
		{
				//persiapan hapus data
				$hapus = mysqli_query($conn, "DELETE FROM tb_admin WHERE id_users = 
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

<!-- Awal Card Data RPL -->
<div class="card mt-5 fw-bold">
  <div class="card-header bg-warning">
  	<i class="bi bi-person-lines-fill"></i> 
  	Masukan Data Anda
  	<p>
    	<a href="logout.php">Logout</a>
		</p>
  </div>
  <div class="card-body">
  	<form method="post" action="">
  		<div class="form-group fw-bold" data-aos="zoom-in" data-aos-delay="200">
  			<label><i class="bi bi-pencil-square"></i> Username</label>
  			<input type="text" name="tusername" value="<?=@$vusername?>" class="form-control" required>
  		</div>
  		<div class="form-group mt-3 fw-bold" data-aos="zoom-out" data-aos-delay="300">
  			<label><i class="bi bi-pencil-square"></i> Email</label>
  			<input type="email" name="temail" value="<?=@$vemail?>" class="form-control" required>
  		</div>
  		<div class="form-group mt-3 fw-bold" data-aos="zoom-out" data-aos-delay="400">
  			<label><i class="bi bi-pencil-square"></i> Password</label>
  			<input type="password" name="tpassword" value="<?=@$vpassword?>" class="form-control" required>
  		</div>
  		<div class="form-group mt-3 fw-bold" data-aos="zoom-in" data-aos-delay="500">
  			<label><i class="bi bi-pencil-square"></i> Alamat</label>
  			<textarea class="form-control" name="talamat" data-aos-duration="700"><?=@$valamat?></textarea>
  		</div>
  		<div class="form-group mt-3 fw-bold" data-aos="zoom-in" data-aos-delay="600">
  			<label><i class="bi bi-pencil-square"></i> Jurusan</label>
  			<select class="form-control" name="tjurusan">
  				<option value="<?=@$vjurusan?>"><?=@$vjurusan?></option>
  				<option value="RPL">RPL</option>
  				<option value="MM">MM</option>
  				<option value="TKJ">TKJ</option>
  			</select>
  		</div>
 			<div class="mt-3">
	  		<button type="submit" class="btn btn-warning" name="bsimpan">Simpan
	  		</button>
	  		<button type="reset" class="btn btn-danger" name="breset">Batal
	  		</button>
			</div>
  	</form>
  </div>
</div>
<!-- Akhir Card Data RPL -->

<!-- Awal Card Tabel RPL -->
<div class="card mt-5 fw-bold">
  <div class="card-header bg-warning">
  	<i class="bi bi-person-video2"></i>
   	Data Anda
  </div>
  <div class="card-body">
  	
  	<table class="table table-bordered table-striped">
  		<tr>
  			<th>No.</th>
  			<th>Username</th>
  			<th>Email</th>
  			<th>Password</th>
  			<th>Alamat</th>
  			<th>Jurusan</th>
  			<th>Aksi</th>
  		</tr>
  		<?php
  		$no = 1;
  		$tampil = mysqli_query($conn, "SELECT * FROM tb_admin order by id_users desc");
  		while ($data = mysqli_fetch_array($tampil)) :

  		?>
  		<tr>
  			<td><?=$no++?></td>
  			<td><?=$data['Username']?></td>
  			<td><?=$data['Email']?></td>
  			<td><?=$data['Password']?></td>
  			<td><?=$data['Alamat']?></td>
  			<td><?=$data['Jurusan']?></td>
  			<td>
  				<a href="tampil.php?hal=edit&id=<?=$data['id_users']?>" 
  				class="btn btn-warning">Edit </a>
  				<a href="tampil.php?hal=hapus&id=<?=$data['id_users']?>
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