<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('')}}">
    <title>posty</title>
</head>

<body class="bg-gray-200">
    <nav class="p-5 bg-white flex justify-between">
        <ul class="flex items-center">
            <li>
                <a rel="stylesheet" href="" class = "p-3 ">Home</a>
            </li>
            <li>
                <a rel="stylesheet" href="" class = "p-3 ">Dashboard</a>
            </li>
            <li>
                <a rel="stylesheet" href="" class = "p-3 ">Post</a>
            </li>
            <li>
                <a rel="stylesheet" href="" class = "p-3 ">about</a>
            </li>
        </ul>

        <ul class="flex items-center">
            <li>
                <a rel="stylesheet" href="" class = "p-3 ">Ashish</a>
            </li>
            <li>
                <a rel="stylesheet" href="" class = "p-3 ">Login</a>
            </li>
            <li>
                <a rel="stylesheet" href="" class = "p-3 ">logout</a>
            </li>
        </ul>
    </nav>
    @yield('content')
</body>

</html>
