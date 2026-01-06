<?php
require_once '../app/models/User.php';

class Creator {
    
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) { session_start(); }
        if(!isset($_SESSION['user_id'])) { 
            header("Location: /uas/public/"); 
            exit; 
        }
    }

    public function index() {
        $userModel = new User();
        $data['user'] = $userModel->getUserById($_SESSION['user_id']); 
        $data['title'] = "Profile Developer";
        
        require_once '../app/views/layout/header.php';
        require_once '../app/views/creator/index.php';
        require_once '../app/views/layout/footer.php';
    }
    public function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
            $file = $_FILES['foto'];
            
            if ($file['error'] !== UPLOAD_ERR_OK) {
                 echo "<script>alert('Gagal upload. Error: " . $file['error'] . "'); window.location='/uas/public/creator';</script>";
                 exit;
            }

            $allowed = ['jpg', 'jpeg', 'png'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed)) {
                echo "<script>alert('Format salah! Cuma boleh JPG, JPEG, PNG.'); window.location='/uas/public/creator';</script>";
                exit;
            }
            
            if ($file['size'] > 2 * 1024 * 1024) {
                echo "<script>alert('File kegedean! Maksimal 2MB.'); window.location='/uas/public/creator';</script>";
                exit;
            }
            $newName = 'profile_' . $_SESSION['user_id'] . '_' . time() . '.' . $ext;
            
            $target = '../public/uploads/' . $newName;

            if (move_uploaded_file($file['tmp_name'], $target)) {
               
                $userModel = new User();
                $userModel->updateFoto($_SESSION['user_id'], $newName);
                
                echo "<script>alert('Mantap! Foto profil berhasil diganti.'); window.location='/uas/public/creator';</script>";
            } else {
                echo "<script>alert('Gagal memindahkan file ke folder uploads.'); window.location='/uas/public/creator';</script>";
            }
        } else {
            header("Location: /uas/public/creator");
        }
    }
}
?>
