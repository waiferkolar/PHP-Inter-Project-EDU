<?php require_once APP_ROOT . "/views/layout/top.php"; ?>
<?php require_once APP_ROOT . "/views/layout/nav.php"; ?>

<!--    Form Start-->
<div class="conatiner">
    <div class="col-md-6 offset-md-3 mt-5">
        <h1 class="text-center mt-5">Login</h1>
        <form acton="<?php echo url('User/login'); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.
                </small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">File Upload</label>
                <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        </form>
    </div>
</div>
<!--    Form End-->

<?php require_once APP_ROOT . "/views/layout/base.php"; ?>
