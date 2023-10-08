<!DOCTYPE html>
<html>
<head>
    <title>Your Password</title>
</head>
<body>
    <p>Dear {{ $user->name }},</p>
    <p>Thank you for registering. Your generated password is: {{ $password }}</p>
    <p>Please change your password after logging in for security reasons.</p>
    <p>Regards,<br>Your App Team</p>
</body>
</html>
