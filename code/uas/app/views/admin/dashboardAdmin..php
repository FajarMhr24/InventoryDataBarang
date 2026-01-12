<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 

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

    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 fw-bold text-primary">📊 Statistik Barang per Kategori</h6>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4 h-100">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 fw-bold text-primary">ℹ️ Informasi Grafik</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted">Grafik di samping menampilkan visualisasi jumlah item barang berdasarkan kategori.</p>
                    <hr>
                    <p class="small text-secondary">
                        <i class="bi bi-check-circle-fill text-success"></i> Data Realtime<br>
                        <i class="bi bi-check-circle-fill text-success"></i> Auto Update
                    </p>
                </div>
            </div>
        </div>
    </div>
</div> 

<script>
    const ctx = document.getElementById('myChart');
    
    if (ctx) {
        // Ambil data dari PHP
        const labels = <?= isset($chart_labels) ? $chart_labels : '[]'; ?>;
        const dataStok = <?= isset($chart_data) ? $chart_data : '[]'; ?>;

        new Chart(ctx, {
            type: 'doughnut', 
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Item',
                    data: dataStok,
                    backgroundColor: [
                        '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    // --- BAGIAN INI YANG BIKIN PERSENTASE ---
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                let value = context.raw;
                                // Hitung total otomatis dari data Chart
                                let total = context.chart._metasets[context.datasetIndex].total;
                                // Rumus Persen
                                let percentage = ((value / total) * 100).toFixed(1) + '%';
                                return label + value + ' (' + percentage + ')';
                            }
                        }
                    }
                    // ----------------------------------------
                }
            }
        });
    }
</script>
