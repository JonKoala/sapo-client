$.getJSON('appconfig.json', function(data) {
  window.SapoApiURL = data.url.api + '/legacy/';
  angular.module('MyTutorialApp',['treeControl']);
});
