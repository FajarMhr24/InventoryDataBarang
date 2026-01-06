<div class="container mt-4">
    
    <div class="alert alert-primary shadow-sm border-0">
        <h4 class="mb-1 fw-bold"><?= isset($data['sapaan']) ? $data['sapaan'] : 'Halo'; ?>, <?= isset($data['nama']) ? $data['nama'] : 'Admin'; ?>! 👋</h4>
        <p class="mb-0">Selamat beraktivitas di Sistem Inventaris Barang.</p>
    </div>

    <?php if (!empty($data['lowStock'])): ?>
    <div class="card border-danger mb-4 shadow">
        <div class="card-header bg-danger text-white fw-bold">
            <i class="bi bi-exclamation-triangle-fill"></i> PERINGATAN: Stok Menipis!
        </div>
        <div class="card-body bg-light">
            <p class="card-text text-danger">Barang-barang berikut stoknya sudah di bawah 5. Segera lakukan restock!</p>
            <div class="table-responsive">
                <table class="table table-sm table-bordered bg-white mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Sisa Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['lowStock'] as $item): ?>
                        <tr>
                            <td><?= $item['kode_barang'] ?></td>
                            <td><?= $item['nama_barang'] ?></td>
                            <td class="text-danger fw-bold"><?= $item['stok'] ?> Unit</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-2 text-end">
                <a href="/uas/public/itemcontroller" class="btn btn-sm btn-outline-danger">Kelola Barang &rarr;</a>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3 shadow h-100">
                <div class="card-header border-0">Data Barang</div>
                <div class="card-body">
                    <h1 class="display-4 fw-bold"><i class="bi bi-box-seam"></i></h1>
                    <p class="card-text">Kelola stok barang masuk dan keluar gudang.</p>
                    <a href="/uas/public/itemcontroller" class="btn btn-light text-primary w-100 stretched-link">Ke Data Barang</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3 shadow h-100">
                <div class="card-header border-0">Status User</div>
                <div class="card-body">
                    <h1 class="display-4 fw-bold"><i class="bi bi-person-check"></i></h1>
                    <p class="card-text">Akun Anda aktif. Sesi login valid.</p>
                    <a href="/uas/public/profile" class="btn btn-light text-success w-100 stretched-link">Lihat Profil Saya</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-dark bg-warning mb-3 shadow h-100">
                <div class="card-header border-0">Info Sistem</div>
                <div class="card-body">
                    <h1 class="display-4 fw-bold"><i class="bi bi-cpu"></i></h1>
                    <p class="card-text">Versi 1.0 (UAS) - PHP Native.</p>
                    <a href="/uas/public/creator" class="btn btn-dark text-warning w-100 stretched-link">Profile Pembuat</a>
                </div>
            </div>
        </div>
    </div>
</div>
