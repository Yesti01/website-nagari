<?php
include '../database/koneksi.php';
?>

<div class="row">
<!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h2>Visi & Misi</h2>
            </div>
            <?php
            include '../database/koneksi.php';
            $aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
                switch ($aksi) {
                    case 'list':
            ?>

            <div class="card-body">
                <div class="text-end mb-3">
                    <a href="index.php?p=visi&aksi=input" class="btn btn-primary mb-1">tambah visi misi
                    </a>

                </div>
                
                <div class="card tbl-card">
                    <div class="card-body">
                        <div class="table table-responsive table-bordered">
                            <table class="table table-hover table-borderless mb-0">
                                <thead>
                                    <tr>
                                    <th>NO.</th>
                                    <th>VISI</th>
                                    <th>MISI</th>
                                    <th>FOTO</th>
                                
                                    <th>AKSI</th>
                                    </tr>
                                </thead>
                                  <?php
                
                                    $tampil=mysqli_query($db,"SELECT * FROM visimisi ");
                                    $no=1;
                                    while($data=mysqli_fetch_array($tampil)){
                                    

                                
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $no;?></td>
                                        <td><?php echo $data['visi'];?></td>
                                        <td><?php echo $data['misi'];?></td>
                                        <td>
                                            <?php if ($data['foto'] != ''): ?>
                                                <img src="uploads/visi/<?= $data['foto'] ?>" width="80">
                                            <?php else: ?>
                                                <span>Tidak ada foto</span>
                                            <?php endif; ?>
                                        </td>
                                       
                                       
                                        <td width="15%" class="text-centered">
                                            <a href="index.php?p=visi&aksi=edit&id_edit=<?php echo $data['id']?>" class="btn btn-warning">Edit</a>   
                                            <a href="proses_visi.php?proses=delete&id_hapus=<?php echo $data['id']?>" class="btn btn-danger" onclick="return confirm('Yakin akan menghapus data?')">Hapus</a>   
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
                                    <form action="proses_visi.php?proses=insert" method="post" enctype="multipart/form-data">

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Visi</label>
                                            <div class="col-sm-8">
                                                <textarea name="visi" class="form-control" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Misi</label>
                                            <div class="col-sm-8">
                                                <textarea name="misi" class="form-control" rows="5"></textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Foto</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control" name="foto" id="foto" accept="image/*" onchange="previewFoto(event)">
                                                <img id="preview" src="#" alt="Preview Foto" style="display:none; margin-top:10px; max-width: 150px;">
                                            </div>
                                        </div>

                                        <script>
                                        function previewFoto(event) {
                                            const reader = new FileReader();
                                            const preview = document.getElementById('preview');
                                            
                                            reader.onload = function(){
                                                preview.src = reader.result;
                                                preview.style.display = 'block';
                                            };

                                            reader.readAsDataURL(event.target.files[0]);
                                        }
                                        </script>

                                        
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
        
                        $sql=mysqli_query($db,"SELECT * FROM visimisi WHERE id='$_GET[id_edit]'");
                        $data=mysqli_fetch_array($sql);
                        ?>

                        <div class="container mt-5 mx-4">
                            <div class="row">
                                <div class="col-8">
                                     <form action="proses_visi.php?proses=update&id_edit=<?= $data['id'] ?>" method="post" enctype="multipart/form-data">
                                       <div class="row mb-3">

                                       <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Visi</label>
                                            <div class="col-sm-8">
                                                <textarea name="visi" class="form-control" rows="5"><?= $data['visi'] ?></textarea>
                                            </div>
                                        </div>

                                        
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Misi</label>
                                            <div class="col-sm-8">
                                                <textarea name="misi" class="form-control" rows="5"><?= $data['misi'] ?></textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Foto</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control" name="foto" id="foto" accept="image/*" onchange="previewFoto(event)">

                                                <!-- Preview foto baru -->
                                                <img id="preview" src="#" alt="Preview Foto" style="display:none; margin-top:10px; max-width: 150px;">

                                                <!-- Foto lama -->
                                                <p class="mt-2" id="oldFotoWrapper" style="<?= $data['foto'] ? '' : 'display:none;' ?>">
                                                    <?php if ($data['foto']): ?>
                                                        <img id="oldFoto" src="uploads/struktur/<?= $data['foto'] ?>" width="80" alt="Foto Lama">
                                                    <?php else: ?>
                                                        Tidak ada
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                        </div>

                                        <script>
                                        function previewFoto(event) {
                                            const reader = new FileReader();
                                            const preview = document.getElementById('preview');
                                            const oldFotoWrapper = document.getElementById('oldFotoWrapper');

                                            reader.onload = function(){
                                                preview.src = reader.result;
                                                preview.style.display = 'block';

                                                // Sembunyikan foto lama saat preview baru muncul
                                                if (oldFotoWrapper) {
                                                    oldFotoWrapper.style.display = 'none';
                                                }
                                            };

                                            reader.readAsDataURL(event.target.files[0]);
                                        }
                                        </script>

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