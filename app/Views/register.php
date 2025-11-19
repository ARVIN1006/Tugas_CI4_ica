<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 class="mt-4">Register</h2>
        
        <?php if (isset($validation)): ?>
            <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        
        <?= form_open('/register') ?>
            <div class="form-group mb-3">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= old('name') ?>" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= old('email') ?>" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="password">Kata Sandi</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="confirmpassword">Konfirmasi Kata Sandi</label>
                <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Daftar</button>
            <p class="mt-3">Sudah punya akun? <a href="<?= base_url('login') ?>">Login di sini</a></p>
        <?= form_close() ?>
    </div>
</div>
<?= $this->endSection() ?>