var express = require('express');
var app = express();

var fs = require('fs');
var configFile = fs.readFileSync('appconfig.json');
var appconfig = JSON.parse(configFile);

app.get('/', function(req, res) {
   res.sendFile('index.html', { root : __dirname})
});

app.get('/inicio', function(req, res) {
  res.sendFile('index.html', { root : __dirname})
});
app.get('/inicio/*', function(req, res) {
  res.sendFile('index.html', { root : __dirname})
});

app.get('/avaliacoes', function(req, res) {
  res.sendFile('index.html', { root : __dirname})
});
app.get('/avaliacoes/*', function(req, res) {
  res.sendFile('index.html', { root : __dirname})
});

app.get('/avaliacoes-old', function(req, res) {
  res.sendFile('index.html', { root : __dirname})
});
app.get('/avaliacoes-old/*', function(req, res) {
  res.sendFile('index.html', { root : __dirname})
});

app.get('/nova_avaliacao', function(req, res) {
  res.sendFile('index.html', { root : __dirname})
});
app.get('/nova_avaliacao/*', function(req, res) {
  res.sendFile('index.html', { root : __dirname})
});

app.get('/indicadores', function(req, res) {
  res.sendFile('index.html', { root : __dirname})
});
app.get('/indicadores/*', function(req, res) {
  res.sendFile('index.html', { root : __dirname})
});

app.get('/criterio-legal', function(req, res) {
  res.sendFile('index.html', { root : __dirname})
});
app.get('/criterio-legal/*', function(req, res) {
  res.sendFile('index.html', { root : __dirname})
});

app.get('/login', function(req, res) {
  res.sendFile('index.html', { root : __dirname})
});
app.get('/login/*', function(req, res) {
  res.sendFile('index.html', { root : __dirname})
});

app.get('/relatorios', function(req, res) {
  res.sendFile('index.html', { root : __dirname})
});
app.get('/relatorios/*', function(req, res) {
  res.sendFile('index.html', { root : __dirname})
});

app.get(/^(.+)$/, function(req, res) {
    console.log('static file request : ' + req.params[0]);
    res.sendFile(__dirname + req.params[0]);
});

var port = appconfig.server.port;
app.listen(port, function() {
  console.log('Client up! Listening on ' + port + '...');
});
