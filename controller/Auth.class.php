<?php
class Auth extends Controller {

    function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_lengkap = $_POST['nama_lengkap'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            $authModel = $this->loadModel('AuthModel');

            $model = $this->loadModel('AuthModel');
            if ($model->register($nama_lengkap, $username, $password)) {
                $user = $authModel->getUserByUsername($username);
                $new_user_id = $user['id'];
                $budgetModel = $this->loadModel('BudgetModel');
                $budgetModel->createDefaultBudgetsForUser($new_user_id);
                header("Location: index.php?c=Auth&m=login&status=reg_success");
                exit();
            } else {
                header("Location: index.php?c=Auth&m=register&status=reg_failed");
                exit();
            }
        } else {
            $this->loadView('register.php');
        }
    }

    function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $model = $this->loadModel('AuthModel');
            $user = $model->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nama'] = $user['nama_lengkap'];
                
                header("Location: index.php?c=Dashboard&m=index");
                exit();
            } else {
                header("Location: index.php?c=Auth&m=login&status=login_failed");
                exit();
            }
        } else {
            $this->loadView('login.php');
        }
    }

    function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?c=Auth&m=login");
        exit();
    }
}
?>