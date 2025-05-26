<?php
include '../database/koneksi.php';

if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $jabatan = $_POST['jabatan'];

        // Handle foto upload
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $folder = 'uploads/struktur/';

        if (!empty($foto)) {
            $upload = move_uploaded_file($tmp, $folder . $foto);
        } else {
            $foto = ''; // kosongkan jika tidak ada gambar
        }

        // Simpan ke database
        $sql = mysqli_query($db, "INSERT INTO struktur (nama, jabatan, foto) VALUES ('$nama', '$jabatan', '$foto')");

        if ($sql) {
            echo "<script>window.location='index.php?p=struktur'</script>";
        } else {
            echo "Gagal menyimpan data: " . mysqli_error($db);
        }
    }
}

if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id'] ?? $_GET['id_edit']; // backup kalau pakai GET
        $nama = $_POST['nama'];
        $jabatan = $_POST['jabatan'];

        // Ambil data lama
        $query = mysqli_query($db, "SELECT foto FROM struktur WHERE id='$id'");
        $dataLama = mysqli_fetch_array($query);
        $fotoLama = $dataLama['foto'];

        $fotoBaru = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $folder = 'uploads/struktur/';

        if (!empty($fotoBaru)) {
            // Upload foto baru
            $upload = move_uploaded_file($tmp, $folder . $fotoBaru);
            // Hapus foto lama jika ada
            if (file_exists($folder . $fotoLama) && $fotoLama != '') {
                unlink($folder . $fotoLama);
            }
            $fotoFinal = $fotoBaru;
        } else {
            $fotoFinal = $fotoLama;
        }

        // Update ke database
        $sql = mysqli_query($db, "UPDATE struktur SET 
            nama = '$nama',
            jabatan = '$jabatan',
            foto = '$fotoFinal'
            WHERE id = '$id'");

        if ($sql) {
            echo "<script>window.location='index.php?p=struktur'</script>";
        } else {
            echo "Gagal mengupdate data: " . mysqli_error($db);
        }
    }
}

if ($_GET['proses'] == 'delete') {
    $id = $_GET['id_hapus'];

    // Ambil nama file foto
    $query = mysqli_query($db, "SELECT foto FROM struktur WHERE id='$id'");
    $data = mysqli_fetch_array($query);
    $foto = $data['foto'];

    // Hapus dari folder
    if (file_exists("uploads/struktur/" . $foto) && $foto != '') {
        unlink("uploads/struktur/" . $foto);
    }

    // Hapus dari database
    $hapus = mysqli_query($db, "DELETE FROM struktur WHERE id='$id'");
    if ($hapus) {
        header("Location: index.php?p=struktur");
    } else {
        echo "Gagal menghapus data: " . mysqli_error($db);
    }
}
?>
