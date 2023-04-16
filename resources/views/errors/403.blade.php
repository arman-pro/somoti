<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Unauthorized Action</title>
  </head>
  <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="text-center">Unauthorized</h4>
                            <p class="text-center">
                                {{ $exception->getMessage() }}
                            </p>
                            <a href="{{route("dashboard")}}" class="btn btn-dark btn-sm">Go to Dashboard</a>
                            <a href="{{url()->previous()}}" class="btn btn-outline-dark btn-sm">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </body>
</html>