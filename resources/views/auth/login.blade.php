<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Bootstrap Google Plus Style Login Form - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">

        body{
            background-color: #29abe2;
            margin-top: 20px;
        }

        /* custom google plus style theme */
        @import url(http://fonts.googleapis.com/css?family=Roboto:400);
        body {
            background-color:#e0e0e0;
            -webkit-font-smoothing: antialiased;
            font: normal 14px Roboto,arial,sans-serif;
            color:#545454;
        }

        .btn,.form-control,.panel,.list-group,.well {border-radius:1px;box-shadow:0 0 0;}
        .form-control {border-color:#d7d7d7;}
        .btn-primary {border-color:transparent;}
        .btn-primary,.label-primary,.list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus {background-color:#4285f4;}
        .btn-plus {background-color:#ffffff;border-width:1px;border-color:#dddddd;box-shadow:1px 1px 0 #999999;border-radius:3px;color:#666666;text-shadow:0 0 1px #bbbbbb;}
        .well,.panel {border-color:#d2d2d2;box-shadow:0 1px 0 #cfcfcf;border-radius:3px;}
        .btn-success,.label-success,.progress-bar-success{background-color:#65b045;}
        .btn-info,.label-info,.progress-bar-info{background-color:#a0c3ff,border-color:#a0c3ff;}
        .btn-danger,.label-danger,.progress-bar-danger{background-color:#dd4b39;}
        .btn-warning,.label-warning,.progress-bar-warning{background-color:#f4b400;color:#444444;}

        hr {border-color:#ececec;}
        button {
            outline: 0;
        }

        .panel .btn i,.btn span{
            color:#666666;
        }
        .panel .panel-heading {
            background-color:#ffffff;
            font-weight:700;
            font-size:16px;
            color:#262626;
            border-color:#ffffff;
        }
        .panel .panel-heading a {
            font-weight:400;
            font-size:11px;
        }
        .panel .panel-default {
            border-color:#cccccc;
        }
        .panel .img-circle {
            width:50px;
            height:50px;
        }

        h3,h4,h5 {
            border:0 solid #efefef;
            border-bottom-width:1px;
            padding-bottom:10px;
        }

        .modal-dialog {
            width: 450px;
        }

        .modal-footer,.modal-content,.modal-header {
            border-width:0;
        }


    </style>
</head>
<body>
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true" style="background-color: #29abe2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-center"><img style="height: 240px; width: 240px" src="{{asset('img/resources/logo.png')}}" class="img-circle"><br>Login</h2>
            </div>
            <div class="modal-body">
                <form class="form col-md-12 center-block" method="post" action="{{route('login')}}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control input-lg" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control input-lg" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg btn-block" style="margin-bottom: 10px">Sign In</button>
                        <span class="pull-right"><a href="{{route('register')}}">Registrar</a></span><span><a target="_blank" href="https://github.com/gwathsule/e-conomy-simulator">Github</a></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</body>
</html>