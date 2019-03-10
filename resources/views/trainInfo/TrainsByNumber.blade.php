@extends('layouts.master')
<!-- Online jQuery Link -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<body>
    <div class="container-fluid text-capitalize">
        <div class="row bg-dark text-white p-3">
            <div class="col-md-12 text-center">
                search train by their number
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Enter Train Number" id="trainNumber">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <button type="submit" class="btn btn-dark" id="searchByNumber">Search Train</button>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <span class=""><a href="{{route('rail-index')}}">get back to home</a></span>
            </div>
        </div>
        <p id="errorCode"></p>
        <div class="row">
            <div class="col-md-8 offset-md-2 p-3 text-center" style="display:none;" id="train-info-container">
                <span class="h4">train information</span>
                <p id="trainName" class="p-3"></p>
                <table class="table table-striped">
                    <tr id="trainRunDay" class="text-center"></tr>
                    <tr id="trainRunStatus" class="text-center"></tr>
                </table>
            </div>
            <div class="col-md-10 offset-md-1" style="display:none;" id="route-info-container">
                <table class="table table-striped">
                    <thead>
                        <tr><th>Source Station</th><th>Scheduled Arrival</th><th>Scheduled Departure</th></tr>
                    </thead>
                    <tbody id="response"></tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $('#searchByNumber').on('click', function(){
            var apiKey = 'YOUR_API_KEY_HERE';
            if($('#trainNumber').val() != '') {
                $.ajax({
                    url     : 'https://SERVER/v2/route/train/'+($('#trainNumber').val())+'/apikey/'+apiKey+'/',
                    type    : 'get',
                    dataType: 'json',
                    success : function(response){
                        
                        // Emptying the data container
                        $("#trainRunDay").empty();
                        $("#trainRunStatus").empty();
                        $("#response").empty();
                        
                        if(JSON.stringify(response.response_code) == '404'){
                            $('#errorCode').text('No train available with this number in indian railways.');
                        }else if(JSON.stringify(response.response_code) == '502'){
                            $('#errorCode').text('kindly enter any number.');
                        }else{
                            $('#errorCode').empty();
                            $('#train-info-container').show();
                            $('#route-info-container').show();
                            $('#trainName').text(JSON.stringify(response.train.number+" - "+response.train.name));
                            $.each(response.train.days, function(key, value){
                                $('#trainRunDay').append("<th>"+value.code+"</th>");
                            });
                            $.each(response.train.days, function(key, value){
                                $('#trainRunStatus').append("<th>"+value.runs+"</th>");
                            });
                            $.each(response.route, function(key, value){
                                $('#response').append("<tr><td>"+value.station.name+" ("+value.station.code+")</td><td>"+value.scharr+" (Day "+value.day+")</td><td>"+value.schdep+" (Day "+value.day+")</td></tr>");
                            });
                        }
                    }
                });
            }
            return false;
        });
    });
</script>
</html>
