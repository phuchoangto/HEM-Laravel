<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title')</title>
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
        <!-- MDB -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"rel="stylesheet"/>
        <!-- Custom CSS -->
        <style>
            body {
            background-color: #fbfbfb;
            }
            @media (min-width: 991.98px) {
            main {
            padding-left: 240px;
            }
            }

            /* Sidebar */
            .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0; /* Height of navbar */
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            width: 240px;
            z-index: 600;
            }

            @media (max-width: 991.98px) {
            .sidebar {
            width: 100%;
            }
            }
            .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
            }

            .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
            }
        </style>
        @yield('css')
    </head>       
    <body>
        <!--Main Navigation-->
        <header>
            @include('shared.sidebar')
            @include('shared.navbar')
        </header>
        <!--Main Navigation-->
        <!--Main Layout-->
        <main style="margin-top: 58px;">
            <div class="container pt-4">
                @yield('content')
            </div>         
        </main>
        <!--Main Layout-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- MDB -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
        <script>
        //set active class for sidebar depending on route
        $(document).ready(function() {
            var route = window.location.pathname.split('/')[2];
                $('a[data-route="' + route + '"]').addClass('active');
            });
        </script>
        @yield('js')
    </body>
</html>
