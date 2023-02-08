<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Novo Lead!</h1>
    <p>
        {{ $data['name'] }}ha appena inviato questo messaggio
    </p>
    <p>
        {{ $data['message'] }}
    </p>

    <h3>Rispondi al suo indirizzo email{{ $data['email'] }}</h3>
</body>
</html>
