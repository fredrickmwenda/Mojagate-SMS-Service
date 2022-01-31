<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="stylesheet" href="{{URL::asset('style.css')}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="" type="image/png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="top-nav">
    <div class="container">
        <div class="logo">
            <h5>Mojagate </h5>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <form action="{{route('send_sms')}}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h6>Send SMS</h6>
                       
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Phone Number</label>
                           <textarea class="form-control" name="phone"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Message</label>
                           <textarea class="form-control" name="message"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success">Send SMS</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <h5> SMS</h5>
            <table class="table table-hover table-stripped">
                <thead>
                <tr>
                    <th>#</th>
                    
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Date</th>
                    
                </tr>
                </thead>
                <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                       
                        <td>{{$message->phone}}</td>
                        <td>{{$message->message}}</td>
                        <td>{{$message->created_at}}</td>
                       
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
</div>
</body>
</html>
