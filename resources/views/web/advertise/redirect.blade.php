<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirection vers {{ $ad->advertiser_name }}</title>
    <meta http-equiv="refresh" content="3;url={{ $ad->url }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white;
        }

        .redirect-container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            max-width: 500px;
            width: 90%;
        }

        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 4px solid white;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        p {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .ad-info {
            margin-top: 20px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="redirect-container">
        <h2>Redirection en cours...</h2>
        <div class="spinner"></div>
        <p>Vous êtes redirigé vers <strong>{{ $ad->advertiser_name }}</strong></p>
        <p>Merci de votre intérêt pour cette publicité !</p>

        <div class="ad-info">
            <h3>{{ $ad->title }}</h3>
            <p>{{ $ad->description ?? 'Découvrez cette offre spéciale' }}</p>
        </div>

        <a href="{{ $ad->url }}" class="btn">Cliquez ici si la redirection ne fonctionne pas</a>

        <p style="margin-top: 20px; font-size: 14px; opacity: 0.8;">
            Vous serez redirigé automatiquement dans 3 secondes...
        </p>
    </div>

    <script>
        // Envoyer le clic au serveur
        fetch('{{ route("advertise.click", $ad->id) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        });

        // Redirection automatique après 3 secondes
        setTimeout(function() {
            window.location.href = '{{ $ad->url }}';
        }, 3000);
    </script>
</body>
</html>
