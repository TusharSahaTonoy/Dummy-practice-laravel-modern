<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    
    <title>Chat</title>
</head>
<body>
    
    <div class="container" id="app">
        <h1>The live chat</h1>
        <div class="row justify-content-md-center">  
                <ul class="list-group col-md-6">
                    <li class="list-group-item active">Chat Room</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Morbi leo risus</li>
                    <li class="list-group-item">Porta ac consectetur ac</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                    <li class="list-group-item">
                        <input type="text" class="form-control" v-model="message" @keyup.enter="send">
                        <input type="submit" value="Send" class="btn btn-primary">
                    </li>
                </ul>
                
        </div>
    </div>

    <script src="{{asset('js/app.js')}}" ></script>
</body>
</html>