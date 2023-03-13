<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ol>
        <li>Nome: {{ auth()->user()->name }}</li>
        <li>Documento: {{ auth()->user()->client->document }}</li>
        <li>Status da assinatura: {{ auth()->user()->client->signatures->first()->status->name }}</li>
    </ol>
</body>
</html>