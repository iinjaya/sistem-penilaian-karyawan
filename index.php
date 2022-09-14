<?php
session_start();

error_reporting(1);
if (empty($_SESSION['id'])) {
    header('location:login.php');
}
?>
<?php include 'partials/header.php'; ?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                <h4 class="page-head-line">Dashboard</h4>
                <h3><strong style="font-size: 30px">Selamat datang</strong> di Sistem Penilaian Karyawan</h3>
            </div>
        </div>
    </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->

<?php include 'partials/footer.php'; ?>
<script type="text/javascript">
    $(function() {
        $("#home").addClass('menu-top-active');
    });
</script>