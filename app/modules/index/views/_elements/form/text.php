<?php

echo '<input id="formfield_'.$name.'" type="text" name="';
echo $name . '" ';
if (!empty($field['readonly'])) {
    echo 'readonly="readonly" ';
}
if (!empty($field['maxlength'])) {
    echo 'maxlength="' . $field['maxlength'] . '" ';
}
if (!empty($field['placeholder'])) {
    echo 'placeholder="' . $field['placeholder'] . '" ';
}
if (!empty($field['value'])) {
    echo 'value="' . $field['value'] . '" ';
}
echo 'class="form-control" />';
