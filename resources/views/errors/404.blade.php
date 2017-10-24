<!DOCTYPE html>
<html>
    <head>
        <title>
            Page Not Found.
        </title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
            <style>
                html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
            </style>
        </link>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">
                    Sorry, The page does not exist
                </div>
                <a class="btn btn-success" href="{{ url()->previous() }}">
                    Go Back
                </a>
                <a class="btn btn-danger" href="{{ route('welcome') }}">
                    Home
                </a>
            </div>
        </div>
    </body>
</html>
