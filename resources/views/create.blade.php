@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Order Pizza</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <order-alert user_id="{{ auth()->user()->id }}"></order-alert>

                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="{{ route('user.orders.store') }}" class="form-horizontal">
                                {{ csrf_field() }}

                                <div class="form-group"><label class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-10"><input type="text" name="address" placeholder="Your Address" class="form-control"></div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Size</label>

                                    <div class="col-sm-10">
                                        @foreach($sizes as $size)
                                        <div><label> <input type="radio" checked="" value="{{$size->id}}" id="{{$size->id}}" name="size"> {{$size->name}} </label></div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Toppings</label>
                                    <div class="col-sm-10">
                                        @foreach($toppings as $topping)
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="toppings[]" value="{{$topping->name}}" id="{{$topping->name}}"> {{$topping->name}}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Instructions</label>

                                    <div class="col-sm-10"><input type="text" name="instructions" placeholder="Special Instructions here" class="form-control"></div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-success" type="submit">Order Now</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
