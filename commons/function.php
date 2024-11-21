<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}
function uploadFile($file, $folderload){
    $pathSorage = $folderload.time().$file['name'];
    $from = $file['tmp_name'];
    $to = PATH_ROOT.$pathSorage;
    if(move_uploaded_file($from,$to)) {
        return  $pathSorage;
    }
    return null;

}
    function deleteFile($file){
        $pathSorage =PATH_ROOT.$file;
        if(file_exists($pathSorage)){
            unlink($pathSorage);
        }
    }
function deleteSessionError(){
    if(isset($_SESSION['flash'])){
        unset($_SESSION['flash']);
        session_unset();
        session_destroy();
    }
}

function uploadFileAlbum($file, $folderload,$key){
    $pathSorage = $folderload.time().$file['name'][$key];
    $from = $file['tmp_name'][$key];
    $to = PATH_ROOT.$pathSorage;
    if(move_uploaded_file($from,$to)) {
        return  $pathSorage;
    }
    return null;

}
function formatDate($date){
    return date("d-m-Y",strtotime($date));
}