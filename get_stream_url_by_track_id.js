// get password from config file
var pw = require('./config.js').pw();
var androidID = require('./config.js').android();
var masterToken = require('./config.js').masterToken();

// determine parameters
var nid = process.argv[2];

var PlayMusic = require('playmusic');
var pm = new PlayMusic();


pm.init({ androidId: androidID, masterToken: masterToken }, function(err) {
    if(err) console.error(err);

	pm.getStreamUrl(nid, function(err, streamUrl) {	
		var returnObject = [];
		returnObject.push({ streamUrl: streamUrl });
		console.log(JSON.stringify(returnObject));
	}); 
})
