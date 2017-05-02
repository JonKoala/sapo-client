var express = require('express');
var app = express();

app.get('/', function(req, res) {
   res.sendfile('index.html')
});

app.get('/inicio', function(req, res) {
  res.sendfile('index.html')
});
app.get('/inicio/*', function(req, res) {
  res.sendfile('index.html')
});

app.get('/avaliacoes', function(req, res) {
  res.sendfile('index.html')
});
app.get('/avaliacoes/*', function(req, res) {
  res.sendfile('index.html')
});

app.get('/nova_avaliacao', function(req, res) {
  res.sendfile('index.html')
});
app.get('/nova_avaliacao/*', function(req, res) {
  res.sendfile('index.html')
});

app.get('/indicadores', function(req, res) {
  res.sendfile('index.html')
});
app.get('/indicadores/*', function(req, res) {
  res.sendfile('index.html')
});

app.get(/^(.+)$/, function(req, res){
    console.log('static file request : ' + req.params[0]);
    res.sendfile(__dirname + req.params[0]);
});

var port = process.env.PORT || 8081;
app.listen(port, function() {
  console.log('Listening on ' + port);
});
