        <!-- Popup: Login -->
        <div aria-hidden="true" class="modal fade popup-login" id="popup-login" role="dialog" tabindex="-1">
            <div class="modal-dialog">
                <div class="container">
                    <div class="popup-login-items">
                        <div class="popup-login-items-inner">
                            <form action="#" class="form-login">
                                <div class="row">
                                    <div class="col-md-12 hello-text-wrap">
                                        <span class="hello-text text-thin">Hello, welcome to your account</span>
                                    </div>
                                    <div class="col-md-12">
                                        <a class="btn btn-theme btn-block btn-icon-left facebook" data-dismiss="modal"
                                            href="#"><i class="fa fa-facebook"></i>Sign in with Facebook</a>
                                    </div>
                                    <div class="col-md-12">
                                        <a class="btn btn-theme btn-block btn-icon-left twitter" data-dismiss="modal"
                                            href="#"><i class="fa fa-twitter"></i>Sign in with Twitter</a>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group"><input class="form-control"
                                                placeholder="User name or email" type="text"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group"><input class="form-control" placeholder="Your password"
                                                type="password"></div>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <div class="checkbox">
                                            <label><input type="checkbox"> Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6 text-right-lg">
                                        <a class="forgot-password" href="#">forgot password?</a>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="col-md-6">
                                        <a class="btn btn-theme btn-block btn-theme-dark" data-dismiss="modal"
                                            href="#">Close</a>
                                    </div>
                                    <div class="col-md-6">
                                        <a class="btn btn-theme btn-block btn-theme-green" data-dismiss="modal"
                                            href="#">Login</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /Popup: Login -->

        <!-- Popup: Register -->
        <div aria-hidden="true" class="modal fade popup-login" id="popup-sign-up" role="dialog" tabindex="-1">
            <div class="modal-dialog">
                <div class="container">

                    <div class="popup-login-items">
                        <div class="popup-login-items-inner">

                            <form class="form-login" id="formRegSub">
                                {{-- action="{{ url('pmb/register') }}" --}}
                                {{-- @csrf --}}
                                <div class="row">
                                    <div class="col-md-12 hello-text-wrap">
                                        <div class="alert warning" style="color: #d67545;line-height: normal;">
                                            <span class="closebtn warning">×</span>
                                            <i class="fa fa-warning fa-1x"></i>
                                            Sebelum mendaftar buat akun pendaftaran terlebih dahulu!
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nik</label>
                                            <input class="form-control" maxlength="16" minlength="16" name="nik"
                                                placeholder="nik siswa" required type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Username</label>
                                            <input class="form-control" name="username" placeholder="Nama pengguna"
                                                required type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Email </label>
                                            <input class="form-control" name="email" placeholder="email" required
                                                type="email">
                                            <span style="color: #d67545;">
                                                <i class="fa fa-warning fa-1x">
                                                </i><b> Isikan email valid.</b>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input class="form-control" name="password" placeholder="Your password"
                                                required type="password">
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="col-md-6">
                                        <a class="btn btn-theme btn-block btn-theme-dark" data-dismiss="modal"
                                            href="#">Batal</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-theme btn-block btn-theme-green" type="submit">
                                            Buat Akun
                                            <span>
                                                <b></b>
                                                <b></b>
                                                <b></b>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /Popup: Register -->
