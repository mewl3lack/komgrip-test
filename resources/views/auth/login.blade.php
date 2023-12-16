<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        
        @include('layout.app')

        <!-- Styles -->
        <style>
            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="container">
                  <div class="card card-plain">
                    <div class="card-header pb-0 text-left bg-transparent">
                      <h3 class="font-weight-bolder text-info text-gradient">Sign in</h3>
                      <p class="mb-0">Enter your email and password to sign in</p>
                    </div>
                    <div class="card-body">
                      <form role="form" method="POST">
                        @csrf
                        <label>Email</label>
                        <div class="mb-3">
                          <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                        </div>
                        <label>Password</label>
                        <div class="mb-3">
                          <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                        </div>
                        <div class="text-center">
                          <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                        </div>
                      </form>
                    </div>
                    @if($errors->any())
                        <div class="" style="margin: 10px;border-radius: 6px;border: 0.5px solid red;color:red;background-color: #FFC5B8;">
                            {{ implode('', $errors->all(':message')) }}
                        </div>
                    @endif
                  </div>
              </div>
            </div>
        </div>
    </body>
</html>
