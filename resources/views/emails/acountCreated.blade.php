<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Compte Créé</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .header {
            background-color: #3498db;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .content {
            padding: 20px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 13px;
            color: #888;
            text-align: center;
        }
        .credentials {
            background-color: #f1f1f1;
            padding: 10px;
            border-left: 4px solid #3498db;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>Bienvenue sur notre plateforme</h2>
        </div>
        <div class="content">
            <p>Bonjour,</p>
            <p>Votre compte a été <strong>créé avec succès</strong>.</p>

            <div class="credentials">
                <p><strong>Login :</strong> {{ $email }}</p>
                <p><strong>Mot de passe :</strong> {{ $email }}</p>
            </div>

            <p><strong>⚠️ Veuillez changer votre mot de passe dès votre première connexion.</strong></p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Votre Application. Tous droits réservés.
        </div>
    </div>
</body>
</html>
