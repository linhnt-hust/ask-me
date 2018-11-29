<div class="login-panel">
    <section class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="page-content">
                    <h2>Login</h2>
                    <div class="form-style form-style-3">
                        <form method="post" role="form" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-inputs clearfix">
                                <p class="login-text" {{ $errors->has('email') ? 'alert alert-danger' : '' }}>
                                    <input type="text" value="Username" name="name" onfocus="if (this.value == 'Username') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Username';}">
                                    <i class="icon-user"></i>
                                </p>
                                <p class="login-password" {{ $errors->has('password') ? 'alert alert-danger' : '' }}>
                                    <input type="password" value="Password" name="password" onfocus="if (this.value == 'Password') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Password';}">
                                    <i class="icon-lock"></i>
                                    <a href="#">Forget</a>
                                </p>
                            </div>
                            <p class="form-submit login-submit">
                                <input type="submit" value="Log in" class="button color small login-submit submit">
                            </p>
                            <div class="rememberme">
                                <label><input type="checkbox" checked="checked" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember me') }}</label>
                            </div>
                        </form>
                    </div>
                </div><!-- End page-content -->
            </div><!-- End col-md-6 -->
            <div class="col-md-6">
                <div class="page-content Register">
                    <h2>Register Now</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravdio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequa. Vivamus vulputate posuere nisl quis consequat.</p>
                    <a class="button color small signup">Create an account</a>
                </div><!-- End page-content -->
            </div><!-- End col-md-6 -->
        </div>
    </section>
</div><!-- End login-panel -->