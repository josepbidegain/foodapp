var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');
 
server.listen(3000);
io.on('connection', function (socket) {
 
  var redisClient = redis.createClient();
  redisClient.subscribe('message');
 
  redisClient.on("message", function(channel, message) {
    console.log("leyendo mensaje de redis de cola "+ message + " canal "+ channel);
    
    socket.emit(channel, message);
    //io.emit(channel, message);
  });
 
  io.on('disconnect', function() {
    redisClient.quit();
  });
 
});
/*
var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis();
redis.psubscribe('*');

redis.on('pmessage', function (subscribed, channel, response)
{
    io.emit(channel + ':' + response.event, response.data);
});

server.listen(3000);
*/