<?php
require_once '../app/models/User.php';

class Auth {
    public function index() {
        require_once '../app/views/login.php';
    }

    public function process() {
        if(isset($_POST['username'])) {
            $userModel = new User();
            $user = $userModel->login($_POST['username'], $_POST['password']);

            if($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nama'] = $user['nama_lengkap'];
                header("Location: /uas/public/dashboard");
            } else {
                echo "<script>alert('Login Gagal'); window.location='/uas/public/';</script>";
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: /uas/public/");
    }
}
?>
