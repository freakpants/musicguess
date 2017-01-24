// get password from config file
var pw = require('./config.js').pw();

var PlayMusic = require('playmusic');
var pm = new PlayMusic();
pm.login({email: "freakpants@gmail.com", password: pw }, function(err , object) {
    if(err) console.error(err);
	console.log(object);
}) 