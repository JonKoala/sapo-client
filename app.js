var express = require('express');
var fs = require('fs');
var app = express();

app.use(express.static(__dirname));

app.get(/.+\.\w+$/, function(req, res) {
  //requesting an unexisting file
  res.status(404).send();
});

app.get('*', function(req, res) {
  res.sendFile('index.html', { root : __dirname });
});

var port = process.env['SAPO_CLIENT_PORT'];
app.listen(port, () => {
  fs.writeFile("appconfig.json", JSON.stringify({ url: { api: process.env['SAPO_API_URL'] } }), () => { /* just to avoid DeprecationWarning */ });

  console.log('Client up! Listening on ' + port + '...')
})
