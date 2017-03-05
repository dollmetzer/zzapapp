<?php
$content['nav_main'] = 'admin';
include PATH_APP.'modules/core/views/backend/_elements/head.php'; ?>

<p><strong><?php $this->lang('txt_cache_delete'); ?></strong></p>
<a href="<?php $this->buildURL('core/admin/deletecache'); ?>" class="btn btn-warning"><?php $this->lang('link_cache_delete'); ?></a>


<h2><?php $this->lang('title_modulelist'); ?></h2>
<div class="panel panel-default">
<table class="table table-striped">
    <thead>
    <tr>
        <th><?php $this->lang('table_col_name'); ?></th>
        <th><?php $this->lang('table_col_desc'); ?></th>
    </tr>
    </thead>
    <tbody>
<?php
foreach($content['modules'] as $module) {
    echo "    <tr>\n";
    echo "        <td>$module</td>\n";
    echo "        <td>";
    $this->lang('txt_module_'.$module.'_description');
    echo "        </td>\n    </tr>\n";
}
?>
    </tbody>
</table>
</div>

<?php include PATH_APP.'modules/core/views/backend/_elements/foot.php'; ?>

