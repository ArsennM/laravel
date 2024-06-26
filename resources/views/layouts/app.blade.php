<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My App</title>
</head>
<body>
    <header>
        <!-- Здесь может быть ваша навигационная панель -->
    </header>

    <main>
        <div>
            @yield('content')
        </div>
    </main>

    <footer>
        <!-- Здесь может быть ваш подвал -->
    </footer>
</body>
</html>
