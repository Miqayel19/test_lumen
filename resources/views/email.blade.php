<!DOCTYPE html>
<html>
<head>
    <title>Reset password Mail example</title>
</head>
<body>
<h1>Reset Password Email</h1>

You can reset password from bellow link:
<a href="{{ route('reset.password', $token) }}">Reset Password</a>

<p>Thank you</p>
</body>
</html>
