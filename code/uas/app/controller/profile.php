<?php
require_once '../app/models/User.php';

class Profile {
    
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) { session_start(); }
        if(!isset($_SESSION['user_id'])) { header("Location: /uas/public/"); exit; }
    }

    public function index() {
        $userModel = new User();
        $data['user'] = $userModel->getUserById($_SESSION['user_id']); 
        $data['title'] = "Profil Saya";
        
        require_once '../app/views/layout/header.php';
        require_once '../app/views/profile/index.php';
        require_once '../app/views/layout/footer.php';
    }

    public function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
            $file = $_FILES['foto'];
            
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png'];

            if ($file['error'] == UPLOAD_ERR_OK && in_array($ext, $allowed) && $file['size'] <= 2*1024*1024) {
                $newName = 'profile_' . $_SESSION['user_id'] . '_' . time() . '.' . $ext;
                $target = '../public/uploads/' . $newName;

                if (move_uploaded_file($file['tmp_name'], $target)) {
                   
                    $userModel = new User();
                    $userModel->updateFoto($_SESSION['user_id'], $newName);
                    
                    echo "<script>alert('Berhasil ganti foto profil!'); window.location='/uas/public/profile';</script>";
                    return;
                }
            }
            echo "<script>alert('Gagal! Cek format (JPG/PNG) & ukuran (Maks 2MB).'); window.location='/uas/public/profile';</script>";
        }
    }
}
?>
