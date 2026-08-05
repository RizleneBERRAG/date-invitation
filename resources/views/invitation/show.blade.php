<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#fff7f4">
    <title>{{ $invitation->title }}</title>

    <link
        rel="stylesheet"
        href="{{ route('invitation.asset', ['file' => 'invitation-base.css']) }}"
    >
    <link
        rel="stylesheet"
        href="{{ route('invitation.asset', ['file' => 'mobile.css']) }}"
    >
    <script
        src="{{ route('invitation.asset', ['file' => 'invitation.js']) }}"
        defer
    ></script>
</head>
<body>
<main class="invitation-page">
    <div class="ambient ambient-one"></div>
    <div class="ambient ambient-two"></div>

    <section class="invitation-shell" data-invitation-app>
        <header class="topbar">
            <div class="brand-mark">💌</div>
            <div class="progress-wrap" aria-label="Progression">
                <div class="progress-label">
                    <span data-progress-text>Invitation</span>
                    <span data-progress-count>1 / 7</span>
                </div>
                <div class="progress-track"><span data-progress-bar></span></div>
            </div>
        </header>

        @if ($errors->any())
            <div class="error-box">
                <strong>Il manque juste un petit détail.</strong>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('invitation.store', $invitation->token) }}" data-date-form>
            @csrf

            <input type="hidden" name="activity" value="{{ old('activity') }}" data-value="activity">
            <input type="hidden" name="selected_date" value="{{ old('selected_date') }}" data-value="selected_date">
            <input type="hidden" name="selected_time" value="{{ old('selected_time') }}" data-value="selected_time">
            <input type="hidden" name="food_preference" value="{{ old('food_preference') }}" data-value="food_preference">
            <input type="hidden" name="outfit_style" value="{{ old('outfit_style') }}" data-value="outfit_style">
            <input type="hidden" name="music_choice" value="{{ old('music_choice') }}" data-value="music_choice">
            <input type="hidden" name="romance_level" value="{{ old('romance_level') }}" data-value="romance_level">

            <article class="step is-active intro-step" data-step data-step-name="Invitation">
                <div class="envelope-scene" aria-hidden="true">
                    <div class="envelope">
                        <div class="envelope-back"></div>
                        <div class="letter-card">
                            <span>Pour {{ $invitation->recipient_name }} ✨</span>
                            <small>une proposition très sérieuse</small>
                        </div>
                        <div class="envelope-front"></div>
                        <div class="envelope-flap"></div>
                    </div>
                </div>

                <p class="eyebrow">Invitation confidentielle</p>
                <h1>{{ $invitation->title }}</h1>
                <p class="lead">{{ $invitation->intro_message }}</p>

                <div class="intro-actions" data-intro-actions>
                    <button
                        class="primary-btn intro-yes-btn"
                        type="button"
                        data-next
                        data-yes-btn
                    >
                        Oui, avec plaisir 💕
                    </button>

                    <button
                        class="text-btn intro-no-btn"
                        type="button"
                        data-no-btn
                    >
                        Non 🙈
                    </button>
                </div>

                <p class="tiny-note" data-intro-note>
                    Réfléchis bien, il paraît que cette invitation est irrésistible 😌
                </p>
            </article>

            <article class="step" data-step data-step-name="Ambiance" data-required="activity">
                <div class="step-heading">
                    <p class="eyebrow">Étape 1</p>
                    <h2>On part sur quelle ambiance ?</h2>
                    <p>Choisis la formule qui te donne le plus envie. Il n’y a pas de mauvaise réponse.</p>
                </div>

                <div class="choice-grid">
                    <button class="choice-card" type="button" data-choice="activity" data-choice-value="Dîner romantique" data-choice-label="Dîner romantique">
                        <span class="choice-emoji">🍝</span>
                        <strong>Dîner romantique</strong>
                        <small>Bien manger et parler trop longtemps.</small>
                    </button>

                    <button class="choice-card" type="button" data-choice="activity" data-choice-value="Activité et compétition" data-choice-label="Activité et compétition">
                        <span class="choice-emoji">🎳</span>
                        <strong>Activité et compétition</strong>
                        <small>Je te laisserai peut-être gagner.</small>
                    </button>

                    <button class="choice-card" type="button" data-choice="activity" data-choice-value="Balade et coucher de soleil" data-choice-label="Balade et coucher de soleil">
                        <span class="choice-emoji">🌅</span>
                        <strong>Balade et coucher de soleil</strong>
                        <small>Simple, joli et un peu cinéma.</small>
                    </button>

                    <button class="choice-card" type="button" data-choice="activity" data-choice-value="Surprise" data-choice-label="Surprise">
                        <span class="choice-emoji">🎁</span>
                        <strong>Surprend-moi</strong>
                        <small>Confiance maximale. Pression maximale.</small>
                    </button>
                </div>

                <div class="step-actions">
                    <button class="back-btn" type="button" data-back>Retour</button>
                    <button class="primary-btn" type="button" data-next>Continuer</button>
                </div>
            </article>

            <article
                class="step"
                data-step
                data-step-name="Date"
                data-required="selected_date"
            >
                <div class="step-heading">
                    <p class="eyebrow">Étape 2</p>
                    <h2>Quand est-ce que je réserve ton sourire ?</h2>
                    <p>
                        Cette fois, c’est toi qui choisis le jour.
                        Prends une date qui te fait envie ✨
                    </p>
                </div>

                <div class="single-date-picker" data-date-card>
                    <div class="date-love-burst" aria-hidden="true">
                        <span>💕</span>
                        <span>✨</span>
                        <span>💗</span>
                        <span>🌸</span>
                        <span>💞</span>
                    </div>

                    <div class="calendar-illustration" aria-hidden="true">
                        <div class="calendar-rings">
                            <span></span>
                            <span></span>
                        </div>

                        <div class="calendar-top">Notre date</div>
                        <div class="calendar-heart">💕</div>
                        <span class="calendar-caption">Journée importante</span>
                    </div>

                    <div class="date-picker-content">
                        <span class="date-picker-kicker">À toi de choisir</span>

                        <h3 data-date-title>Quel jour te conviendrait ?</h3>

                        <p data-date-preview>
                            Je garderai cette journée rien que pour toi.
                        </p>

                        <label class="date-input-wrapper">
                            <span class="date-input-label">Choisir notre date</span>

                            <span class="date-input-control">
                                <input
                                    id="chosen-date"
                                    class="date-choice-input"
                                    type="date"
                                    min="{{ now()->toDateString() }}"
                                    value="{{ old('selected_date') }}"
                                    data-date-picker
                                >

                                <span class="date-input-icon" aria-hidden="true">📅</span>
                            </span>
                        </label>

                        <span class="date-reassurance">
                            Promis, je ne programmerai rien d’autre ce jour-là 😌
                        </span>
                    </div>
                </div>

                <div class="step-actions">
                    <button class="back-btn" type="button" data-back>Retour</button>
                    <button class="primary-btn" type="button" data-next>Continuer</button>
                </div>
            </article>

            <article class="step" data-step data-step-name="Heure" data-required="selected_time">
                <div class="step-heading">
                    <p class="eyebrow">Étape 3</p>
                    <h2>À quelle heure commence notre excellente idée ?</h2>
                    <p>Promis, j’essaierai même d’être à l’heure.</p>
                </div>

                <div class="time-grid">
                    @foreach (($invitation->available_times ?? []) as $time)
                        <button
                            class="time-pill"
                            type="button"
                            data-choice="selected_time"
                            data-choice-value="{{ $time }}"
                            data-choice-label="{{ str_replace(':', ' h ', $time) }}"
                        >
                            {{ str_replace(':', ' h ', $time) }}
                        </button>
                    @endforeach
                </div>

                <label class="field-label" for="custom-time">Une autre heure</label>
                <input class="pretty-input" id="custom-time" type="time" data-custom-value="selected_time">

                <div class="step-actions">
                    <button class="back-btn" type="button" data-back>Retour</button>
                    <button class="primary-btn" type="button" data-next>Continuer</button>
                </div>
            </article>

            <article class="step" data-step data-step-name="Détails">
                <div class="step-heading">
                    <p class="eyebrow">Étape 4</p>
                    <h2>Les réglages très importants</h2>
                    <p>Quelques détails scientifiques pour optimiser ce date.</p>
                </div>

                <div class="question-block">
                    <h3>Plutôt sucré ou salé ?</h3>
                    <div class="pill-row">
                        <button type="button" data-choice="food_preference" data-choice-value="Sucré" data-choice-label="Sucré">Sucré 🍰</button>
                        <button type="button" data-choice="food_preference" data-choice-value="Salé" data-choice-label="Salé">Salé 🍕</button>
                        <button type="button" data-choice="food_preference" data-choice-value="Les deux" data-choice-label="Les deux">Les deux, soyons sérieux</button>
                    </div>
                </div>

                <div class="question-block">
                    <h3>Tenue du jour ?</h3>
                    <div class="pill-row">
                        <button type="button" data-choice="outfit_style" data-choice-value="Tranquille" data-choice-label="Tranquille">Tranquille 😌</button>
                        <button type="button" data-choice="outfit_style" data-choice-value="Élégante" data-choice-label="Élégante">Élégante ✨</button>
                        <button type="button" data-choice="outfit_style" data-choice-value="Surprise" data-choice-label="Surprise">Surprise</button>
                    </div>
                </div>

                <div class="question-block">
                    <h3>Qui gère la musique ?</h3>
                    <div class="pill-row">
                        <button type="button" data-choice="music_choice" data-choice-value="Elle" data-choice-label="Toi">Toi 🎧</button>
                        <button type="button" data-choice="music_choice" data-choice-value="Moi" data-choice-label="Moi">Moi 😎</button>
                        <button type="button" data-choice="music_choice" data-choice-value="Une chanson chacun" data-choice-label="Une chanson chacun">Une chanson chacun</button>
                    </div>
                </div>

                <div class="question-block">
                    <h3>Niveau de romantisme autorisé ?</h3>
                    <div class="pill-row">
                        <button type="button" data-choice="romance_level" data-choice-value="Discret" data-choice-label="Discret">Discret 😌</button>
                        <button type="button" data-choice="romance_level" data-choice-value="Mignon" data-choice-label="Mignon">Mignon 🥰</button>
                        <button type="button" data-choice="romance_level" data-choice-value="On verra" data-choice-label="On verra">On verra 💍</button>
                    </div>
                </div>

                <div class="step-actions">
                    <button class="back-btn" type="button" data-back>Retour</button>
                    <button class="primary-btn" type="button" data-next>Continuer</button>
                </div>
            </article>

            <article class="step" data-step data-step-name="Message">
                <div class="step-heading">
                    <p class="eyebrow">Étape 5</p>
                    <h2>Un dernier mot ?</h2>
                    <p>Une demande spéciale, un avertissement ou un compliment extrêmement mérité.</p>
                </div>

                <textarea
                    class="pretty-textarea"
                    name="personal_message"
                    maxlength="500"
                    placeholder="Écris quelque chose ici…"
                >{{ old('personal_message') }}</textarea>

                <div class="step-actions">
                    <button class="back-btn" type="button" data-back>Retour</button>
                    <button class="primary-btn" type="button" data-next>Voir le récapitulatif</button>
                </div>
            </article>

            <article class="step" data-step data-step-name="Confirmation">
                <div class="step-heading centered">
                    <p class="eyebrow">Dernière étape</p>
                    <h2>Donc… c’est officiellement un date ?</h2>
                    <p>Relis le contrat très sérieux avant de signer.</p>
                </div>

                <div class="summary-card">
                    <div><span>Ambiance</span><strong data-summary="activity">—</strong></div>
                    <div><span>Date</span><strong data-summary="selected_date">—</strong></div>
                    <div><span>Heure</span><strong data-summary="selected_time">—</strong></div>
                    <div><span>Romantisme</span><strong data-summary="romance_level">Au feeling</strong></div>
                </div>

                <label class="consent-line">
                    <input type="checkbox" required>
                    <span>J’accepte ce date et les possibles papillons dans le ventre.</span>
                </label>

                <div class="step-actions final-actions">
                    <button class="back-btn" type="button" data-back>Modifier</button>
                    <button class="primary-btn celebration-btn" type="submit">Confirmer le date 💕</button>
                </div>
            </article>
        </form>
    </section>
</main>
</body>
</html>
