// get password from config file
var pw = require('./config.js').pw();
var email = require('./config.js').email();
var PlayMusic = require('playmusic');
var pm = new PlayMusic();
pm.init({email: email, password: pw }, function(err) {
    if(err) console.error(err);
	pm.getAllTracks(function(err, library) {
		// remove self uploaded songs
		for( var item in library.data.items){
			data_item = library.data.items[item];
			if( typeof data_item.storeId === "undefined" ){
				library.data.items.splice( item, 1 );
			}
		}
		console.log(JSON.stringify(library.data.items));
	});
})
