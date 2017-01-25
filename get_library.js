// get password from config file
var pw = require('./config.js').pw();
var email = require('./config.js').email();
var PlayMusic = require('playmusic');
var pm = new PlayMusic();
pm.init({email: email, password: pw }, function(err) {
    if(err) console.error(err);
	pm.getAllTracks(function(err, library) {
		console.log(JSON.stringify(library.data.items));
	});
})
