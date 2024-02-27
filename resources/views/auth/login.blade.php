<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Name | Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>

    <style>
    body {
        background: linear-gradient(90deg, rgba(33, 33, 48, 1) 0%, rgba(57, 48, 74, 1) 35%);
    }
    </style>
</head>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="card col-md-4 p-5 shadow-sm border rounded-5 border-primary">
            <h2 class="text-center mb-4 text-primary">Welcome!</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email"
                            class="form-control bg-info bg-opacity-10 border border-primary">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password"
                            class="form-control bg-info bg-opacity-10 border border-primary">
                    </div>
                    <hr>
                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>