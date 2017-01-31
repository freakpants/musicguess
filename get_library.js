// get password from config file
var pw = require('./config.js').pw();
var email = require('./config.js').email();
var PlayMusic = require('playmusic');
var pm = new PlayMusic();
pm.init({email: email, password: pw }, function(err) {
    if(err) console.error(err);
	pm.getAllTracks(function(err, library) {
		
		freshLibrary = [];
		// remove self uploaded songs
		for( var item in library.data.items){
			data_item = library.data.items[item];
			if ( typeof data_item.storeId !== "undefined"){
				freshLibrary.push(data_item);
			}
			
		}
		console.log(JSON.stringify(freshLibrary));
	});
})
