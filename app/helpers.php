<?php

function link_to_sort_browsers_by($column, $body){
    $direction = (Request::get('direction')=='asc')?'desc':'asc';
    $num = (Request::get('num'))?Request::get('num'):25;
    return link_to_route('browsers.index', $body, ['sortBy' => $column, 'direction' => $direction, 'num' => $num]);
}
?>
