<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Profil Pengguna</h5>
            </div>
            <div class="card-body text-center">
                <img src="https://ui-avatars.com/api/?name=<?= $data['user']['nama_lengkap']; ?>&background=random&size=128" 
                     class="rounded-circle mb-3" alt="Foto Profil">
                
                <h3><?= $data['user']['nama_lengkap']; ?></h3>
                <p class="text-muted"><?= $data['user']['role']; ?></p>

                <hr>

                <div class="text-start">
                    <div class="mb-2">
                        <strong>Username:</strong> <br>
                        <?= $data['user']['username']; ?>
                    </div>
                    <div class="mb-2">
                        <strong>Bergabung Sejak:</strong> <br>
                        <?= date('d F Y', strtotime($data['user']['created_at'])); ?>
                    </div>
                </div>

                <hr>
                
                <a href="/uas/public/dashboard" class="btn btn-secondary w-100">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</div>
