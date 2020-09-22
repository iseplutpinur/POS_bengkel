<?php
function terlambat($tgl_dateline, $tgl_kembali)
{

	$tgl_dateline_pcs = explode("-", $tgl_dateline);
	$tgl_dateline_pcs = $tgl_dateline_pcs[2] . "-" . $tgl_dateline_pcs[1] . "-" . $tgl_dateline_pcs[0];
	$tgl_kembali_pcs  = explode("-", $tgl_kembali);
	$tgl_kembali_pcs  = $tgl_kembali_pcs[2] . "-" . $tgl_kembali_pcs[1] . "-" . $tgl_kembali_pcs[0];
	$selisih          = strtotime($tgl_kembali_pcs) - strtotime($tgl_dateline_pcs);
	$selisih          = $selisih / 86400;

	if ($selisih >= 1) {
		$hasil_tgl = floor($selisih);
	} else {
		$hasil_tgl = 0;
	}
	return $hasil_tgl;
}

function query($query)
{
	global $koneksi;
	$result = mysqli_query($koneksi, $query);
	if ($result) {
		if ($result->num_rows > 0) {
			$rows = [];
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$rows[] = $row;
			}
			return $rows;
		} else return false;
	} else return false;
}


function cekLogin($data = false)
{
	if ($data == false) return false;
	$id     = $data['id'];
	$result = query("SELECT * FROM `tb_user` WHERE id='$id'");
	if ($result) {
		if ($data['user'] == $result[0]['username'] && $data['pass'] == $result[0]['password']) {
			return true;
		} else return false;
	} else return false;
}


function setAlert($title = "", $conte = "", $color = "primary")
{
	$_SESSION['alert']['title'] = $title;
	$_SESSION['alert']['color'] = $color;
	$_SESSION['alert']['conte'] = $conte;
	$_SESSION['alert']['show'] = true;
}

function getAlert()
{
	$alert_color = $_SESSION['alert']['color'];
	$alert_title = $_SESSION['alert']['title'];
	$alert_conte = $_SESSION['alert']['conte'];

	echo 'setAlert("' . $alert_title . '", "' . $alert_conte . '", "' . $alert_color . '")';
	$_SESSION['alert']['show'] = false;
}

function getStokBarang($id)
{
	// barang masuk ========================================================
	$barang['masuk']['data'] = query("SELECT barang_masuk_jumlah FROM tb_barang_masuk WHERE tb_barang_masuk.id_barang_data = '$id'");
	$barang['masuk']['data'] = ($barang['masuk']['data']) ? $barang['masuk']['data'] : [];
	$barang['masuk']['jumlah'] = 0;
	foreach ($barang['masuk']['data'] as $b) {
		$barang['masuk']['jumlah'] += $b['barang_masuk_jumlah'];
	}
	// barang masuk ========================================================

	// barang masuk ========================================================
	$barang['keluar']['data'] = query("SELECT barang_keluar_jumlah FROM tb_barang_keluar WHERE tb_barang_keluar.id_barang_data = '$id'");
	$barang['keluar']['data'] = ($barang['keluar']['data']) ? $barang['keluar']['data'] : [];
	$barang['keluar']['jumlah'] = 0;
	foreach ($barang['keluar']['data'] as $b) {
		$barang['keluar']['jumlah'] += $b['barang_keluar_jumlah'];
	}
	// barang keluar ========================================================
	return $barang['masuk']['jumlah'] - $barang['keluar']['jumlah'];
}