<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authorize echoVC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<style>
    body{
        font-family: 'Helvetica Neue', sans-serif;
    }
</style>
<body>
    <div class="col-9">
        <section class="header">
            <h3> Authorize echoVC to access your account</h3>

            <div class="row ml-0">
                <button class="btn btn-primary btn-sm "> Authorize app</button>
                <button class="btn btn-outline-dark btn-sm ml-4  text-info"> Cancel</button>
            </div>

            <div class="spec mt-3">
                <p class="text-success"> This application will be able to: </p>

                <ul>
                    <li>
                        See Tweets from your timeline (including protected Tweets) as well as your Lists and collections.
                    </li>

                    <li>
                        See your Twitter profile information and account settings.
                    </li>

                    <li>
                        See accounts you follow, mute, and block.
                    </li>
                </ul>

                <p> Learn more about third-party app permissions in the <a href="" class="text-muted"> Help Center</a></p>
            </div>
        </section>
    </div>

    <div class="col-3">
        

    </div>
</body>
</html>