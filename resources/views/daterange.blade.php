<!DOCTYPE html>
<html lang="en">
<head>
  <title>Asteroid Task</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Select Dates to Get Asteroid Details</h4>
                    </div>
                    <div class="card-body">                  
                        <form method="POST" action="{{ url('get-asteroid-details') }}" id="submitForm">
                        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Start Date: <span class="text-danger" id="start_err"></span></label>
                                        <input type="text" class="form-control datepicker" id="start_date" name="start_date">
                                    </div>            
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">End Date: <span class="text-danger" id="end_err"></span></label>
                                        <input type="text" class="form-control datepicker" id="end_date" name="end_date">
                                    </div>            
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" id="submitButton" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script><script>
$( document ).ready(function() {
    $(".datepicker").datepicker({ 
        dateFormat: 'yy-mm-dd'
    });
})
$('body').on('click', '#submitButton', function () {
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    if (start_date=="") {
        $("#start_err").fadeIn().html("Required");
        setTimeout(function(){ $("#start_err").fadeOut(); }, 3000);
        $("#start_date").focus();
        return false;
    }
    if (end_date=="") {
        $("#end_err").fadeIn().html("Required");
        setTimeout(function(){ $("#end_err").fadeOut(); }, 3000);
        $("#end_date").focus();
        return false;
    }
    else{
        $("#submitForm").submit();
    }
})
</script>
</body>
</html>
