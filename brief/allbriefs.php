<?php

require 'db.php';
require 'render.php';
function GetAllBriefs($params = null, $page = 1)
{
    $ConstOffset = 10;
    $offset = ($page - 1) * $ConstOffset;
    return Select('info', '*', null, $params, null, $offset, $ConstOffset);
}

function getCountBriefs($params = null)
{
    return Select('info', 'Count(*) as count', null, $params)[0]['count'];
}

$briefs = GetAllBriefs();
$count = getCountBriefs();
renderView('all', ['briefs'=>$briefs, 'count'=>$count]);
