<?php
$barang = query('SELECT `barang_data_nama`,`id_barang_data` FROM tb_barang_data');
$konsumen = query('SELECT `barang_konsumen_nama`,`id_barang_konsumen` FROM tb_barang_konsumen');

?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Cetak Laporan Penjualan Barang
            </div>
            <div class="panel-body">
                <form action="./page/cetak/cetak.php?laporan=barang_keluar" target="blank" method="post">
                    <div class="row">
                        <h4 style="padding:3px 0; margin:0; text-align:center;">Kostumisasi</h4>
                        <hr>
                        <div class="col-md-4">
                            <div class="container-fluid">
                                <h4 style="padding:3px 0; margin:0; text-align:center;">Tabel</h4>
                                <table width="100%" onclick="tableCapture()" id="tabel_tabel">
                                    <tr>
                                        <td style="white-space:nowrap"><label for="tabel_nama" class="form-check-label">Nama Barang</label></td>
                                        <td style="text-align:right;"><input type="checkbox" class="checkbox checkbox_tabel" id="tabel_nama" checked="" name="tabel_nama"></td>
                                    </tr>
                                    <tr>
                                        <td style="white-space:nowrap"><label for="tabel_konsumen" class="form-check-label">Nama konsumen</label></td>
                                        <td style="text-align:right;"><input type="checkbox" class="checkbox checkbox_tabel" id="tabel_konsumen" checked="" name="tabel_konsumen"></td>
                                    </tr>
                                    <tr>
                                        <td style="white-space:nowrap"><label for="tabel_kode" class="form-check-label">Kode Transaksi</label></td>
                                        <td style="text-align:right;"><input type="checkbox" class="checkbox checkbox_tabel" id="tabel_kode" name="tabel_kode"></td>
                                    </tr>
                                    <tr>
                                        <td style="white-space:nowrap"><label for="tabel_jumlah" class="form-check-label">Jumlah</label></td>
                                        <td style="text-align:right;"><input type="checkbox" class="checkbox checkbox_tabel" id="tabel_jumlah" checked="" name="tabel_jumlah"></td>
                                    </tr>
                                    <tr>
                                        <td style="white-space:nowrap"><label for="tabel_harga" class="form-check-label">Harga</label></td>
                                        <td style="text-align:right;"><input type="checkbox" class="checkbox checkbox_tabel" id="tabel_harga" checked="" name="tabel_harga"></td>
                                    </tr>
                                    <tr>
                                        <td style="white-space:nowrap"><label for="tabel_total" class="form-check-label">Total</label></td>
                                        <td style="text-align:right;"><input type="checkbox" class="checkbox checkbox_tabel" id="tabel_total" checked="" name="tabel_total"></td>
                                    </tr>
                                    <tr>
                                        <td style="white-space:nowrap"><label for="tabel_tanggal" class="form-check-label">Tanggal</label></td>
                                        <td style="text-align:right;"><input type="checkbox" class="checkbox checkbox_tabel" id="tabel_tanggal" checked="" name="tabel_tanggal"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <hr>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" onclick="tableCapture()">
                                    <tr>
                                        <td style="white-space:nowrap"><label for="tabel_all" class="form-check-label">Pilih Semua</label></td>
                                        <td style="text-align:right;"><input type="checkbox" class="checkbox" id="tabel_all" name="tabel_all"></td>
                                    </tr>
                                </table>
                                <hr>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="container-fluid">
                                <h4 style="padding:3px 0; margin:0; text-align:center;">Tanggal Daftar</h4>
                                <div id="tanggal_tabel">
                                    <div class="form-group">
                                        <label>Dari Tanggal</label>
                                        <input class="form-control" type="date" name="tanggal_dari" id="tanggal_dari" value="<?= date("yy-m-d"); ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Sampai Tanggal</label>
                                        <input class="form-control" type="date" name="tanggal_sampai" id="tanggal_sampai" value="<?= date("yy-m-d"); ?>" />
                                    </div>
                                    <hr>
                                </div>
                                <table width="100%">
                                    <tr>
                                        <td style="white-space:nowrap"><label for="tanggal_all" class="form-check-label">Semua Tanggal</label></td>
                                        <td style="text-align:right;"><input type="checkbox" class="checkbox" id="tanggal_all" name="tanggal_all" checked="" onchange="cektanggal(this)"></td>
                                    </tr>
                                </table>
                                <hr>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="container-fluid">
                                <h4 style="padding:3px 0; margin:0; text-align:center;">Konsumen</h4>
                                <table width="100%" onclick="konsumenCapture()" id="konsumen_tabel">
                                    <?php if ($konsumen) {
                                        foreach ($konsumen as $k) { ?>
                                            <tr>
                                                <td style="white-space:nowrap"><label for="konsumen_<?php echo $k['id_barang_data']; ?>" class="form-check-label"><?php echo $k['barang_konsumen_nama']; ?></label></td>
                                                <td style="text-align:right;"><input type="checkbox" class="checkbox checkbox_kategori" id="konsumen_<?php echo $k['id_barang_data']; ?>" name="konsumen_<?php echo $k['id_barang_konsumen']; ?>" checked=""></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                    <tr>
                                        <td colspan="2">
                                            <hr>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" onclick="konsumenCapture()">
                                    <tr>
                                        <td style="white-space:nowrap"><label for="konsumen_all" class="form-check-label">Semua konsumen</label></td>
                                        <td style="text-align:right;"><input type="checkbox" class="checkbox" id="konsumen_all" name="konsumen_all" checked=""></td>
                                    </tr>
                                </table>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container-fluid">
                            <div class="col-md-4">
                                <div class="container-fluid">
                                    <h4 style="padding:3px 0; margin:0; text-align:center;">Barang</h4>
                                    <table width="100%" onclick="barangCapture()" id="data_tabel">
                                        <?php if ($barang) {
                                            foreach ($barang as $k) { ?>
                                                <tr>
                                                    <td style="white-space:nowrap"><label for="data_<?php echo $k['id_barang_data']; ?>" class="form-check-label"><?php echo $k['barang_data_nama']; ?></label></td>
                                                    <td style="text-align:right;"><input type="checkbox" class="checkbox checkbox_kategori" id="data_<?php echo $k['id_barang_data']; ?>" name="data_<?php echo $k['id_barang_data']; ?>" checked=""></td>
                                                </tr>
                                        <?php }
                                        } ?>
                                        <tr>
                                            <td colspan="2">
                                                <hr>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%" onclick="barangCapture()">
                                        <tr>
                                            <td style="white-space:nowrap"><label for="data_all" class="form-check-label">Semua Barang</label></td>
                                            <td style="text-align:right;"><input type="checkbox" class="checkbox" id="data_all" name="data_all" checked=""></td>
                                        </tr>
                                    </table>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-block" type="submit" name="cetak"><i class="fa fa-print"></i> Cetak Laporan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function tableCapture() {
        const tabel_checkbox = document.querySelectorAll('.checkbox_tabel');
        let tabel_all_btn = document.querySelector('#tabel_all');

        const tabelVisib = (bool = true) => {
            const tabel_tabel = document.querySelector('#tabel_tabel');
            if (bool) tabel_tabel.removeAttribute('hidden');
            else tabel_tabel.setAttribute('hidden', '');
        }

        const tabel_checkedall = () => {
            tabel_checkbox.forEach(element => {
                element.checked = true;
            });
            tabelVisib(false);
        }

        const tabel_periksa = () => {
            let cek = true;
            tabel_checkbox.forEach(element => {
                if (!element.checked) cek = false;
            });
            if (cek) {
                tabelVisib(false);
                tabel_all_btn.checked = cek;
            }
        }

        tabel_checkbox.forEach(element => {
            element.addEventListener('change', function() {
                tabel_periksa();
            });
        });

        tabel_all_btn.addEventListener('change', function() {
            if (this.checked) tabel_checkedall();
            else tabelVisib();
        });
    }

    function barangCapture() {
        const data_checkbox = document.querySelectorAll('.checkbox_kategori');
        let data_all_btn = document.querySelector('#data_all');

        const tabelVisib = (bool = true) => {
            const data_tabel = document.querySelector('#data_tabel');
            if (bool) data_tabel.removeAttribute('hidden');
            else data_tabel.setAttribute('hidden', '');
        }

        const data_checkedall = () => {
            data_checkbox.forEach(element => {
                element.checked = true;
            });
            tabelVisib(false);
        }

        const data_periksa = () => {
            let cek = true;
            data_checkbox.forEach(element => {
                if (!element.checked) cek = false;
            });
            if (cek) {
                tabelVisib(false);
                data_all_btn.checked = cek;
            }
        }

        data_checkbox.forEach(element => {
            element.addEventListener('change', function() {
                data_periksa();
            });
        });

        data_all_btn.addEventListener('change', function() {
            if (this.checked) data_checkedall();
            else tabelVisib();
        });
    }

    function konsumenCapture() {
        const konsumen_checkbox = document.querySelectorAll('.checkbox_kategori');
        let konsumen_all_btn = document.querySelector('#konsumen_all');

        const tabelVisib = (bool = true) => {
            const konsumen_tabel = document.querySelector('#konsumen_tabel');
            if (bool) konsumen_tabel.removeAttribute('hidden');
            else konsumen_tabel.setAttribute('hidden', '');
        }

        const konsumen_checkedall = () => {
            konsumen_checkbox.forEach(element => {
                element.checked = true;
            });
            tabelVisib(false);
        }

        const konsumen_periksa = () => {
            let cek = true;
            konsumen_checkbox.forEach(element => {
                if (!element.checked) cek = false;
            });
            if (cek) {
                tabelVisib(false);
                konsumen_all_btn.checked = cek;
            }
        }

        konsumen_checkbox.forEach(element => {
            element.addEventListener('change', function() {
                konsumen_periksa();
            });
        });

        konsumen_all_btn.addEventListener('change', function() {
            if (this.checked) konsumen_checkedall();
            else tabelVisib();
        });
    }


    function cektanggal(data = document.querySelector('#tanggal_all')) {
        let tanggal_dari = document.querySelector('#tanggal_dari');
        let tanggal_sampai = document.querySelector('#tanggal_sampai');
        const tanggal_tabel = document.querySelector('#tanggal_tabel');
        if (data.checked) {
            tanggal_dari.setAttribute('readonly', '');
            tanggal_sampai.setAttribute('readonly', '');
            tanggal_tabel.setAttribute('hidden', '');
        } else {
            tanggal_dari.removeAttribute('readonly');
            tanggal_sampai.removeAttribute('readonly');
            tanggal_tabel.removeAttribute('hidden');
        }
    }
    cektanggal();
    if (!document.querySelector('#data_all').checked) document.querySelector('#data_tabel').removeAttribute('hidden');
    else document.querySelector('#data_tabel').setAttribute('hidden', '');
    if (!document.querySelector('#konsumen_all').checked) document.querySelector('#konsumen_tabel').removeAttribute('hidden');
    else document.querySelector('#konsumen_tabel').setAttribute('hidden', '');
</script>