var socket = require('socket.io'),
	express = require('express'),
	https = require('https'),
	http = require('http'),
	logger = require('winston');

logger.remove(logger.transports.Console);
logger.add(logger.transports.Console, { colorize: true, timestamp: true });
logger.info('Hello');

var app = express();
var http_server = http.createServer(app).listen(3001);

function emitNewNotif(server)
{
	var io = socket.listen(server);
	io.sockets.on('connection',function(socket){
		socket.on('new_notify',function(data){
			io.emit('new_notify',data);
		});
	});
}
emitNewNotif(http_server);