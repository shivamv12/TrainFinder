<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

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
                color: white;
                text-shadow: 0 0 2px rgba(61,173,238,0.5);
            }

            .links > a {
                /* color: #636b6f; */
                color: white;
                padding: 0 25px;
                font-size: 1em;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            body {
                /* background-image: url('http://xdesktopwallpapers.com/wp-content/uploads/2012/07/Closeup%20of%20Night%20Scene%20on%20Railway%20Station.jpg'); */
                background-image: url('https://goldwallpapers.com/uploads/posts/indian-railway-wallpaper/indian_railway_wallpaper_026.jpg');
                background-size: 100%;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://linkedin.com/in/shivamv1996/" target="_blank">LinkedIn</a>
                    <a href="https://github.com/shivamv12" target="_blank">GitHub</a>
                    <a href="http://teamscorpion.in/shivamverma" target="_blank">Developer Profile</a>
                    <a href="{{route('rail-index')}}">Railway Zone</a>
                </div>
            </div>
        </div>
    </body>
</html>
