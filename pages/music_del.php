<?php

//访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

//接收ID
$id = intval($id);

//删除文件
$sql = "SELECT musicurl,coverurl FROM cgx_music WHERE id = $id LIMIT 1";

$msql->execute($sql);

$res = $msql->fetchquery($sql);

//封面地址
$coverUrl = $res['coverurl'];
//音频地址
$musicUrl = $res['musicurl'];
//判断文件是否存在，如果存在则删除
if (file_exists($coverUrl)) {
    unlink($coverUrl);
}
if (file_exists($musicUrl)) {
    unlink($musicUrl);
}

//删除数据
$sql = "DELETE FROM cgx_music WHERE id = $id";

//执行语句
$msql->execute($sql);

$as = $msql->affectedRows();
if ($as > 0) {
    $result = '删除成功！';
} else {
    $result = '删除失败！';
}

// 载入模板
include 'pages/templates/music_del.html';
