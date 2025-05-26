<?php
include '../database/koneksi.php';

// Proses Insert
if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $judul = $_POST['judul'];
        $isi = $_POST['isi'];

        // Handle foto upload
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $folder = 'uploads/berita/';

        if (!empty($foto)) {
            if (move_uploaded_file($tmp, $folder . $foto)) {
    // sukses upload
            } else {
                echo "Gagal upload file. Cek permission folder atau ukuran file.";
            }

        } else {
            $foto = ''; // kosongkan jika tidak ada gambar
        }
        

        $sql = mysqli_query($db, "INSERT INTO berita (judul,isi,foto) VALUES ('$judul','$isi','$foto')");

        if ($sql) {
            echo "<script>window.location='index.php?p=berita'</script>";
        } else {
            echo "Gagal menambahkan data: " . mysqli_error($db);
        }
    }
}

// Proses Delete
if ($_GET['proses'] == 'delete') {
    $id = $_GET['id_hapus'];

    // Ambil nama file foto
    $query = mysqli_query($db, "SELECT foto FROM berita WHERE id='$id'");
    $data = mysqli_fetch_array($query);
    $foto = $data['foto'];

    // Hapus dari folder
    if (file_exists("uploads/berita/" . $foto) && $foto != '') {
        unlink("uploads/berita/" . $foto);
    }

    $hapus = mysqli_query($db, "DELETE FROM berita WHERE id='$id'");

    if ($hapus) {
        header("Location: index.php?p=berita");
    } else {
        echo "Gagal menghapus data: " . mysqli_error($db);
    }
}

// Proses Update
if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id'] ?? $_GET['id_edit']; // backup kalau pakai GET
        $judul = $_POST['judul'];
        $isi = $_POST['isi'];

        // Ambil data lama
        $query = mysqli_query($db, "SELECT foto FROM berita WHERE id='$id'");
        $dataLama = mysqli_fetch_array($query);
        $fotoLama = $dataLama['foto'];

        $fotoBaru = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $folder = 'uploads/berita/';

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
        $sql = mysqli_query($db, "UPDATE berita SET judul='$judul', isi='$isi', foto='$fotoFinal'  WHERE id='$id'");

        if ($sql) {
            echo "<script>window.location='index.php?p=berita'</script>";
        } else {
            echo "Gagal mengupdate data: " . mysqli_error($db);
        }
    }
}
?>
