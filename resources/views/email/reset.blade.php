Hi {{$user->name}}!
<br>
You've request a password reset, please click on link below to reset your accounts password.
<br>
<a href="{{URL::to('/reset/password/'.$user->email.'/'.$token)}}">Reset Password</a>