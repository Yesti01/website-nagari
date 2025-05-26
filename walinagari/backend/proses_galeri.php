<?php
include '../database/koneksi.php';

if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
       

        // Handle gambar upload
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $folder = 'uploads/galeri/';

        if (!empty($gambar)) {
            $upload = move_uploaded_file($tmp, $folder . $gambar);
        } else {
            $gambar = ''; // kosongkan jika tidak ada gambar
        }

        // Simpan ke database
        $sql = mysqli_query($db, "INSERT INTO galeri (gambar) VALUES ('$gambar')");

        if ($sql) {
            echo "<script>window.location='index.php?p=galeri'</script>";
        } else {
            echo "Gagal menyimpan data: " . mysqli_error($db);
        }
    }
}

if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id'] ?? $_GET['id_edit']; // backup kalau pakai GET


        // Ambil data lama
        $query = mysqli_query($db, "SELECT gambar FROM galeri WHERE id='$id'");
        $dataLama = mysqli_fetch_array($query);
        $gambarLama = $dataLama['gambar'];

        $gambarBaru = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $folder = 'uploads/galeri/';

        if (!empty($gambarBaru)) {
            // Upload gambar baru
            $upload = move_uploaded_file($tmp, $folder . $gambarBaru);
            // Hapus gambar lama jika ada
            if (file_exists($folder . $gambarLama) && $gambarLama != '') {
                unlink($folder . $gambarLama);
            }
            $gambarFinal = $gambarBaru;
        } else {
            $gambarFinal = $gambarLama;
        }

        // Update ke database
        $sql = mysqli_query($db, "UPDATE galeri SET 
            gambar = '$gambarFinal'
            WHERE id = '$id'");

        if ($sql) {
            echo "<script>window.location='index.php?p=galeri'</script>";
        } else {
            echo "Gagal mengupdate data: " . mysqli_error($db);
        }
    }
}

if ($_GET['proses'] == 'delete') {
    $id = $_GET['id_hapus'];

    // Ambil nama file gambar
    $query = mysqli_query($db, "SELECT gambar FROM galeri WHERE id='$id'");
    $data = mysqli_fetch_array($query);
    $gambar = $data['gambar'];

    // Hapus dari folder
    if (file_exists("uploads/galeri/" . $gambar) && $gambar != '') {
        unlink("uploads/galeri/" . $gambar);
    }

    // Hapus dari database
    $hapus = mysqli_query($db, "DELETE FROM galeri WHERE id='$id'");
    if ($hapus) {
        header("Location: index.php?p=galeri");
    } else {
        echo "Gagal menghapus data: " . mysqli_error($db);
    }
}
?>
