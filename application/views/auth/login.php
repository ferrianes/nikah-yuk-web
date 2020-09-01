<!-- Nested Row within Card Body -->
<div class="row">
    <div class="col-lg">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Selamat Datang di Login Admin!</h1>
            </div>
            <?= $this->session->flashdata('pesan'); ?>
            <form class="user" method="post" action="<?= base_url('auth') ?>">
                <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email...">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password...">
                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <button class="btn btn-primary btn-user btn-block">
                    Login
                </button>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
            </div>
            <div class="text-center">
                <a class="small" href="register.html">Create an Account!</a>
            </div>
        </div>
    </div>
</div>