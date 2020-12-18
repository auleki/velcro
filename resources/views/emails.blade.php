<!DOCTYPE html>
<html>
<head>
    <title>With Love from EchoVC</title>
</head>
<body>
    <h2>{{ $details['image'] }}"</h2>
    <img src="/storage/images/{!! $details['image'] !!}" />
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>

    <p>Regards</p>

</body>
</html>
