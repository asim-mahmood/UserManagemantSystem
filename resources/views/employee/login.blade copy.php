<form action="login.php" method="post">
    {{-- <label for="email">Email:</label>
    <input type="email" id="email" name="email" required> --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mt-4">Login</h2>
                <form action="login.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="forget_password" class="form-label">Forget Password?</label>
                        <input type="checkbox" class="form-check" id="forget_password" name="forget_password" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    {{-- <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <label for="forget_password">Forget Password?</label>
    <input type="checkbox" id="forget_password" name="forget_password" required>
    <br>
    <input type="submit" value="Login"> --}}
</form>
{{-- <form action="login.php" method="post" class="form-horizontal">
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email:</label>
        <div class="col-sm-10">
            <input type="email" id="email" name="email" required class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Password:</label>
        <div class="col-sm-10">
            <input type="password" id="password" name="password" required class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="forget_password" class="col-sm-2 control-label">Forget Password?</label>
        <div class="col-sm-10">
            <input type="checkbox" id="forget_password" name="forget_password" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" value="Login" class="btn btn-primary">
        </div>
    </div>
</form> --}}