# Invitation de date — Laravel

Mini-application Laravel avec :

- lien privé par token ;
- parcours mobile en plusieurs étapes ;
- choix de l'activité, de la date, de l'heure et du lieu ;
- questions amusantes ;
- sauvegarde MySQL ;
- page finale de confirmation.

## 1. Créer le projet

```bash
composer create-project laravel/laravel date-invitation
cd date-invitation
```

Configure ensuite la base de données dans `.env`.

## 2. Copier les fichiers

Copie les dossiers de ce pack dans ton projet Laravel en conservant la même arborescence.

Attention : `routes/web.php` remplace le fichier de routes actuel. Fusionne son contenu si ton projet contient déjà d'autres routes.

## 3. Ajouter les entrées Vite

Dans `vite.config.js`, ajoute :

```js
'resources/css/invitation.css',
'resources/js/invitation.js',
```

Le fichier `vite.config.example.js` montre la configuration complète.

## 4. Activer le seeder

Dans `database/seeders/DatabaseSeeder.php` :

```php
public function run(): void
{
    $this->call(InvitationSeeder::class);
}
```

## 5. Lancer la base

```bash
php artisan migrate --seed
```

## 6. Installer et lancer le front

```bash
npm install
npm run dev
```

Dans un deuxième terminal :

```bash
php artisan serve
```

Ouvre ensuite :

```text
http://127.0.0.1:8000/invitation/pour-toi
```

## 7. Personnaliser

Modifie `database/seeders/InvitationSeeder.php`, puis réinitialise les données de développement :

```bash
php artisan migrate:fresh --seed
```

Tu peux modifier :

- `recipient_name` ;
- `sender_name` ;
- le titre et le message ;
- les dates proposées ;
- les horaires ;
- les types de lieux ;
- la date d'expiration.

## Étape suivante recommandée

Ajouter une page admin protégée et un e-mail envoyé au propriétaire de l'invitation dès que la réponse est confirmée.
