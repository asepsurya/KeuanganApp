<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activation</title>
</head>
<body>
    <h1>Hi {{ $user->name }},</h1>
    <p>Thank you for registering. Please click the link below to activate your account:</p>
    <a href="{{ url('account/activate/'.$token) }}">Activate Account</a>
</body>
</html>
