<?php
if (isset($_POST['simpan'])) {
    // memperoses data ubah
    $nama_barang = $_POST['nama_barang'];
    $kode_barang = $_POST['kode_barang'];
    $harga_beli  = $_POST['harga_beli'];
    $harga_jual  = $_POST['harga_jual'];
    $stok        = $_POST['stok'];
    $kategori    = $_POST['kategori'];
    $fotoasal    = $_POST['fotoasal'];
    $id_barang   = $_POST['id_barang'];
    $gambar      = $_FILES['gambar']['name'];
    $lokasi      = $_FILES['gambar']['tmp_name'];

    if (!empty($lokasi)) {
        // generate nama file
        $ekteksiGambar = explode('.', $gambar);
        $ekteksiGambar = strtolower(end($ekteksiGambar));
        $namaFileBaru  = $kode_barang . "_" . uniqid() . '.' . $ekteksiGambar;
        $upload        = move_uploaded_file($lokasi, "images/master_data_barang/" . $namaFileBaru);

        // hapus file yang sudah ada
        if (file_exists("images/master_data_barang/$fotoasal")) {
            unlink("images/master_data_barang/$fotoasal");
        }
        $upload       = move_uploaded_file($lokasi, "images/barang/" . $gambar);
        $querybuilder = " UPDATE `tb_barang` SET
                                `nama_barang`           = '$nama_barang',
                                `harga_beli`            = '$harga_beli',
                                `harga_jual`            = '$harga_jual',
                                `stok`                  = '$stok',
                                `gambar`                = '$namaFileBaru',
                                `id_kategori`           = '$kategori'
                          WHERE `tb_barang`.`id_barang` = '$id_barang'
        ";

        $sql = $koneksi->query($querybuilder);
        if ($sql) {
            setAlert('Berhasil..! ', 'Data berhasil diubah..', 'success');
            echo '<script type = "text/javascript">window.location.href = "' . $_baseurl . '";</script>';
        } else {
            setAlert('Gagal..! ', 'Data gagal diubah..', 'danger');
            echo '<script type = "text/javascript">window.location.href = "' . $_baseurl . '";</script>';
        }
    } else {
        $querybuilder = " UPDATE `tb_barang` SET
                                `nama_barang`           = '$nama_barang',
                                `harga_beli`            = '$harga_beli',
                                `harga_jual`            = '$harga_jual',
                                `stok`                  = '$stok',
                                `id_kategori`           = '$kategori'
                          WHERE `tb_barang`.`id_barang` = '$id_barang'
        ";
        $sql = $koneksi->query($querybuilder);
        if ($sql) {
            setAlert('Berhasil..! ', 'Data berhasil diubah..', 'success');
            echo '<script type = "text/javascript">window.location.href = "' . $_baseurl . '";</script>';
        } else {
            setAlert('Gagal..! ', 'Data gagal diubah..', 'danger');
            echo '<script type = "text/javascript">window.location.href = "' . $_baseurl . '";</script>';
        }
    }
}

if (isset($_GET['id_barang'])) {
    // Menyiapkan data ubah
    $id_barang   = $_GET['id_barang'];
    $sql         = $koneksi->query("select * from tb_barang where id_barang='$id_barang'");
    $tampil      = $sql->fetch_assoc();
} else {
    setAlert('Gagal..! ', 'Data gagal diubah..', 'danger');
    echo '<script type = "text/javascript">window.location.href = "' . $_baseurl . '";</script>';
}
?>

<script type="text/javascript">
    function validasi(form) {
        if (form.nama_barang.value == "") {
            setAlert('Peringatan..!', "Nama Barang Tidak Boleh Kosong", 'danger');
            form.nama_barang.focus();
            return (false);
        }

        if (form.harga_beli.value == "") {
            setAlert('Peringatan..!', "Harga Beli Tidak Boleh Kosong", 'danger');
            form.harga_beli.focus();
            return (false);
        }

        if (form.harga_jual.value <= form.harga_beli.value) {
            setAlert('Peringatan..!', "Harga jual harus lebih tinggi dari harga beli", 'danger');
            form.harga_jual.focus();
            return (false);
        }

        if (form.harga_jual.value == "") {
            setAlert('Peringatan..!', "Harga Jual Tidak Boleh Kosong", 'danger');
            form.harga_jual.focus();
            return (false);
        }

        if (form.stok.value == "" || form.stok.value < 1) {
            setAlert('Peringatan..!', "Stok Tidak Boleh Kosong", 'danger');
            form.stok.focus();
            return (false);
        }
        return (true);
    }
</script>

<div class="panel panel-default">
    <div class="panel-heading">
        Ubah Data barang
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" enctype="multipart/form-data" onsubmit="return validasi(this)">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama barang</label>
                                    <input class="form-control" name="nama_barang" value="<?php echo $tampil['nama_barang']; ?>" />
                                    <input hidden="" name="id_barang" value="<?php echo $tampil['id_barang']; ?>" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input class="form-control" name="harga_beli" value="<?php echo $tampil['harga_beli']; ?>" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Harga Jual</label>
                                    <input class="form-control" name="harga_jual" value="<?php echo $tampil['harga_jual']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input readonly="" class="form-control" type="text" name="kode_barang" value="<?php echo $tampil['kode_barang']; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="stock">Stok</label>
                                    <input class="form-control" type="text" name="stok" value="<?php echo $tampil['stok']; ?>" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="kategori">
                                        <option>== Pilih ==</option>
                                        <?php
                                        $query = $koneksi->query("SELECT * FROM tb_kategori ORDER by id_kategori");
                                        while ($kategori = $query->fetch_assoc()) {
                                            if ($tampil['id_kategori'] == $kategori['id_kategori']) {
                                                echo '<option selected="" value="' . $kategori['id_kategori'] . '">' . $kategori['kategori'] . '</option>';
                                            } else {
                                                echo '<option value="' . $kategori['id_kategori'] . '">' . $kategori['kategori'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" class="file-control-file" name="gambar" id="gambar" />
                                    <input type="text" name="fotoasal" value="<?= $tampil['gambar']; ?>" hidden="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <input type="submit" name="simpan" value="Ubah" class="btn btn-primary btn-block">
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>