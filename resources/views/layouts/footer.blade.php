<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Shopily')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body>
    
    
    

    <footer class="bg-light text-center text-muted py-3 border-top">
        <div class="container">
            <small>&copy; {{ date('Y') }} Shopily. Tous droits réservés.</small>
        </div>
    </footer>
</body>
</html>
