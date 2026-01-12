<?php
class Item {
    private $db;

    public function __construct() {
        // Asumsi class Database lo return object PDO
        $this->db = (new Database())->getConnection();
    }

    public function getAllPaginated($start, $limit, $keyword = null) {
        $sql = "SELECT items.*, categories.nama_kategori 
                FROM items 
                LEFT JOIN categories ON items.category_id = categories.id ";
        
        if($keyword) {
            $sql .= "WHERE items.nama_barang LIKE :keyword OR items.kode_barang LIKE :keyword ";
        }
        
        $sql .= "ORDER BY items.id DESC LIMIT :start, :limit";
        
        $stmt = $this->db->prepare($sql);
        if($keyword) {
            $param = "%$keyword%";
            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':keyword', $param);
        } else {
            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll($keyword = null) {
        $sql = "SELECT COUNT(*) as total FROM items";
        if($keyword) {
            $sql .= " WHERE nama_barang LIKE :keyword OR kode_barang LIKE :keyword";
        }
        $stmt = $this->db->prepare($sql);
        if($keyword) {
            $param = "%$keyword%";
            $stmt->bindParam(':keyword', $param);
        }
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getCategories() {
        $stmt = $this->db->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function simpan($data) { // Note: Di controller lo pake method 'add', sesuaikan ya.
        $sql = "INSERT INTO items (kode_barang, nama_barang, stok, category_id) VALUES (:kode, :nama, :stok, :kategori)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':kode', $data['kode']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':stok', $data['stok']);
        $stmt->bindParam(':kategori', $data['category_id']);
        return $stmt->execute();
    }

    // Alias fungsi add biar gak error kalau controller manggil add
    public function add($data) {
        return $this->simpan($data);
    }

    public function hapus($id) {
        $stmt = $this->db->prepare("DELETE FROM items WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Alias fungsi delete biar gak error kalau controller manggil delete
    public function delete($id) {
        return $this->hapus($id);
    }

    public function getLowStock() {
        $stmt = $this->db->prepare("SELECT * FROM items WHERE stok < 5 ORDER BY stok ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM items WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $sql = "UPDATE items SET kode_barang=:kode, nama_barang=:nama, stok=:stok, category_id=:kategori WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':kode', $data['kode']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':stok', $data['stok']);
        $stmt->bindParam(':kategori', $data['category_id']);
        $stmt->bindParam(':id', $data['id']);
        return $stmt->execute();
    }

    
    public function getItemCountByCategory() {
        $sql = "SELECT c.nama_kategori, COUNT(i.id) as total 
                FROM items i 
                JOIN categories c ON i.category_id = c.id 
                GROUP BY c.nama_kategori";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
