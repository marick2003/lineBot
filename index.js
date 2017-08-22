var linebot = require('linebot');
var express = require('express');

var bot = linebot({
  channelId: '1485205799',
  channelSecret: '3925686d451f48ecb64b9255c2b83a26',
  channelAccessToken: '3gZ2i4rD/Lx1ktw1MuFiIByX90Ls4gw+W8KACzlJgeKn2D73rb3A4eUtBWvaMIXIEpmyUTXPjjzlRPcEx0y0XeKaaJX0PlLBUcyIXju2CcHjti4As/9Pyc8JzV/hpDt876UAQusK7UfVrX3qIJ018QdB04t89/1O/w1cDnyilFU='
});

bot.on('message', function(event) {
  console.log(event); //把收到訊息的 event 印出來看看
});

const app = express();
const linebotParser = bot.parser();
app.post('/', linebotParser);

//因為 express 預設走 port 3000，而 heroku 上預設卻不是，要透過下列程式轉換
var server = app.listen(process.env.PORT || 8080, function() {
  var port = server.address().port;
  console.log("App now running on port", port);
});