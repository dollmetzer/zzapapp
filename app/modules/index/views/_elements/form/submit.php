<?php
echo '<input id="formfield_'.$name.'" type="submit" name="'.$name;
if(!empty($field['value'])) {
    echo '" value="'.$viewhelper->translate('form_btn_submit_' . $field['value'], false);
} else {
    echo '" value="'.$viewhelper->translate('form_btn_submit', false);
}
if (!empty($field['readonly'])) {
    echo '" disabled="disabled';
}
echo '" class="btn btn-primary" />';
