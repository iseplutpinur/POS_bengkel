<?php
if (isset($_GET['id_level']) && isset($_GET['id_menu']) && isset($_GET['status'])) {
    $status   = $_GET['status'];
    $id_menu  = $_GET['id_menu'];
    $id_level = $_GET['id_level'];
    if ($status) {
        // menghapus akses
        $sql  = $koneksi->query("DELETE FROM `tb_user_access_sub_menu` WHERE `tb_user_access_sub_menu`.`sub_menu_id` = '$id_menu' AND `tb_user_access_sub_menu`.`id_user_level` = '$id_level'");
        if ($sql) {
            setAlert('<strong>Berhasil..! </strong>Data berhasil diubah..', 'success');
            echo '<script type = "text/javascript">window.location.href = "' . $_baseurl . '&aksi=hakakses&id=' . $id_menu . '";</script>';
        } else {
            setAlert('<strong>Gagal..! </strong>Data gagal diubah..', 'danger');
            echo '<script type = "text/javascript">window.location.href = "' . $_baseurl . '&aksi=hakakses&id=' . $id_menu . '";</script>';
        }
    } else {
        // menambah akses
        $sql  = $koneksi->query("INSERT INTO `tb_user_access_sub_menu` (`id`, `sub_menu_id`, `id_user_level`) VALUES (NULL, '$id_menu', '$id_level')");
        if ($sql) {
            setAlert('<strong>Berhasil..! </strong>Data berhasil diubah..', 'success');
            echo '<script type = "text/javascript">window.location.href = "' . $_baseurl . '&aksi=hakakses&id=' . $id_menu . '";</script>';
        } else {
            setAlert('<strong>Gagal..! </strong>Data gagal diubah..', 'danger');
            echo '<script type = "text/javascript">window.location.href = "' . $_baseurl . '&aksi=hakakses&id=' . $id_menu . '";</script>';
        }
    }
} else {
    setAlert('<strong>Gagal..! </strong>Data gagal diubah..', 'danger');
    echo '<script type = "text/javascript">window.location.href = "' . $_baseurl . '";</script>';
}
