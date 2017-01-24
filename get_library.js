var PlayMusic = require('playmusic');
var pm = new PlayMusic();
pm.init({email: "freakpants@gmail.com", password: "emcebbogvjjpcrlh"}, function(err) {
    if(err) console.error(err);
	pm.getAllTracks(function(err, library) {
		console.log(JSON.stringify(library.data.items));
	});
})
