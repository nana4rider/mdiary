@extends('layouts.user')

@section('title', 'Welcome')

@section('content')
    <h3><i class="glyphicon glyphicon-dashboard"></i> Dashboard</h3>

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

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Visits</th>
                <th>ROI</th>
                <th>Source</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>45</td>
                <td>2.45%</td>
                <td>Direct</td>
            </tr>
            <tr>
                <td>289</td>
                <td>56.2%</td>
                <td>Referral</td>
            </tr>
            <tr>
                <td>98</td>
                <td>25%</td>
                <td>Type</td>
            </tr>
            <tr>
                <td>..</td>
                <td>..</td>
                <td>..</td>
            </tr>
            <tr>
                <td>..</td>
                <td>..</td>
                <td>..</td>
            </tr>
            </tbody>
        </table>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="glyphicon glyphicon-wrench pull-right"></i>
                    <h4>Post Request</h4>
                </div>
            </div>
            <div class="panel-body">

                <form class="form form-vertical">

                    <div class="control-group">
                        <label>Name</label>

                        <div class="controls">
                            <input class="form-control" placeholder="Enter Name" type="text">
                        </div>
                    </div>

                    <div class="control-group">
                        <label>Message</label>

                        <div class="controls">
                            <textarea class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label>Category</label>

                        <div class="controls">
                            <select class="form-control">
                                <option selected="selected">options</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label></label>

                        <div class="controls">
                            <button type="submit" class="btn btn-primary">
                                Post
                            </button>
                        </div>
                    </div>

                </form>


            </div>
            <!--/panel content-->
        </div>
        <!--/panel-->

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><h4>Engagement</h4></div>
            </div>
            <div class="panel-body">

            </div>
        </div>
        <!--/panel-->

    </div>

@endsection