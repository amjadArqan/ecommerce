<html>
    <head>
       <title>Welcome Email</title>
    </head>
    <body>
        <table>
            <tr><td>Der {{ $name }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Your account has been successfully activated.<br>Your account information is as below:</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><a href="{{url('confirm/'.$code)}}">Confirm Account</a></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Thanks & Regards,</td></tr>
            <tr><td>E-com Website</td></tr>





        </table>
    </body>

</html>