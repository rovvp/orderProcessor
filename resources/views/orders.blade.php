@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Order Processor</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h4>Error</h4>
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @elseIf (count($orders) > 0)
                        <div class="alert alert-info">
                            <p>The file has been sent for processing. Each client contained will be sent a reminder of their invoice via email shortly</p>
                            <p>Please check the list below to ensure there are no processing errors.</p>
                            @foreach ($orders as $key=>$order)
                                @if (count($order['errors']))
                                    @foreach ($order['errors'] as $error) 
                                        File row {{ $key }} contains {{ $error }} and was not processed<br />
                                    @endforeach
                                @else
                                File row {{ $key }} was processed successfully <br />
                                @endIf
                            @endforeach
                        </div>
                    @endIf
                    <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('/upload')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Please select a CSV to process</label>
                            <input type="file" name="file" class="form-control-file" id="file">
                            </div>
                            <button type="submit" class="btn btn-primary">Upload CSV</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
