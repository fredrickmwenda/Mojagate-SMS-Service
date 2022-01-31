<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="" type="image/png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>MOJAGATE SMS SERVICE</title>
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
                @foreach($sms as $sms)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                       
                        <td>{{$sms->phone}}</td>
                        <td>{{$sms->message}}</td>
                        <td>{{$sms->created_at}}</td>
                       
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
