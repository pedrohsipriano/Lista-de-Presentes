<!DOCTYPE html>
<html lang="en">
<?php include_once './component/component1/head.php'?>
<body>
    <!-- Navigation-->
    <?php include_once './component/component1/navbar.php'; ?>
    <!-- Header-->
    <?php include_once './component/component1/header.php'; ?>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-sm-2 row-cols-lg-4 justify-content-center">
            <?php include_once 'component/card/cama.php'; ?>
            <?php include_once 'component/card/geladeira.php'; ?>
            <?php include_once 'component/card/corte.php'; ?>   
            <?php include_once 'component/card/fogao.php'; ?>   
            <?php include_once 'component/card/televisao.php'; ?>   
            <?php include_once 'component/card/panela.php'; ?>   
            <?php include_once 'component/card/sofa.php'; ?>   
            <?php include_once 'component/card/unha.php'; ?>   
            </div>
        </div>
    </section>
    <!-- Footer-->
    <?php include_once './component/component1/rodape.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
