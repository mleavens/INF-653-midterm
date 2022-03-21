<?php

public function($id, $model){
    $id = $model->id;
    $result = $model->read_single();
    return $result;
}

?>