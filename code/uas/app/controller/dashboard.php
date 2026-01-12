<?php 
// HAPUS "extends Controller" kalau di Itemcontroller gak ada
class Dashboard { 

    public function index()
    {
        // 1. SET TIMEZONE 
        date_default_timezone_set('Asia/Jakarta');

        // 2. LOGIKA JAM
        $jam = date('H');
        if ($jam >= 5 && $jam < 11) {
            $sapaan = "Selamat Pagi";
        } elseif ($jam >= 11 && $jam < 15) {
            $sapaan = "Selamat Siang";
        } elseif ($jam >= 15 && $jam < 18) {
            $sapaan = "Selamat Sore";
        } else {
            $sapaan = "Selamat Malam";
        }

        // 3. DATA DASAR
        $data['judul'] = 'Dashboard';
        // Pastikan session udah start di index.php
        $data['nama'] = isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : 'Admin'; 
        $data['sapaan'] = $sapaan;
        
        // 4. PANGGIL MODEL
        require_once '../app/models/Item.php';
        $itemModel = new Item();
        
        // Ambil Data Low Stock
        $data['lowStock'] = $itemModel->getLowStock(); 

        // --- [BARU] LOGIKA CHART STATISTIK ---
        // Ambil data jumlah barang per kategori
        $stats = $itemModel->getItemCountByCategory(); 

        // Pisahin jadi dua array: Label (Nama) dan Data (Angka)
        $labels = [];
        $totals = [];
        
        foreach ($stats as $row) {
            $labels[] = $row['nama_kategori'];
            $totals[] = $row['total'];
        }

        // Encode ke JSON biar bisa dibaca Javascript di View
        $data['chart_labels'] = json_encode($labels);
        $data['chart_data'] = json_encode($totals);
        // -------------------------------------

        // 5. LOAD VIEW
        // Kita extract data biar jadi variabel ($nama, $chart_labels, dll)
        extract($data);

        require_once '../app/views/layout/header.php';
        require_once '../app/views/admin/dashboardAdmin.php'; 
        require_once '../app/views/layout/footer.php';
    }
}
?>
