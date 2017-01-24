// get password from config file
var pw = require('./config.js').pw();
var PlayMusic = require('playmusic');
var pm = new PlayMusic();
pm.init({email: "freakpants@gmail.com", password: pw }, function(err) {
    if(err) console.error(err);
	pm.getAllTracks(function(err, library) {
		console.log(JSON.stringify(library.data.items));
	});
})
