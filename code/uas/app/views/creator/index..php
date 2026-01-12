<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h4 class="mb-0">Profile Developer</h4>
                </div>
                
                <div class="card-body text-center p-4">
                    
                    <?php
                        $fotoDB = isset($data['user']['foto']) ? $data['user']['foto'] : 'default.png';
                        // Cek file ada atau nggak
                        if ($fotoDB != 'default.png' && file_exists('../public/uploads/' . $fotoDB)) {
                            $fotoPath = '/uas/public/uploads/' . $fotoDB;
                        } else {
                            // Pake Inisial kalau gak ada foto
                            $nama = urlencode($data['user']['nama_lengkap']);
                            $fotoPath = "https://ui-avatars.com/api/?name={$nama}&background=198754&color=fff&size=150&bold=true";
                        }
                    ?>
                    
                    <img src="<?= $fotoPath ?>" 
                         class="rounded-circle img-thumbnail mb-3 shadow" 
                         style="width: 150px; height: 150px; object-fit: cover;">

                    <form action="/uas/public/creator/upload" method="POST" enctype="multipart/form-data" class="mb-4">
                        <div class="d-flex justify-content-center">
                            <div class="input-group input-group-sm" style="max-width: 250px;">
                                <input type="file" name="foto" class="form-control" accept="image/*" required>
                                <button class="btn btn-primary" type="submit">Upload</button>
                            </div>
                        </div>
                        <small class="text-muted" style="font-size: 10px;">Format: JPG/PNG, Max 2MB</small>
                    </form>

                    <h4 class="fw-bold text-primary text-uppercase"><?= $data['user']['nama_lengkap']; ?></h4>
                    <p class="text-muted mb-4">Mahasiswa Teknik Informatika</p>

                    <ul class="list-group list-group-flush text-start mb-4 shadow-sm rounded">
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <span class="fw-bold text-secondary">NIM</span>
                            <span class="fw-bold text-dark">312410549</span> 
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <span class="fw-bold text-secondary">Kelas</span>
                            <span class="fw-bold text-dark">TI.24.A5</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <span class="fw-bold text-secondary">Kampus</span>
                            <span class="text-dark">Univ. Pelita Bangsa</span>
                        </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <span class="fw-bold text-secondary">Mata Kuliah</span>
                            <span class="text-dark">Pemrograman Web 1</span>
                        </li>
                    </ul>

                    <div class="d-grid gap-2">
                        <a href="https://instagram.com/fajarmmhrh.24" target="_blank" class="btn btn-outline-danger">
                            Follow Instagram
                        </a>
                        
                        <a href="/uas/public/dashboard" class="btn btn-secondary">
                            Kembali ke Dashboard
                        </a>
                    </div>

                </div>
                <div class="card-footer text-center text-muted py-2" style="font-size: 12px;">
                    &copy; <?= date('Y'); ?> Project UAS
                </div>
            </div>

        </div>
    </div>
</div>
