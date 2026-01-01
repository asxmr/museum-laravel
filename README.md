# 📸 Museum – Laravel

## 📖 Projectomschrijving

Dit project is een **data-gedreven webapplicatie** ontwikkeld met **Laravel**, gerealiseerd in het kader van **Project 1 – Laravel** binnen de opleiding **Toegepaste Informatica** aan de **Erasmushogeschool Brussel**.

De applicatie stelt een **museum / fotogalerij** voor waar bezoekers foto’s kunnen bekijken, nieuws lezen, veelgestelde vragen raadplegen en contact opnemen.

Geregistreerde gebruikers beschikken over een profiel en kunnen actief interageren met de inhoud.
Admins beheren de volledige website via een beveiligd adminpaneel.

Screenshots van de applicatie zijn beschikbaar in de map `/screenshots`.

---

## 📸 Screenshots

Screenshots van de applicatie (publieke pagina’s, ingelogde gebruikers en het adminpaneel)
zijn terug te vinden in de map:

```
/screenshots
```

De map bevat screenshots van:

* publieke pagina’s (zonder login)
* pagina’s voor ingelogde gebruikers
* het beveiligde adminpaneel

---

## 🚀 Functionaliteiten

### 🔐 Authenticatie & accounts

* Registreren, inloggen en uitloggen
* “Remember me” functionaliteit
* Wachtwoord reset
* Twee rollen:

  * **Gebruiker**
  * **Admin**
* Enkel admins kunnen:

  * andere gebruikers adminrechten toekennen of afnemen
  * gebruikers manueel aanmaken

---

### 👤 Profielen

* Elke gebruiker heeft een **publieke profielpagina**
* Profielen zijn zichtbaar voor **alle bezoekers**, ook zonder login
* Ingelogde gebruikers kunnen hun **eigen profielgegevens aanpassen**
* Een profiel bevat:

  * gebruikersnaam
  * verjaardag
  * profielfoto (opgeslagen op de server)
  * “Over mij”-tekst

---

### 🖼️ Fotogalerij (extra feature)

* Overzicht van alle foto’s
* Detailpagina per foto
* Foto’s zijn gekoppeld aan **categorieën**
* Ingelogde gebruikers kunnen:

  * foto’s **opslaan in hun favorieten**
  * **reacties plaatsen** bij foto’s
* Favorieten en reacties worden per gebruiker opgeslagen in de database

---

### 📰 Nieuws

* Admin kan nieuwsitems:

  * toevoegen
  * wijzigen
  * verwijderen
* Bezoekers kunnen:

  * een overzicht van alle nieuwsitems bekijken
  * een detailpagina per nieuwsitem openen
* Elk nieuwsitem bevat:

  * titel
  * afbeelding (opgeslagen op de server)
  * inhoud
  * publicatiedatum

---

### ❓ FAQ

* FAQ-pagina met:

  * categorieën
  * vragen en antwoorden
* Admin kan:

  * categorieën beheren
  * FAQ-items toevoegen, aanpassen en verwijderen
* De FAQ is publiek zichtbaar voor alle bezoekers

---

### ✉️ Contact

* Publiek contactformulier
* Ingezonden berichten:

  * worden opgeslagen in de database
  * **worden automatisch per e-mail doorgestuurd naar een admin**

In deze projectconfiguratie staat `MAIL_MAILER=log`, waardoor e-mails worden gelogd (voor testdoeleinden) in plaats van effectief verzonden.
De e-mails worden gericht aan `ADMIN_EMAIL=admin@ehb.be`, zoals vereist in de opdracht.

---

### 🛠️ Adminpaneel

* Afzonderlijke admin layout
* Beveiligd via middleware
* Adminfunctionaliteiten:

  * gebruikersbeheer
  * beheer van foto’s
  * beheer van nieuws
  * beheer van FAQ
  * bekijken van contactberichten

---

## 🧱 Technische vereisten

* Laravel (nieuwste versie bij start van het project)
* MVC-architectuur
* Controllers per functionaliteit
* Eloquent models per entiteit
* Database-relaties:

  * one-to-many
  * many-to-many
* CSRF-bescherming
* XSS-bescherming
* Client-side validatie
* Routes via controllers en middleware
* Meerdere layouts:

  * publieke layout
  * admin layout
* Git-versiebeheer met duidelijke commitgeschiedenis
* `vendor` en `node_modules` uitgesloten via `.gitignore`

---

## 🗄️ Database

De applicatie is volledig seedbaar via:

```bash
php artisan migrate:fresh --seed
```

### Default admin account

**Admin account (verplicht volgens opdracht):**

* **Username:** admin
* **Email:** [admin@ehb.be](mailto:admin@ehb.be)
* **Password:** Password!321

### User account

**Extra user account (testdoeleinden):**

* **Username:** Rania
* **Email:** [rania@test.be](mailto:rania@test.be)
* **Password:** Password!321

---

## ⚙️ Installatie-instructies

Volg onderstaande stappen om het project lokaal op te starten:

```bash
git clone https://github.com/asxmr/museum-laravel.git
cd museum-laravel

composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate:fresh --seed
npm run dev
php artisan serve
```

### 🌐 Applicatie openen

* Bij gebruik van Laravel Herd:
  `http://museum-laravel.test`
* Bij gebruik van `php artisan serve`:
  `http://127.0.0.1:8000`

⚠️ Vergeet niet om je eigen databasegegevens in het `.env`-bestand in te stellen.

---

## 📚 Bronnen

* Laravel. (2024). *Laravel documentation*. [https://laravel.com/docs](https://laravel.com/docs)
* Laravel. (2024). *Starter kits – Breeze*. [https://laravel.com/docs/starter-kits](https://laravel.com/docs/starter-kits)
* Laravel. (2024). *Eloquent ORM*. [https://laravel.com/docs/eloquent](https://laravel.com/docs/eloquent)
* Laravel. (2024). *Eloquent relationships*. [https://laravel.com/docs/eloquent-relationships](https://laravel.com/docs/eloquent-relationships)
* Laravel. (2024). *Blade templates*. [https://laravel.com/docs/blade](https://laravel.com/docs/blade)
* Laravel. (2024). *Validation*. [https://laravel.com/docs/validation](https://laravel.com/docs/validation)
* Laravel. (2024). *Filesystem / File storage*. [https://laravel.com/docs/filesystem](https://laravel.com/docs/filesystem)
* Laravel. (2024). *Middleware*. [https://laravel.com/docs/middleware](https://laravel.com/docs/middleware)
* PHP Group. (2024). *PHP documentation*. [https://www.php.net/docs.php](https://www.php.net/docs.php)
* Mozilla Developer Network. (2024). *MDN Web Docs*. [https://developer.mozilla.org](https://developer.mozilla.org)
* Erasmushogeschool Brussel. (2024). *Cursusmateriaal Backend Web*.

---

## 🎥 Screencast

HIER VOEG IK STRAKS HET LINK

---

## 👩‍💻 Auteur

**Rania Azaoum**

---

## 🎓 Opleiding

Student **2de jaar Toegepaste Informatica**
**Erasmushogeschool Brussel (EhB)**
