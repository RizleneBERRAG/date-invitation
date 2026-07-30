const app = document.querySelector('[data-invitation-app]');

function launchHearts(count = 24) {
    const emojis = ['💕', '💗', '✨', '💞'];

    for (let index = 0; index < count; index += 1) {
        window.setTimeout(() => {
            const heart = document.createElement('span');

            heart.className = 'floating-heart';
            heart.textContent =
                emojis[Math.floor(Math.random() * emojis.length)];

            heart.style.left = `${Math.random() * 100}vw`;
            heart.style.fontSize = `${16 + Math.random() * 20}px`;
            heart.style.animationDuration =
                `${2.4 + Math.random() * 1.8}s`;

            document.body.appendChild(heart);

            window.setTimeout(() => {
                heart.remove();
            }, 4500);
        }, index * 70);
    }
}

if (document.documentElement.dataset.confirmed === 'true') {
    launchHearts(38);
}

if (app) {
    const form = app.querySelector('[data-date-form]');
    const steps = [...app.querySelectorAll('[data-step]')];

    const progressBar = app.querySelector('[data-progress-bar]');
    const progressText = app.querySelector('[data-progress-text]');
    const progressCount = app.querySelector('[data-progress-count]');

    const yesButton = app.querySelector('[data-yes-btn]');
    const noButton = app.querySelector('[data-no-btn]');
    const introNote = app.querySelector('[data-intro-note]');

    const datePicker = app.querySelector('[data-date-picker]');
    const dateCard = app.querySelector('[data-date-card]');
    const dateTitle = app.querySelector('[data-date-title]');
    const datePreview = app.querySelector('[data-date-preview]');

    let currentStep = 0;
    let noClickCount = 0;

    const values = {};
    const labels = {};

    const yesMessages = [
        'Tu es sûre ? 🥺',
        'Allez… juste un petit date 😇',
        'Promis, ça va être trop bien ✨',
        'Réfléchis encore une fois 👀',
        'Tu me brises un peu le cœur là 😭',
        'Le bouton oui est juste ici 💕',
        'Bon… tu vas finir par dire oui 😌',
        'Je crois toujours en nous 🫶',
    ];

    const noMessages = [
        'Toujours non ? 😶',
        'Vraiment ? 🥲',
        'Encore non ? 😭',
        'Nooon…',
        'non ?',
        'non...',
        'n...',
        '🤏',
    ];

    const noteMessages = [
        'Un petit doute ? Je peux être très convaincant 😌',
        'Le bouton « Non » commence à perdre confiance…',
        'Il devient quand même de plus en plus petit 👀',
        'À ce rythme-là, il ne va bientôt plus rester grand-chose.',
        'Regarde comme le bouton « Oui » est joli pourtant 💕',
        'C’est de l’acharnement à ce niveau-là 😭',
        'Il résiste, mais pour combien de temps ?',
        'Dernière chance de sauver ce pauvre petit bouton.',
    ];

    app.querySelectorAll('[data-value]').forEach((input) => {
        values[input.dataset.value] = input;

        if (input.value) {
            labels[input.dataset.value] = input.value;
        }
    });

    function updateProgress() {
        const percentage = ((currentStep + 1) / steps.length) * 100;

        progressBar.style.width = `${percentage}%`;
        progressText.textContent = steps[currentStep].dataset.stepName;
        progressCount.textContent =
            `${currentStep + 1} / ${steps.length}`;
    }

    function showStep(index) {
        steps[currentStep].classList.remove('is-active');

        currentStep = Math.max(
            0,
            Math.min(index, steps.length - 1)
        );

        steps[currentStep].classList.add('is-active');

        updateProgress();

        window.scrollTo({
            top: 0,
            behavior: 'smooth',
        });

        if (currentStep === steps.length - 1) {
            updateSummary();
        }
    }

    function setField(field, value, label = value) {
        const hiddenInput = values[field];

        if (!hiddenInput) {
            return;
        }

        hiddenInput.value = value;
        labels[field] = label;
    }

    function formatSelectedDate(value) {
        if (!value) {
            return '';
        }

        const [year, month, day] = value
            .split('-')
            .map(Number);

        const selectedDate = new Date(
            year,
            month - 1,
            day
        );

        const formattedDate = new Intl.DateTimeFormat(
            'fr-FR',
            {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric',
            }
        ).format(selectedDate);

        return formattedDate.charAt(0).toUpperCase()
            + formattedDate.slice(1);
    }

    function updateSelectedDate(value, animate = true) {
        if (
            !value
            || !dateCard
            || !dateTitle
            || !datePreview
        ) {
            return;
        }

        const formattedDate = formatSelectedDate(value);

        setField(
            'selected_date',
            value,
            formattedDate
        );

        dateTitle.textContent = 'Très bon choix 💕';
        datePreview.textContent = formattedDate;

        dateCard.classList.add('has-date');

        if (!animate) {
            return;
        }

        dateCard.classList.remove('is-celebrating');

        /*
         * Relance l’animation même lorsqu’une autre
         * date est choisie juste après.
         */
        void dateCard.offsetWidth;

        dateCard.classList.add('is-celebrating');

        window.setTimeout(() => {
            dateCard.classList.remove('is-celebrating');
        }, 1100);
    }

    function markSelected(button) {
        const field = button.dataset.choice;

        app.querySelectorAll(`[data-choice="${field}"]`)
            .forEach((element) => {
                element.classList.remove('is-selected');
            });

        button.classList.add('is-selected');
    }

    function validateCurrentStep() {
        const requiredField =
            steps[currentStep].dataset.required;

        if (!requiredField) {
            return true;
        }

        if (values[requiredField]?.value) {
            return true;
        }

        const target =
            steps[currentStep].querySelector(
                `[data-choice="${requiredField}"]`
            ) || steps[currentStep];

        target.classList.add('field-error');

        window.setTimeout(() => {
            target.classList.remove('field-error');
        }, 350);

        return false;
    }

    function updateSummary() {
        app.querySelectorAll('[data-summary]')
            .forEach((element) => {
                const field = element.dataset.summary;

                element.textContent =
                    labels[field] ||
                    values[field]?.value ||
                    (
                        field === 'romance_level'
                            ? 'Au feeling'
                            : '—'
                    );
            });

        const preciseLocation = form
            .querySelector('[name="location_name"]')
            ?.value
            .trim();

        if (preciseLocation) {
            app.querySelector(
                '[data-summary="location_type"]'
            ).textContent = preciseLocation;
        }
    }

    function handleNoClick() {
        if (!yesButton || !noButton || !introNote) {
            return;
        }

        noClickCount += 1;

        const messageIndex = Math.min(
            noClickCount - 1,
            yesMessages.length - 1
        );

        yesButton.textContent =
            yesMessages[messageIndex];

        noButton.textContent =
            noMessages[messageIndex];

        introNote.textContent =
            noteMessages[messageIndex];

        /*
         * Le bouton perd 12 % de sa taille à chaque clic.
         * Il conserve une taille minimale pour rester cliquable.
         */
        const newScale = Math.max(
            0.32,
            1 - noClickCount * 0.12
        );

        const newOpacity = Math.max(
            0.55,
            1 - noClickCount * 0.06
        );

        noButton.style.setProperty(
            '--no-button-scale',
            newScale.toString()
        );

        noButton.style.opacity =
            newOpacity.toString();

        noButton.classList.remove('is-shaking');

        /*
         * Force le navigateur à relancer l’animation
         * même lors de plusieurs clics successifs.
         */
        void noButton.offsetWidth;

        noButton.classList.add('is-shaking');

        yesButton.classList.remove('is-pulsing');
        void yesButton.offsetWidth;
        yesButton.classList.add('is-pulsing');

        window.setTimeout(() => {
            noButton.classList.remove('is-shaking');
            yesButton.classList.remove('is-pulsing');
        }, 450);
    }

    app.addEventListener('click', (event) => {
        const nextButton =
            event.target.closest('[data-next]');

        const backButton =
            event.target.closest('[data-back]');

        const choiceButton =
            event.target.closest('[data-choice]');

        const noButtonClicked =
            event.target.closest('[data-no-btn]');

        if (choiceButton) {
            setField(
                choiceButton.dataset.choice,
                choiceButton.dataset.choiceValue,
                choiceButton.dataset.choiceLabel ||
                choiceButton.dataset.choiceValue
            );

            markSelected(choiceButton);
        }

        if (noButtonClicked) {
            handleNoClick();
        }

        if (nextButton && validateCurrentStep()) {
            showStep(currentStep + 1);
        }

        if (backButton) {
            showStep(currentStep - 1);
        }
    });

    app.querySelectorAll('[data-custom-value]')
        .forEach((input) => {
            input.addEventListener('input', () => {
                if (!input.value) {
                    return;
                }

                const field = input.dataset.customValue;

                setField(
                    field,
                    input.value,
                    input.value
                );

                app.querySelectorAll(
                    `[data-choice="${field}"]`
                ).forEach((element) => {
                    element.classList.remove('is-selected');
                });
            });
        });

    if (datePicker) {
        datePicker.addEventListener('change', () => {
            updateSelectedDate(datePicker.value);
        });

        /*
         * Restaure proprement la date après
         * une erreur de validation Laravel.
         */
        if (datePicker.value) {
            updateSelectedDate(
                datePicker.value,
                false
            );
        }
    }

    form.addEventListener('submit', () => {
        launchHearts(18);
    });

    updateProgress();
}
