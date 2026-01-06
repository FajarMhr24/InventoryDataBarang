<?php
require_once '../app/models/Item.php';

class Dashboard {
    public function index() {
        if (session_status() == PHP_SESSION_NONE) { session_start(); }
        if(!isset($_SESSION['user_id'])) { header("Location: /uas/public/"); exit; }

        $itemModel = new Item();
        
        $data['lowStock'] = $itemModel->getLowStock();
        
        $jam = date('H');
        if ($jam >= 4 && $jam < 11) {
            $sapaan = "Selamat Pagi";
        } elseif ($jam >= 11 && $jam < 15) {
            $sapaan = "Selamat Siang";
        } elseif ($jam >= 15 && $jam < 18) {
            $sapaan = "Selamat Sore";
        } else {
            $sapaan = "Selamat Malam";
        }

        $data['sapaan'] = $sapaan;
        $data['nama'] = $_SESSION['nama'];
        $data['title'] = "Dashboard Admin";

        require_once '../app/views/layout/header.php';
        require_once '../app/views/admin/dashboardAdmin.php';
        require_once '../app/views/layout/footer.php';
    }
}
?>
