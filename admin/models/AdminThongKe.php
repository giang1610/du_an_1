<?php
function loadall_thongke(){
    $sql = 'SELECT danh_mucs.ten_danh_muc, COUNT(san_phams.id) AS so_luong_san_pham
            FROM san_phams
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
            GROUP BY danh_mucs.ten_danh_muc';
}