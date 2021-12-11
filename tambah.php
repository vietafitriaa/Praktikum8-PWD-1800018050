<!DOCTYPE html>
<html>
<head>
	<style>
		.error {
			font-size: 15px;
			color: red;
		}
	</style>
</head>

<body>
	<?php
	$nimErr = $namaErr = $jkelErr = $alamatErr = $tgllhrErr = "";
	$nim = $nama = $jkel = $alamat = $tgllhr =  "";

	$flag = true;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (empty($_POST["nim"])) {
			$nimErr = "Nim harus diisi";
			$flag = false;
		} else {
			$nim = test_input($_POST["nim"]);
		}

		if (empty($_POST["nama"])) {
            $namaErr = "Nama harus diisi";
			$flag = false;
            }else {
            $nama = test_input($_POST["nama"]);
		}

		if (empty($_POST["jkel"])) {
            $jkelErr = 'Jenis Kelamin harus dipilih';
			$flag = false;
		} else {
			$jkel = test_input($_POST["jkel"]);
		}

		if (empty($_POST["alamat"])) {
			$alamatErr = "Alamat harus diisi";
			$flag = false;
		} else {
			$alamat = test_input($_POST["alamat"]);
		}

		if (empty($_POST["tgllhr"])) {
            $tgllhrErr = 'Tanggal lahir harus diisi';
			$flag = false;
		} else {
			$tgllhr = test_input($_POST["tgllhr"]);
		}

		// form disubmit ketika telah berhasil di validasi
		if ($flag) {

			$conn = new mysqli("localhost","root","","akademik");

			if ($conn->connect_error) {
				die("connection failed error: " . $conn->connect_error);
			}
			
			$sql = "INSERT INTO mahasiswa (nim, nama, jkel, alamat, tgllhr) VALUES('$nim', '$nama', '$jkel','$alamat', '$tgllhr') ";
			// execute sql insert
			if ($conn->query($sql) === TRUE) {
				echo "Data berhasil disimpan. <a href='index.php'>View Users</a>";
                
			}
		}
	}

	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	?>
	<form action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<h2>Data Mahasiswa </h2>
		<table>
                <tr>
                    <td>Nim : </td>
					<td><input type="text" name="nim" placeholder="Nim">
					<span class="error">* <?= $nimErr; ?></span>
					</td>
				</tr>
				<td>
                <tr>
                    <td>Nama : </td>
					<td><input type="text" name="nama" placeholder="Nama">
					<span class="error">* <?= $namaErr; ?></span>
					</td>
				</tr>
				<td>
                <tr>
					<td>Jenis Kelamin :</td>
				    <td>
                    <input type = "radio" name = "jkel" value = "L">Laki-Laki
                    <input type = "radio" name = "jkel" value = "P">Perempuan
                    <span class = "error">* <?php echo $jkelErr; ?></span>
                    </td>
				</tr>
				<td>
				<tr>
					<td>Alamat : </td>
					<td><input type="text" name="alamat" placeholder="Alamat"></input>
                    <span class="error">* <?= $alamatErr; ?></span></td>
				</tr>
				<td>
				<tr>
					<td>Tanggal Lahir : </td>
					<td><input type="date" name="tgllhr" ></input>
                    <span class="error">* <?= $tgllhrErr; ?></span></td>
				</tr>
				<td><td>
				<input class="button btn btn-primary" type="submit" name="button">
				</td>
		</table>
	</form>
	</body>
</html>