<DOCTYPE html>
    <html lang="en-US">
    <head>
    </head>
    <body>
        Hi {{ $patient->firstName }},
        Thank you for using MyRecord. Please click link below to verify your email

        <a href="https://yuzzapp.com?code={{ $patient->code }}&email={{ $patient->emailAddress }}">YuzzApp.com</a>

        If you did not sign up for a MyRecord account please disregard this email.

        Thank You
        MyRecords
    </body>
</html>
