<?php

function isValid($id, $model) {
    $model->id = $id;
    $modelResult = $model->create();
    return $modelResult;
}



?>