var express = require('express');
var app = express();

var fs = require('fs');
var configFile = fs.readFileSync('appconfig.json');
var appconfig = JSON.parse(configFile);

app.use(express.static(__dirname));

app.get(/.+\.\w+$/, function(req, res) {
  //requesting an unexisting file
  res.status(404).send();
});

app.get('*', function(req, res) {
  res.sendFile('index.html', { root : __dirname});
});

var port = appconfig.server.port;
app.listen(port, () => {
  console.log('Client up! Listening on ' + port + '...')
})
