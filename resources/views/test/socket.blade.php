@extends('layouts.app')
 
@section('content')

    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
 
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2" >
              <div id="messages" ></div>
            </div>
        </div>
    </div>
    <script>
        var socket = io.connect('http://127.0.0.1:3000');
        console.log(socket);
        socket.on('message', function (data) {
            console.log('cayo mensaje');
            $( "#messages" ).append( "<p>"+data+"</p>" );
            socket.disconnect();
          });
    </script>
 
 
@endsection