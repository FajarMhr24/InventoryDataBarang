<?php
require_once '../app/models/Item.php';

class Itemcontroller {
    
    public function index($page = 1) {
        if(!isset($_SESSION['user_id'])) { header("Location: /uas/public/"); exit; }

        $itemModel = new Item();
        

        $keyword = isset($_GET['search']) ? $_GET['search'] : null;
        $limit = 5; 
        $page = (int)$page;
        $start = ($page > 1) ? ($page * $limit) - $limit : 0;

        $data['items'] = $itemModel->getAllPaginated($start, $limit, $keyword);
        $data['categories'] = $itemModel->getCategories();

        $totalData = $itemModel->countAll($keyword);
        $data['totalPages'] = ceil($totalData / $limit);
        $data['currentPage'] = $page;
        $data['keyword'] = $keyword; 

        require_once '../app/views/layout/header.php';
        require_once '../app/views/admin/items_list.php';
        require_once '../app/views/layout/footer.php';
    }

    public function simpan() {
    if(isset($_POST['simpan'])) {
        require_once '../app/models/Item.php';
        $itemModel = new Item();
        
        $data = [
            'kode' => $_POST['kode_barang'],
            'nama' => $_POST['nama_barang'],
            'stok' => $_POST['stok'],
            
            // UBAH BARIS INI JADI GINI:
            'category_id' => $_POST['category_id'] 
        ];
        
        $itemModel->add($data);
    }
    header("Location: /uas/public/itemcontroller");
}
    public function hapus($id) {
        $itemModel = new Item();
        $itemModel->hapus($id);
        header("Location: /uas/public/itemcontroller");
    }
    public function edit($id) {
        if(!isset($_SESSION['user_id'])) { header("Location: /uas/public/"); exit; }
        
        $itemModel = new Item();
        $data['item'] = $itemModel->getById($id);      
        $data['categories'] = $itemModel->getCategories(); 
        
        require_once '../app/views/layout/header.php';
        require_once '../app/views/admin/edit_item.php'; 
        require_once '../app/views/layout/footer.php';
    }

    public function update() {
        if(isset($_POST['update'])) {
            $itemModel = new Item();
            $data = [
                'id' => $_POST['id'],
                'kode' => $_POST['kode_barang'],
                'nama' => $_POST['nama_barang'],
                'stok' => $_POST['stok'],
                'category_id' => $_POST['category_id']
            ];
            $itemModel->update($data);
        }
        header("Location: /uas/public/itemcontroller");
    }
}
  
?>
