@extends('layouts.master')
<!-- Online jQuery Link -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<body>
    <div class="container-fluid text-capitalize">
        <div class="row bg-dark text-white p-3">
            <div class="col-md-12 text-center">
                search train by name or keywords
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-8">
                <form action="{{route('trainInfo.searchtrainbyname')}}" method="post">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <input class="form-control" type="text" name="key-search" placeholder="Enter Train Name" id="trainName">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark" id="searchByNam">Search Train</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 text-right">
                <span class=""><a href="{{route('rail-index')}}">get back to home</a></span>
            </div>
        </div>
        <p id="errorCode"></p>
        <div class="row">
            <div class="col-md-8 offset-md-2 p-2 text-center" style="display:none;" id="train-info-container">
                <span class="h4">train information</span>
                <p id="trainInfo" class="p-3"></p>
                <table class="table table-striped">
                    <tr id="trainRunDay" class="text-center"></tr>
                    <tr id="trainRunStatus" class="text-center"></tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <table class="text-center">
                    <tr id="trainRakes"></tr>
                    <tr id="trainClasses"></tr>
                </table>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        $('#searchByName').on('click', function(){
            var apiKey = 'YOUR_API_KEY_HERE';
            if($('#trainName').val() != '') {
                $.ajax({
                    url  : 'https://SERVER/v2/name-number/train/'+$('#trainName').val()+'/apikey/'+apiKey+'/',
                    type : 'get',
                    dataType: 'json',
                    success : function(response){

                        $('#train-info-container').show();
                        // Empty the container 
                        $('#trainRakes').empty();
                        $('#trainClasses').empty();
                        $('#trainRunDay').empty();
                        $('#trainRunStatus').empty();

                        $('#trainInfo').text(JSON.stringify(response.train.number+" - "+response.train.name));

                        $.each(response.train.classes, function(key, value){
                            if(value.available == 'Y'){
                                $('#trainRakes').append("<td>"+value.name+" ("+value.code+") </td>");
                                $('#trainClasses').append("<th><img style='width:100%;' src='https://indianrailway2016.files.wordpress.com/2019/01/train-rajdhani-1.jpg'/></th>");
                            }else if(value.available == '-'){
                                $('#trainRakes').html("<th colspan='8'>Train runs with only General coaches.</th>");
                                $('#trainClasses').append("<th><img style='width:100%;' src='https://indianrailway2016.files.wordpress.com/2019/01/train-coach-blue-non-ac-1.jpg'/></th>");
                            }
                        });
                        $.each(response.train.days, function(key, value){
                            $('#trainRunDay').append("<th>"+value.code+"</th>");
                        });
                        $.each(response.train.days, function(key, value){
                            $('#trainRunStatus').append("<th>"+value.runs+"</th>");
                        });
                    }
                });
            }
            return false;
        });
    });
</script>
</html>
