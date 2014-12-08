// argv[0]はnode（固定値）、 argv[1]は実行されたjsの絶対パス、2以降はコマンドライン引数の内容
var filename=process.argv[２];
var url=process.argv[3];

//認証エラーを無視
process.env.NODE_TLS_REJECT_UNAUTHORIZED =0;

//https通信
var https = require('https');
var fs = require('fs');

var file = fs.createWriteStream(filename);
var request = https.get(url, function(response) {
  response.pipe(file);
});
