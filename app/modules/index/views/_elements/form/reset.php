<?php

echo '<input id="formfield_'.$name.'" type="reset" ';
if(!empty($field['value'])) {
    echo 'value="'.$viewhelper->translate('form_btn_reset_' . $field['value'], false);
} else {
    echo 'value="'.$viewhelper->translate('form_btn_reset', false);
}
if (!empty($field['readonly'])) {
    echo '" readonly="readonly';
}
echo '" class="btn btn-warning" />';
