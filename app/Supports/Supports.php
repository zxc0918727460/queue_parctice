<?php

// 自訂 Helper 檔案路徑
$helpers = [
    'ResponseGeneraror.php',
];

// 載入 自訂 Helper 檔案
foreach ($helpers as $helperFileName) {
    include __DIR__ . '/' .$helperFileName;
}