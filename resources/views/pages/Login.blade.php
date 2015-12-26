@extends('layoutLogin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">

                    {!! Form::open(array('url' => 'admin')) !!}
                    <Form>
                        <div class="form-group">
                            <input class="form-control" placeholder="Username" name="Username" type="Username" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" value="">
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <input type="submit" class="btn btn-lg btn-success btn-block" value="submit" name="submit">
                    </Form>
                    {!! Form::close() !!}
                    @if($errors->has())
                    <p style="color:red">
                        <?php print_r($errors->first(0)) ?>
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop