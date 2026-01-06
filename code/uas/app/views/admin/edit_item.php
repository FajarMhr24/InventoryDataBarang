<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">Edit Barang</h5>
        </div>
        <div class="card-body">
            <form action="/uas/public/itemcontroller/update" method="POST">
                
                <input type="hidden" name="id" value="<?= $data['item']['id']; ?>">

                <div class="mb-3">
                    <label>Kode Barang</label>
                    <input type="text" name="kode_barang" class="form-control" value="<?= $data['item']['kode_barang']; ?>" required>
                </div>

                <div class="mb-3">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="<?= $data['item']['nama_barang']; ?>" required>
                </div>

                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="category_id" class="form-control">
                        <?php foreach($data['categories'] as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $data['item']['category_id']) ? 'selected' : '' ?>>
                                <?= $cat['nama_kategori'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" value="<?= $data['item']['stok']; ?>" required>
                    <small class="text-muted">Ubah angka ini untuk melakukan Restock.</small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/uas/public/itemcontroller" class="btn btn-secondary">Batal</a>
                    <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
