var express = require('express')
  , app = express()
  , http = require('http')
  , server = http.createServer(app)
  , io = require('socket.io').listen(server, {
  log: false 
  } );

server.listen(4001);

io.sockets.on('connection', function(socket) {
	
	//socket.emit('init', 'SERVER' );
	//socket.broadcast.emit('test', 'msg1' );
	
	socket.on('msg', function(m){
		socket.broadcast.emit('msg1', m);
		//socket.emit('msg2', m );
		//console.log( m );		
	});

});
