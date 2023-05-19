<?php

// 設定連線參數

$db_severname = 'localhost'; //主機名稱
$db_name = 'friendtrip'; //資料庫名稱
$db_username = 'root'; //進資料庫的使用者名稱
$db_password = 'root'; //進資料庫的密碼

// 建立PDO連線


// 建一個PDO物件(指定給變數$pdo)，傳入參數給 PDO 建構函式
// 參數1：指定 PDO 連線到哪個資料庫，以及該資料庫的位置和名稱(因為參數1很長，所以先指定給變數$dsn比較好處理)；另外順便也把編碼設定加進去$dsn
// 參數2：使用者名稱
// 參數3：密碼
// 參數4：PDO連線的屬性設定(預先把設定結果指定給一個變數$pdo_option)


$dsn = "mysql:host={$db_severname};dbname={$db_name};charset=utf8";

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    //讓資料庫顯示錯誤訊息
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    //設定 PDO 連線默認的資料擷取模式，以便在執行資料庫查詢時，PDO 連線返回更容易處理的關聯式陣列型態的查詢結果。
];

try {
    $pdo = new PDO($dsn, $db_username, $db_password, $pdo_options);
    // 把PDO物件帶入 try-catch 語句，以捕捉可能發生的 PDOException 異常
} catch (PDOException $ex) {
    echo $ex->getMessage();
    //使用 $ex->getMessage() 方法，輸出拋出的異常訊息，以便進一步調試程式碼。
}



if (!isset($_SESSION)) {
    session_start();
};
    // 使用 isset() 函數檢查 $_SESSION 是否已經被設置。如果 $_SESSION 沒有被設置，就調用 session_start() 函數，啟動 Session 功能。這樣就可以在後續的程式碼中，使用 $_SESSION 變量來儲存和訪問 Session 中的數據。