<?php
class Budgeting extends Controller {
    function index() {
        $user_id = $_SESSION['user_id'];

        $model = $this->loadModel('BudgetModel');
        $data['budget'] = $model->getAll($user_id);
        $this->loadView('budget.php', $data);
    }

    function edit() {
        $user_id = $_SESSION['user_id'];
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            die("ID tidak diberikan");
        }

        $model = $this->loadModel('BudgetModel');
        $data['budget'] = $model->getById($id, $user_id);

        if (!$data['budget']) {
            die("Data dengan ID $id tidak ditemukan di tabel budget.");
        }

        $this->loadView('budget-edit.php', $data);
    }

    function update() {
        $user_id = $_SESSION['user_id'];

        $id = $_POST['id'];
        $deskripsi = $_POST['deskripsi'];
        $jumlah = $_POST['jumlah'];

        $model = $this->loadModel('BudgetModel');
        $model->update($id, $deskripsi, $jumlah, $user_id);

        header("Location: index.php?c=Budgeting&m=index");
        exit();
    }
}
?>