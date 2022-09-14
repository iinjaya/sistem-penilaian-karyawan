<?php
// die(md5('1234'));

include 'partials/header.php';
if (isset($_SESSION['id'])) {
    header("Location: index.php");
    die;
}
?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Silahkan login terlebih dahulu</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <br />
                <?php if ($_GET['error_login'] == 1) : ?>
                    <div class="alert alert-danger">
                        Anda Harus Login Terlebih Dahulu !
                    </div>
                <?php endif ?>
                <form method="post" action="model/do_login.php">
                    <label>Enter Username : </label>
                    <input type="text" name="username" class="form-control" />
                    <label>Enter Password : </label>
                    <input type="password" name="password" class="form-control" />
                    <hr />
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> &nbsp;Log Me In </button>&nbsp;
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'partials/footer.php'; ?>