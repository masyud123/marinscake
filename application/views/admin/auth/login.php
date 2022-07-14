<section class="section">
    <div class="container">
        <div class="row align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-lg-5">
                <div class="card card-info" style="overflow: hidden;">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header">
                                <h4 class="mx-auto">Halaman Masuk</h4>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo base_url('admin/auth/Login/login_user/') ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <?php echo $this->session->flashdata('pesan') ?>
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <div class="float-right">
                                                <a href="auth-forgot-password.html" class="text-small">
                                                    Forgot Password?
                                                </a>
                                            </div>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-lg btn-block" tabindex="4">
                                            <h6 class="m-0">
                                                Login
                                            </h6>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-6"></div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>