@extends('layouts.user')

@section('title', 'Welcome')

@section('content')
    <h3><i class="glyphicon glyphicon-home"></i> ホーム</h3>

    <hr>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Notices</h4></div>
            <div class="panel-body">

                <div style="display: none;" class="alert alert-info in">
                    <button type="button" class="close" data-dismiss="alert">�</button>
                    This is a dismissable alert.. just sayin'.
                </div>

                This is a dashboard-style layout that uses Bootstrap
                3. You can use this template as a starting point to create something
                more unique.
                <br><br>
                Visit the Bootstrap Playground at <a href="http://usebootstrap.com/theme/admin">Bootply</a> to tweak
                this layout or discover more useful code snippets.
            </div>
        </div>

    </div>

@endsection