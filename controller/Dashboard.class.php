<?php
class Dashboard extends Controller {
    function index() {
        $user_id = $_SESSION['user_id'];

        $model = $this->loadModel('DashboardModel');

        $bulan = date('n');
        $tahun = date('Y');

        $data['summary'] = $model->getMonthlySummary($user_id);
        $data['saldo'] = $model->getSaldoAkhir($user_id);
        $data['budget'] = $model->getAllBudget($user_id);
        $data['pengeluaran'] = $model->getTotalPengeluaranPerKategori($bulan, $tahun, $user_id);

        $this->loadView('dashboard.php', $data);
    }
}
?>