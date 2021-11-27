<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php $viewhelper->buildURL('page/terms'); ?>"><?php $viewhelper->translate('link_terms'); ?></a></li>
        <li class="breadcrumb-item"><a href="<?php $viewhelper->buildURL('page/privacy'); ?>"><?php $viewhelper->translate('link_privacy'); ?></a></li>
        <li class="breadcrumb-item"><a href="<?php $viewhelper->buildURL('page/imprint'); ?>"><?php $viewhelper->translate('link_imprint'); ?></a></li>
    </ol>
    <?php
        $languages = $this->config->get('languages');
        if (sizeof($languages) > 1) {
            echo '[';
            for ($i=0; $i<sizeof($languages); $i++) {
                if ($i > 0) {
                    echo '|';
                }
                if ($languages[$i] == $this->session->get('userLanguage')) {
                    echo ' <strong>'.$languages[$i].'</strong> ';
                } else {
                    echo ' <a href="';
                    $viewhelper->buildUrl('index/language/set/' . $languages[$i]);
                    echo '">';
                    echo $languages[$i];
                    echo '</a> ';
                }
            }
            echo ']';
        }
    ?>
</nav>
