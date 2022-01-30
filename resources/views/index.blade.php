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
            <form action="{{route('send_message')}}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h6>Send Message</h6>
                        @include('include.messages')
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Select Customer</label>
                           <select class="form-control" name="customer">
                               @foreach($customers as $customer)
                                   <option value="{{$customer->id}}">{{$customer->name}}</option>
                               @endforeach
                           </select>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                           <textarea class="form-control" name="message"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success">Send Message</button>
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

    <div class="modal fade" id="addAssessment">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Send a Message/h5>
                        <button type="button" class="close" aria-hidden="false" data-dismiss="modal">
                            &times;
                        </button>
                    </div>
                    <form method="post" action="{{url('/storeAssessment')}}">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" id="application_id" name="application_id" value="{{$student->id}}">
                            <div class="form-group">
                                <label class="col-form-label" for="course_id">Course</label>
                                <select name="course_id" id="course_id" class="form-control shadow-sm" onclick="checkerX()">
                                    @foreach($smss as $cour)
                                        <option value="{{$course->id}}">{{$course->course_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="marks">Marks<span id="mks"></span></label>
                                <input type="number" min="0" id="marks" class="form-control" name="marks">
                            </div>
  
  
                            <div class="form-group">
                                <label class="col-form-label" for="marks">Marks<span id="mks"></span></label>
                                <input type="number" min="0" id="marks" class="form-control" name="marks">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</body>
</html>
