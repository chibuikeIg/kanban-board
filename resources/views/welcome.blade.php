<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <title>Kanban Board</title>
</head>
<body>
    <div id="app">
        <main-component></main-component>
    </div>
    @vite(['resources/js/app.js'])
</body>
</html>