// get password from config file
var pw = require('./config.js').pw();
var email = require('./config.js').email();
var androidID = require('./config.js').android();
var masterToken = require('./config.js').masterToken();

// determine parameters
var nid = process.argv[2];

var PlayMusic = require('playmusic');
var pm = new PlayMusic();


pm.init({ email: "freakpants@gmail.com", password: pw }, function(err) {
// pm.init({ androidId: androidID, masterToken: masterToken }, function(err) {
    if(err) console.error(err);

	pm.getStreamUrl(nid, function(err, streamUrl, requestUrl, deviceID ) {	
		var returnObject = [];
		returnObject.push({ streamUrl: streamUrl, requestUrl: requestUrl, deviceID: deviceID });
		console.log(JSON.stringify(returnObject));
	}); 
})
