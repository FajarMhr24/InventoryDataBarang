<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Barang</h6>
            </div>
            <div class="card-body">
                <form action="/uas/public/itemcontroller/simpan" method="POST">
                    <div class="mb-3">
                        <label>Kode Barang</label>
                        <input type="text" name="kode_barang" class="form-control" placeholder="BRG-xxx" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="category_id" class="form-control">
                            <?php foreach($data['categories'] as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= $cat['nama_kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" required>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary w-100">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
                
                <div class="d-flex">
                    <button onclick="window.print()" class="btn btn-sm btn-dark me-2">
                        <i class="bi bi-printer"></i> Print
                    </button>

                    <form action="/uas/public/itemcontroller/index" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control form-control-sm me-2" 
                               placeholder="Cari barang..." value="<?= $data['keyword'] ?>">
                        <button type="submit" class="btn btn-sm btn-outline-primary">Cari</button>
                        <?php if($data['keyword']): ?>
                            <a href="/uas/public/itemcontroller" class="btn btn-sm btn-outline-secondary ms-1">Reset</a>
                        <?php endif; ?>
                    </form>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th class="text-center">QR Code</th> <th>Kode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = ($data['currentPage'] - 1) * 5 + 1; 
                            foreach($data['items'] as $row): 
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                
                                <td class="text-center">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= $row['kode_barang'] ?>" 
                                         alt="QR" width="50" height="50" class="img-thumbnail">
                                </td>
                                <td><span class="badge bg-secondary"><?= $row['kode_barang'] ?></span></td>
                                <td><?= $row['nama_barang'] ?></td>
                                <td><?= $row['nama_kategori'] ?></td>
                                <td>
                                    <?php if($row['stok'] < 5): ?>
                                        <span class="text-danger fw-bold"><?= $row['stok'] ?> (Low)</span>
                                    <?php else: ?>
                                        <span class="text-success fw-bold"><?= $row['stok'] ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="/uas/public/itemcontroller/edit/<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="/uas/public/itemcontroller/hapus/<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            
                            <?php if(empty($data['items'])): ?>
                                <tr><td colspan="7" class="text-center">Data tidak ditemukan</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mt-3">
                        <?php 
                        $prev = $data['currentPage'] - 1;
                        $searchParam = $data['keyword'] ? "?search=" . $data['keyword'] : "";
                        ?>
                        <li class="page-item <?= ($data['currentPage'] <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="/uas/public/itemcontroller/index/<?= $prev . $searchParam ?>">Previous</a>
                        </li>

                        <?php for($i = 1; $i <= $data['totalPages']; $i++) : ?>
                            <li class="page-item <?= ($i == $data['currentPage']) ? 'active' : '' ?>">
                                <a class="page-link" href="/uas/public/itemcontroller/index/<?= $i . $searchParam ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php $next = $data['currentPage'] + 1; ?>
                        <li class="page-item <?= ($data['currentPage'] >= $data['totalPages']) ? 'disabled' : '' ?>">
                            <a class="page-link" href="/uas/public/itemcontroller/index/<?= $next . $searchParam ?>">Next</a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>
