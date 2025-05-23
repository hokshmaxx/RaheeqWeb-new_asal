<!doctype html>

<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">


  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@700;900&display=swap" rel="stylesheet">
  <!--FavIcone -->




</head>

<body style="text-align: center;background: #EBF0F5;font-family: system-ui;">

    <div class="card" style="background: #fff; width: 400px;min-height: 600px;margin:auto; position: relative;overflow: hidden;">

        <p style="margin-bottom:30px;color: #404F5E;font-size:20px; padding:0 15px"> {{__('cp.welcome you in ASAL')}} </p>
        <p style="margin-bottom:30px;color: #404F5E;font-size:20px;">{{__('cp.You are receiving this email because we received a password reset request for your account.')}}
</p>
         <a href="{{$url}}" rel="noopener" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';border-radius:4px;color:#fff;display:inline-block;overflow:hidden;text-decoration:none;background-color:#2d3748;border-bottom:8px solid #2d3748;border-left:18px solid #2d3748;border-right:18px solid #2d3748;border-top:8px solid #2d3748" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://amaz.sa/ar/password/reset/d58d86928eef2a3e4ef8efe61e2d583c4a281d4aa40ec006f5eb0717dc04b5c7&amp;source=gmail&amp;ust=1628582972229000&amp;usg=AFQjCNFBaD9DpVz5gy00hDOsRCdBo5w7Iw">{{__('cp.Reset Password')}}</a>
        <h5 style="color: #404F5E;font-size:16px; padding:0 15px">{{__('cp.If you are having trouble clicking button, copy and paste the URL below into your web browser:')}}</h5>
        <a href="{{$url}}" style=" padding:0 15px;color: #5a1a8b"> {{$url}}</a>
 
        <!--<div class="img-amz" style="position: absolute;bottom: 0;left: 0;">-->
            <!--<img src="{{url('website/images/img-amz.png')}}" alt="" style="max-width: 100%;" />-->
        <!--</div>-->
    </div>
</body>

</html>

