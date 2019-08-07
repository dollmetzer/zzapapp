<?php
$title = $viewhelper->translate('title_register', false);
$nav_top = '';

include PATH_APP.'modules/index/views/_elements/head.php';
?>

    <div class="container">
        <div class="row">
            <div class="col-12" style="border:1px solid red;">
                <?php include PATH_APP.'modules/index/views/_elements/form.php' ?>
            </div>
        </div>
    </div>

<?php
include PATH_APP.'modules/index/views/_elements/foot.php';
?>
