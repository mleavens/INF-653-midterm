<?php

require_once '../../models/Author.php';

function isValid($id, $model){
    $id = $model->id;
    $result = $model->read_single();
    return $result;
}

?>