<?php
include '../database/koneksi.php';

// Proses Insert
if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $isi = $_POST['isi'];

        $foto = $_FILES['foto']['name'];
        echo "<pre>";
        var_dump($_FILES);
        echo "</pre>";
        $tmp = $_FILES['foto']['tmp_name'];
        $folder = 'uploads/sejarah/';

        if (!empty($foto)) {
            if (move_uploaded_file($tmp, $folder . $foto)) {
    // sukses upload
            } else {
                echo "Gagal upload file. Cek permission folder atau ukuran file.";
            }
        } else {
            $foto = ''; // kosongkan jika tidak ada gambar
        }
        

        $sql = mysqli_query($db, "INSERT INTO sejarah (isi,foto) VALUES ('$isi','$foto')");

        if ($sql) {
            echo "<script>window.location='index.php?p=sejarah'</script>";
        } else {
            echo "Gagal menambahkan data: " . mysqli_error($db);
        }
    }
}

// Proses Delete
if ($_GET['proses'] == 'delete') {
    $id = $_GET['id_hapus'];

    // Ambil nama file foto
    $query = mysqli_query($db, "SELECT foto FROM sejarah WHERE id='$id'");
    $data = mysqli_fetch_array($query);
    $foto = $data['foto'];

    // Hapus dari folder
    if (file_exists("uploads/sejarah/" . $foto) && $foto != '') {
        unlink("uploads/sejarah/" . $foto);
    }



    $hapus = mysqli_query($db, "DELETE FROM sejarah WHERE id='$id'");

    if ($hapus) {
        header("Location: index.php?p=sejarah");
    } else {
        echo "Gagal menghapus data: " . mysqli_error($db);
    }
}

// Proses Update
if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
         $id = $_POST['id'] ?? $_GET['id_edit']; // backup kalau pakai GET
        $isi = $_POST['isi'];


        // Ambil data lama
        $query = mysqli_query($db, "SELECT foto FROM sejarah WHERE id='$id'");
        $dataLama = mysqli_fetch_array($query);
        $fotoLama = $dataLama['foto'];

        $fotoBaru = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $folder = 'uploads/sejarah/';

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

        //update
        $sql = mysqli_query($db, "UPDATE sejarah SET isi='$isi', foto='$fotoFinal' WHERE id='$id'");

        if ($sql) {
            echo "<script>window.location='index.php?p=sejarah'</script>";
        } else {
            echo "Gagal mengupdate data: " . mysqli_error($db);
        }
    }
}
?>
