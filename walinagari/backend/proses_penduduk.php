<?php
if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        include '../database/koneksi.php';

        // Ambil data dari POST
        $nama                = $_POST['nama'];
        $nik                 = $_POST['nik'];
        $jenis_kelamin       = $_POST['jenis_kelamin'];
        $umur                = $_POST['umur'];
        $pekerjaan           = $_POST['pekerjaan'];
        $pendidikan_terakhir = $_POST['pendidikan_terakhir'];
        $status_perkawinan   = $_POST['status_perkawinan'];
        $alamat              = $_POST['alamat'];
        $jorong              = $_POST['jorong'];

        // Jalankan query insert
        $sql = mysqli_query($db, "INSERT INTO penduduk (nama, nik, jenis_kelamin, umur, pekerjaan, pendidikan_terakhir, status_perkawinan, alamat, jorong)
            VALUES (
                '$nama',
                '$nik',
                '$jenis_kelamin',
                '$umur',
                '$pekerjaan',
                '$pendidikan_terakhir',
                '$status_perkawinan',
                '$alamat',
                '$jorong'
            )");

        if ($sql) {
            echo "<script>window.location='index.php?p=penduduk'</script>";
        } else {
            echo "Gagal menambahkan data: " . mysqli_error($db);
        }
    }
}

if($_GET['proses']=='delete'){
     include '../database/koneksi.php';
   
    $hapus=mysqli_query($db,"DELETE FROM penduduk WHERE nik='$_GET[id_hapus]'");
        if ($hapus){
            header ("location:index.php?p=penduduk");
        } 
      

}

if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        include '../database/koneksi.php';
         // Ambil semua data dari form
        $nama                = $_POST['nama'];
        $nik                 = $_POST['nik'];
        $jenis_kelamin       = $_POST['jenis_kelamin'];
        $umur                = $_POST['umur'];
        $pekerjaan           = $_POST['pekerjaan'];
        $pendidikan_terakhir = $_POST['pendidikan_terakhir'];
        $status_perkawinan   = $_POST['status_perkawinan'];
        $alamat              = $_POST['alamat'];
        $jorong              = $_POST['jorong'];


        // Query update
        $sql = mysqli_query($db, "UPDATE penduduk SET 
                nama='$nama',
                nik='$nik',
                jenis_kelamin='$jenis_kelamin',
                umur='$umur',
                pekerjaan='$pekerjaan',
                pendidikan_terakhir='$pendidikan_terakhir',
                status_perkawinan='$status_perkawinan',
                alamat='$alamat',
                jorong='$jorong'
                WHERE nik='$nik'");

        if ($sql) {
            header("Location: index.php?p=penduduk");
            exit;
        } else {
            echo "Error update: " . mysqli_error($db);
        }
    }
}


?>

