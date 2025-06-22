<?php
class Transaksi extends Controller {
    function form() {
        $this->loadView('form.php');
    }

    function insert() {
        $user_id = $_SESSION['user_id'];

        $jumlah = $_POST['jumlah'];
        $jenis = $_POST['jenis'];
        $kategori = ($_POST['kategori'] === 'lainnya') ? $_POST['kategoriBaru'] : $_POST['kategori'];
        $tanggal = $_POST['tanggal'];
        $deskripsi = $_POST['deskripsi'];

        $model = $this->loadModel('TransaksiModel');
        $model->insert($jumlah, $jenis, $kategori, $tanggal, $deskripsi, $user_id);

        header("Location: index.php?c=Transaksi&m=berhasil");
        exit();
    }

    function berhasil() {
        $this->loadView('berhasil.php');
    }

    function daftar() {
        $user_id = $_SESSION['user_id'];

        $model = $this->loadModel('TransaksiModel');
        $data['transaksi'] = $model->getAll($user_id);
        $this->loadView('daftar.php', $data);
    }

    function budget() {
        $this->loadView('budget.php');
    }
}
?>