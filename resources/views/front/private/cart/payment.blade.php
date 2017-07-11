<!doctype html>

<html lang="en">
<head>
    <title><!-- Insert your title here --></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<form method=POST action="{{ $url }}" id="paymentSubmit">


Loading................................
{!! $fields !!}
</form>
    <script>
        $(function(){
            $('#paymentSubmit').submit();
        });
    </script>
</body>
</html>
