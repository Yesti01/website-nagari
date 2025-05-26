<?php
include '../database/koneksi.php';

// Proses Insert
if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $visi = $_POST['visi'];
        $misi = $_POST['misi'];

        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $folder = 'uploads/visi/';

        if (!empty($foto)) {
            $upload = move_uploaded_file($tmp, $folder . $foto);
        } else {
            $foto = ''; // kosongkan jika tidak ada gambar
        }

        $sql = mysqli_query($db, "INSERT INTO visimisi (visi, misi, foto) VALUES ('$visi', '$misi', '$foto')");

        if ($sql) {
            echo "<script>window.location='index.php?p=visi'</script>";
        } else {
            echo "Gagal menambahkan data: " . mysqli_error($db);
        }
    }
}

// Proses Delete
if ($_GET['proses'] == 'delete') {
    $id = $_GET['id_hapus'];
    // Ambil nama file foto
    $query = mysqli_query($db, "SELECT foto FROM visimisi WHERE id='$id'");
    $data = mysqli_fetch_array($query);
    $foto = $data['foto'];

    // Hapus dari folder
    if (file_exists("uploads/visi/" . $foto) && $foto != '') {
        unlink("uploads/visi/" . $foto);
    }

    $hapus = mysqli_query($db, "DELETE FROM visimisi WHERE id='$id'");
    if ($hapus) {
        header("Location: index.php?p=visi");
    } else {
        echo "Gagal menghapus data: " . mysqli_error($db);
    }
}

// Proses Update
if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id'] ?? $_GET['id_edit']; // backup kalau pakai GET
        $visi = $_POST['visi'];
        $misi = $_POST['misi'];

        $query = mysqli_query($db, "SELECT foto FROM visimisi WHERE id='$id'");
        $dataLama = mysqli_fetch_array($query);
        $fotoLama = $dataLama['foto'];

        $fotoBaru = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $folder = 'uploads/visi/';

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

        $sql = mysqli_query($db, "UPDATE visimisi SET visi='$visi', misi='$misi', foto='$fotoFinal' WHERE id='$id'");

        if ($sql) {
            echo "<script>window.location='index.php?p=visi'</script>";
        } else {
            echo "Gagal mengupdate data: " . mysqli_error($db);
        }
    }
}
?>
