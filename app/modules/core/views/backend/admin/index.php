<?php
$content['nav_main'] = 'admin';
include PATH_APP.'modules/core/views/backend/_elements/head.php'; ?>

<p><strong><?php $this->lang('txt_cache_delete'); ?></strong></p>
<a href="<?php $this->buildURL('core/admin/deletecache'); ?>" class="btn btn-warning"><?php $this->lang('link_cache_delete'); ?></a>

<?php include PATH_APP.'modules/core/views/backend/_elements/foot.php'; ?>

