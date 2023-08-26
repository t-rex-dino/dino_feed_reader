<section id="users-login" class="container bb-py-divs-3">
    <div class="row">header</div>
    <div class="row">
        <form action="" method="post">
            <div class="container bb-py-divs-2">
                <div class="form-group">
                    <label
                        for="users-login-username">
                        username</label>
                    <input
                        type="text"
                        class="form-control"
                        id="users-login-username"
                        name="login[username]">
                    <small class="form-text text-muted">entered username or email.</small>
                </div>
                <div>
                    <label
                        for="users-login-password">
                        password</label>
                    <input
                        type="password"
                        class="form-control"
                        id="users-login-password"
                        name="login[password]">
                </div>
                <div class="form-check">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="users-login-rememberme"
                        name="login[rememberme]">
                    <label
                        for="users-login-rememberme"
                        class="form-check-label">
                        Remember Me</label>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                </div>
            </div>
        </form>
    </div>
    <div>
        <a
            href="#"
            class="
                link-primary
                link-offset-2
                link-underline
                link-underline-opacity-0">Forget Password</a> | 
        <a
            href="#"
            class="
                link-primary
                link-offset-2
                link-underline
                link-underline-opacity-0">Sign Up</a>
    </div>
</section>