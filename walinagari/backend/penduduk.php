

<div class="row">
<!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h2>Data Penduduk</h2>
            </div>

            <?php
            include '../database/koneksi.php';
            $aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
                switch ($aksi) {
                    case 'list':
            ?>

            <div class="card-body">
                <div class="text-end mb-3">
                    <a href="index.php?p=penduduk&aksi=input" class="btn btn-primary mb-1">tambah penduduk
                    </a>

                </div>
                
                <div class="card tbl-card">
                    <div class="card-body">
                        <div class="table table-responsive table-bordered">
                            <table class="table table-hover table-borderless mb-0">
                                <thead>
                                    <tr>
                                    <th>NO.</th>
                                    <th>NAMA PENDUDUK</th>
                                    <th>NIK</th>
                                    <th>JENIS KELAMIN</th>
                                    <th>UMUR</th>
                                    <th>PEKERJAAN</th>
                                    <th>PENDIDIKAN TERAKHIR</th>
                                    <th>STATUS PERKAWINAN</th>
                                    <th>ALAMAT</th>
                                    <th>JORONG</th>
                                    <th>AKSI</th>
                                    </tr>
                                </thead>
                                  <?php
                
                                    $tampil=mysqli_query($db,"SELECT * FROM penduduk ");
                                    $no=1;
                                    while($data=mysqli_fetch_array($tampil)){
                                    

                                
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $no;?></td>
                                        <td><?php echo $data['nama'];?></td>
                                        <td><?php echo $data['nik'];?></td>
                                        <td><?php echo $data['jenis_kelamin'];?></td>
                                        <td><?php echo $data['umur'];?></td>
                                        <td><?php echo $data['pekerjaan'];?></td>
                                        <td><?php echo $data['pendidikan_terakhir'];?></td>
                                        <td><?php echo $data['status_perkawinan'];?></td>
                                        <td><?php echo $data['alamat'];?></td>
                                        <td><?php echo $data['jorong'];?></td>
                                       
                                        <td width="15%" class="text-centered">
                                            <a href="index.php?p=penduduk&aksi=edit&id_edit=<?php echo $data['nik']?>" class="btn btn-warning">Edit</a>   
                                            <a href="proses_penduduk.php?proses=delete&id_hapus=<?php echo $data['nik']?>" class="btn btn-danger" onclick="return confirm('Yakin akan menghapus data?')">Hapus</a>   
                                        </td>
                                    </tr>

                                     <?php
                                        $no++;
                                        }
                                    ?>
                                    
                                </tbody>
                            </table>

                        </div>

                        <?php
                                break;
                            
                            case 'input':
                        ?>  
                        
                        <div class="container mt-5 mx-4">
                            <div class="row">
                                <div class="col-8">
                                    <form action="proses_penduduk.php?proses=insert" method="post">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Nama Penduduk</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="nama">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">NIK</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="nik">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                            <div class="col-sm-8">
                                                <div class="form-check">
                                                    <input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki
                                                    <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
                                                </div>
                                                
                                            </div>

                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Umur</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" name="umur">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Pekerjaan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="pekerjaan">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="pendidikan_terakhir">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Status Perkawinan</label>
                                            <div class="col-sm-8">
                                                <select name="status_perkawinan" class="form-select">
                                                    <option value="">--Pilih Status Perkawinan--</option>
                                                    <option value="Belum Kawin">Belum Kawin</option>
                                                    <option value="Kawin">Kawin</option>
                                                    <option value="Cerai">Cerai</option>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Jorong</label>
                                            <div class="col-sm-8">
                                                <select name="jorong" class="form-select">
                                                    <option value="">--Pilih Jorong--</option>
                                                    <option value="Kampung Sungai Aksa">Kampung Sungai Aksa</option>
                                                    <option value="Kampung Rimbo Panjang">Kampung Rimbo Panjang</option>
                                                    
                                                    
                                                </select>
                                            </div>
                                        </div>

                                    

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Alamat</label>
                                            <div class="col-sm-8">
                                                <textarea name="alamat" class="form-control" rows="5"></textarea>
                                            </div>
                                        </div>


                                        
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-8">

                                                <input type="submit" name="submit" class="btn btn-primary">
                                                <button type="reset" name="reset" class="btn btn-warning">Reset</button>
                                                
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>

                        <?php
                            break;
                        
                        case 'edit':
                        ?>  

                        <?php
        
                        $sql=mysqli_query($db,"SELECT * FROM penduduk WHERE nik='$_GET[id_edit]'");
                        $data=mysqli_fetch_array($sql);
                        ?>

                        <div class="container mt-5 mx-4">
                            <div class="row">
                                <div class="col-8">
                                     <form action="proses_penduduk.php?proses=update" method="post">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Nama Penduduk</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="nama" value="<?= $data['nama']?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">NIK</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="nik" value="<?= $data['nik']?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                            <div class="col-sm-8">
                                                <div class="form-check">
                                                     <input type="radio" name="jenis_kelamin" value="Laki-laki" <?= ($data['jenis_kelamin'] == 'Laki-laki') ? 'checked' : '' ?>> Laki-laki
                                                    <input type="radio" name="jenis_kelamin" value="Perempuan" <?= ($data['jenis_kelamin'] == 'Perempuan') ? 'checked' : '' ?>> Perempuan
                                                </div>
                                                
                                            </div>

                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Umur</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" name="umur" value="<?= $data['umur']?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Pekerjaan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="pekerjaan" value="<?= $data['pekerjaan']?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="pendidikan_terakhir" value="<?= $data['pendidikan_terakhir']?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Status Perkawinan</label>
                                            <div class="col-sm-8">
                                                <select name="status_perkawinan" class="form-select">
                                                    <option value="">--Pilih Status Perkawinan--</option>
                                                    <option value="Belum Kawin" <?= ($data['status_perkawinan'] == 'Belum Kawin') ? 'selected' : '' ?>>Belum Kawin</option>
                                                    <option value="Kawin" <?= ($data['status_perkawinan'] == 'Kawin') ? 'selected' : '' ?>>Kawin</option>
                                                    <option value="Cerai" <?= ($data['status_perkawinan'] == 'Cerai') ? 'selected' : '' ?>>Cerai</option>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Jorong</label>
                                            <div class="col-sm-8">
                                                <select name="jorong" class="form-select">
                                                    <option value="">--Pilih Jorong--</option>
                                                    <option value="Kampung Sungai Aksa" <?= ($data['jorong'] == 'Kampung Sungai Aksa') ? 'selected' : '' ?>>Kampung Sungai Aksa</option>
                                                    <option value="Kampung Rimbo Panjang" <?= ($data['jorong'] == 'Kampung Rimbo Panjang') ? 'selected' : '' ?>>Kampung Rimbo Panjang</option>
                                                    
                                                    
                                                </select>
                                            </div>
                                        </div>

                                    

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Alamat</label>
                                            <div class="col-sm-8">
                                                 <textarea name="alamat" class="form-control" rows="5"><?= $data['alamat'] ?></textarea>
                                            </div>
                                        </div>


                                        
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-8">

                                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                                
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <?php
                        break;
                }

            ?>

        </div>
           

        
    </div>

    
<!-- [ sample-page ] end -->
</div>