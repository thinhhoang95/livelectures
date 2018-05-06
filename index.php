<!DOCTYPE html>
<html lang="en" style="height: 100%">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <title>LiveLectures Beta - Login</title>
    <style>

    </style>
</head>
<body style="height: 100%">

<?php
if(isset($_COOKIE["ident"]))
{
    header('location:learn.php');
}
?>

<div class="container" style="height:100%">
    <div class="row align-items-center" style="height: 100%">
        <div class="col-md-4">
            <h1 class="display-4">Welcome to LiveLectures</h1>
            <form action="bin/login.php" method="post" id="login_data_frm">

                <div class="form-group">
                    <label for="identity">Identity</label>
                    <input type="text" name="ident" class="form-control" id="identity" placeholder="Your identity">
                </div>
                <div class="form-group">
                    <label for="identity">Server IP Address</label>
                    <input type="text" name="ip" class="form-control" id="IP" placeholder="Server IP">
                </div>
                <button type="button" class="btn btn-primary" id="login_btn">Login</button>
                <p style="font-size: 10pt" class="mt-3 mx-auto text-center">Copyright 2018 (c) NeuralMetrics SA. All rights reserved.</p>
            </form>
        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

<script>
    $("#login_btn").on("click",function(){
        $("#login_data_frm").submit();
    });
</script>

</body>
</html>