<?php include PATH_APP.'modules/core/views/backend/_elements/head.php'; ?>

<p>core::admin::index</p>

<?php include PATH_APP . 'modules/core/views/backend/_elements/panel_statuspanels.php'; ?>

<?php include PATH_APP . 'modules/core/views/backend/_elements/panel_chart_area.php'; ?>

<?php include PATH_APP . 'modules/core/views/backend/_elements/panel_chart_bar.php'; ?>

<div class="row">
<div class="col-lg-4">
<?php include PATH_APP . 'modules/core/views/backend/_elements/panel_chart_donut.php'; ?>
</div>

<div class="col-lg-4">
<?php include PATH_APP . 'modules/core/views/backend/_elements/panel_chat.php'; ?>
</div>

<div class="col-lg-4">
<?php include PATH_APP . 'modules/core/views/backend/_elements/panel_notifications.php'; ?>
</div>
</div>

<?php include PATH_APP . 'modules/core/views/backend/_elements/panel_timeline.php'; ?>

<?php include PATH_APP . 'modules/core/views/backend/_elements/panel_flot_linechart.php'; ?>


<?php include PATH_APP.'modules/core/views/backend/_elements/foot.php'; ?>

