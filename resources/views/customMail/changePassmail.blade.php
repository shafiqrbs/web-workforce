<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mail From HttConnect</title>
</head>
<body>
<div style="text-align: center;background-color: #edf2f7;  color: #3d4852; padding: 20px">
    <h1>HttConnect</h1>
    <div style="background-color: white; text-align: left;color: #3d4852;  padding: 30px;margin-left: 50px; margin-right: 50px;  border-top: 3px solid #b0b0b0; border-bottom: 3px solid #b0b0b0 ">
        <h4 style="border-top: 3px solid #b0b0b0;border-bottom: 3px solid #b0b0b0; padding: 5px; text-align: center;">Hi {{ $details['email']}},</h4>

        <p style="border-bottom:3px solid #b0b0b0; text-align: center; padding-bottom: 20px ">Your HTT Connect account ({{ $details['email']}}) password has been changed. You are getting this email to make sure it was you that initiated the change. </p>


        <p style="border-bottom:3px solid #b0b0b0; text-align: center; padding-bottom: 20px ">When: {{ $details['updated']}} (GMT - 8:00) Pacific Time (Us and Canada)</p>
        <p style="border-bottom:3px solid #b0b0b0; text-align: center; padding-bottom: 20px ">If you did not make this change, please <a href="{{ url('change/password')}}">click</a> here to reset your password.</p>
        <p style="border-bottom:3px solid #b0b0b0; text-align: center; padding-bottom: 20px ">Thanks for choosing HTT Connect<br>- The HTT Connect Team</p>
    </div>

     <div style="background-color: white; text-align: left;color: #3d4852;  padding: 30px;margin-left: 50px; margin-right: 50px; margin-bottom: 50px; border-bottom: 3px solid #b0b0b0 ">
        <p style="border-bottom:3px solid #b0b0b0; border-top:3px solid #b0b0b0; text-align: center; padding-bottom: 20px;padding-top: 20px; ">Copyright &copy;{{date('Y')}} HTT Connect, Inc. All rights reserved.</p>
    </div>
</div>
</body>
</html>