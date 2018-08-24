<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" type="image/x-icon"
          href="http://localhost:8000/resources/images/activity-history.png">
</head>
<body class="dt-example dt-example-bootstrap">

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Anomalies in <span>System</span>
                <span class="badge badge-pill badge-danger">{{$data['danger']}}</span>
                <span class="badge badge-pill badge-warning">{{$data['warning']}}</span>
                <span class="badge badge-pill badge-info">{{$data['info']}}</span>
            </h1>
        </div>
        <div class="panel-body">
            <section>


                <div class="alert alert-danger" role="alert">
                    <b><i>{{$data['errorr_back']}}</i></b> error loged in backend
                </div>
                <div class="alert alert-danger" role="alert">
                    <b><i>{{$data['errorr_front']}}</i></b> error loged in frontend
                </div>
                @foreach($data['modules'] as $idx=>$module)
                    @if(count($module['anomaly']['danger']) || count($module['anomaly']['warning']) || count($module['anomaly']['info']))
                        <ul class="list-group">
                            <li class="list-group-item">{{$module['name']}}</li>
                            @foreach(['danger','warning','info'] as $idxx=>$etype)
                                @foreach($module['anomaly'][$etype] as $idxxx=>$mg)
                                    <li data-toggle="collapse" href="#collapse-{{$idx}}-{{$idxx}}-{{$idxxx}}"
                                        class="list-group-item list-group-item-{{$etype}}">{{$mg['note']}}</li>
                                    <div id="collapse-{{$idx}}-{{$idxx}}-{{$idxxx}}" class="panel-collapse collapse">
                                        <pre>{{$mg['ids']}}</pre>
                                    </div>
                                @endforeach
                            @endforeach
                        </ul>
                        <div class="clearfix"></div>
                    @endif
                @endforeach
            </section>
        </div>
        <div class="clearfix"></div>
        <div class="panel-footer">
            <div class="clearfix"></div>
        </div>
    </div>
</div>

</body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</html>
