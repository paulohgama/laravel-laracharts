<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>
    <body>
        @include('include')
        <p>
                <form action="{{route('operatrix.performance')}}">
                    <select name="ano" id="ano">
                        <option value="">Selecione o ano...</option>
                        @foreach ($anos as $ano)
                            <option value="{{$ano->ano}}" {{$ano_request == $ano->ano ? 'selected' : ''}}>{{$ano->ano}}</option>
                        @endforeach
                    </select>
                    <select name="status" id="status">
                            <option value="">Selecione o status...</option>
                            @foreach ($status as $item)
                                <option value="{{$item->ds_status}}" {{$status_request == $item->ds_status ? 'selected' : ''}}>{{$item->ds_status}}</option>
                            @endforeach
                    </select>
                    <button class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
                </form>
            </p>
        <div id="pop_div" style="height: 400px;">
            {!!\Lava::render('LineChart', 'Performance_Linha', 'pop_div')!!}
        </div>
        <div id="pop_div2" style="height: 400px;">
            {!!\Lava::render('AreaChart', 'Performance_Area', 'pop_div2')!!}
        </div>
    </body>
</html>
