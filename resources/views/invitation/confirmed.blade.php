<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#fff7f4">
    <title>C’est un date 💕</title>
    @vite(['resources/css/invitation.css', 'resources/js/invitation.js'])
</head>
<body class="confirmed-page">
<main class="confirmation-wrap">
    <div class="confirmation-card">
        <div class="success-icon">💞</div>
        <p class="eyebrow">Invitation acceptée</p>
        <h1>C’est officiellement un date !</h1>
        <p class="lead">Excellent choix, {{ $invitation->recipient_name }}. {{ $invitation->sender_name }} vient probablement de sourire très fort.</p>

        <div class="summary-card confirmation-summary">
            <div><span>Ambiance</span><strong>{{ $invitation->response->activity }}</strong></div>
            <div><span>Date</span><strong>{{ $invitation->response->selected_date->locale('fr')->translatedFormat('l j F Y') }}</strong></div>
            <div><span>Heure</span><strong>{{ str_replace(':', ' h ', $invitation->response->selected_time) }}</strong></div>
        </div>

        @if ($invitation->response->personal_message)
            <div class="message-bubble">“{{ $invitation->response->personal_message }}”</div>
        @endif

        <p class="signature">Rendez-vous validé avec beaucoup trop de sérieux 💌</p>
    </div>
</main>
<script>document.documentElement.dataset.confirmed = 'true';</script>
</body>
</html>
