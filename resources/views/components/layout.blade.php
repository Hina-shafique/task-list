<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>project 2</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>
<body>
    <section class="max-w-4xl mx-auto mt-10 p-5 bg-white container">
        {{$slot}}
    </section>
</body>
</html>