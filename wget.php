<?php
    $filename=$argv[1];
    $url=$argv[2];

    //新しい cURL リソースを作成
    $ch = curl_init();
    //ファイルを書き出しのみでオープン
    $fp = fopen($filename, 'w');
    //取得するURLを指定
    curl_setopt($ch, CURLOPT_URL, $url);
    //下記の２つにfalseを設定するとcURLはサーバー証明書の検証行わない
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
　　 //転送内容が書き込まれるファイルポインタを指定
    curl_setopt($ch, CURLOPT_FILE, $fp);
    //指定したcURLセッションを実行
    curl_exec($ch);
    //cURLリソースを閉じ、システムリソースを解放
    curl_close($ch);
 　　//ファイルをクローズ
    fclose($fp);
?>
