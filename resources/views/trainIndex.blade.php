@extends('layouts.master')
<body>
    <div class="container-fluid text-capitalize">
        <div class="row bg-dark text-white p-3">
            <div class="col-md-12 text-center">
                index for railway api operations
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <img src="https://image.shutterstock.com/image-vector/platform-railway-icon-outline-illustration-260nw-706812253.jpg" height="260px" style="transform: rotateY(180deg)">
            </div>
            <div class="col-md-4 pt-5">
                <ul class="list-group list-group-flush pt-5" style="cursor:pointer">
                    <li class="list-group-item"><a href="{{route('trainInfo.searchByName')}}">search trains by name</a></li>
                    <li class="list-group-item"><a href="{{route('trainInfo.searchByNumber')}}">search trains by number</a></li>
                    <li class="list-group-item">direction map</li>
                    <li class="list-group-item"><a>find trains between stations</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>