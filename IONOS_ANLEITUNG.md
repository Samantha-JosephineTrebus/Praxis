# IONOS Deployment Anleitung

## Vorbereitung

Diese Website wurde zu **PHP** umgebaut und ist nun kompatibel mit IONOS Hosting.

### Anforderungen:
- PHP 7.4 oder höher (IONOS unterstützt dies)
- FTP oder SFTP Zugang zu deinem IONOS Account
- Schreibberechtigung für `/data` Ordner

---

## Schritt 1: Dateien hochladen

1. Verbinde dich per **SFTP** mit deinem IONOS Hosting; unverschlüsseltes FTP nicht verwenden.
2. Lade alle Dateien in den **Root-Verzeichnis** (oder `/public_html`) hoch:
   - `config.php` und die selbst angelegte `auth.local.php`
   - `index.php`
   - `login.php`
   - `admin.php`
   - `logout.php`
   - `mitarbeiter.php`
   - `.htaccess` (beim FTP-Programm gegebenenfalls Anzeige versteckter Dateien aktivieren)
   - `public/` (alle HTML, CSS, JS, Bilder)
   - `data/` (Ordner mit `hours.json` und `note.json`)

## HTTPS-Zertifikat aktivieren

1. Im IONOS-Konto unter **Domains & SSL** ein SSL/TLS-Zertifikat der Domain zuweisen und aktivieren.
2. Erst wenn das Zertifikat als aktiv angezeigt wird, die HTTPS-Umleitung für die Domain einschalten.
3. `https://deine-domain.de` öffnen und sicherstellen, dass der Browser keine Zertifikatswarnung zeigt und HTTP auf HTTPS umleitet.
4. Die Login-Seite über `https://` öffnen und den Login testen. Falls der Login trotz gültigem Zertifikat HTTPS nicht erkennt, nicht auf HTTP ausweichen, sondern die IONOS-PHP/HTTPS-Konfiguration prüfen.

Auf einer öffentlichen Domain verarbeitet die Anmeldung Passwörter ausschließlich über HTTPS. Ohne aktives Zertifikat ist dort kein Login möglich. HTTP-Login ist nur für `localhost` bei lokaler Entwicklung freigeschaltet. HTTPS verschlüsselt die Verbindung, ersetzt aber nicht die übrigen Sicherheitsmaßnahmen.

## Schritt 2: Berechtigungen setzen

Der `/data` Ordner muss für den PHP-Prozess beschreibbar sein. Verwende die engsten Berechtigungen, die IONOS benötigt; setze niemals `777`:

**Via FTP:**
1. Rechtsklick auf `/data` Ordner → Berechtigungen
2. Setze Berechtigungen auf: **755** (oder **775**)

**Via Terminal (SSH):**
```bash
chmod 755 data/
```

## Schritt 3: Testen

1. Öffne deine Website in Browser: `https://deine-domain.de`
2. Du solltest die Startseite sehen
3. Klick auf "🔐 Anmelden"
4. Mit den in `auth.local.php` eingerichteten Admin-Zugangsdaten anmelden
5. Du solltest zum Admin-Panel weitergeleitet werden

## Schritt 4: Öffnungszeiten bearbeiten

1. Im Admin-Panel → "Öffnungszeiten verwalten"
2. Ändere die Zeiten nach Bedarf
3. Klick "Öffnungszeiten speichern"
4. Die Änderungen werden sofort auf der Startseite angezeigt!

---

---

## Wichtige Informationen

### Sessions & Cookies
- Die Website benutzt PHP Sessions für Login
- Sessions werden auf dem Server gespeichert (nicht auf dem Client)
- IONOS unterstützt dies vollständig

### Datensicherung
- Die Öffnungszeiten werden in `/data/hours.json` gespeichert
- Die Haftnotiz wird in `/data/note.json` gespeichert
- Regelmäßig Backups dieser Dateien machen!

### Performance
- Keine Datenbank nötig (JSON-Datei statt DB)
- Sehr schnelle Performance
- Keine Datenbankkosten

---

## Fehlersuche

### Problem: "Datei konnte nicht gespeichert werden"
- Stelle sicher, dass `/data` Schreibberechtigung hat (chmod 755)

### Problem: Login funktioniert nicht
- Stelle sicher, dass PHP aktiviert ist (IONOS tut dies standardmäßig)
- Überprüfe die `config.php` ist nicht beschädigt

### Problem: Öffnungszeiten werden nicht angezeigt
- Überprüfe ob `/data/hours.json` existiert
- Überprüfe die Berechtigungen des `/data` Ordners

---

## Weitere Anpassungen

### Zugangsdaten einrichten oder ändern

1. Kopiere `auth.local.php.example` lokal nach `auth.local.php`.
2. Erzeuge für jedes Konto einen eigenen Passwort-Hash mit PHP CLI. Der Befehl fragt das Passwort ein, statt es in der Kommandozeile zu speichern:

```php
php -r "echo password_hash(readline('Passwort: '), PASSWORD_DEFAULT), PHP_EOL;"
```

3. Trage Benutzernamen und die erzeugten Hashes in `auth.local.php` ein:

```php
<?php
return [
   'admin_username' => 'EIGENER_ADMIN_NAME',
   'admin_password_hash' => 'ADMIN_HASH_HIER_EINFUEGEN',
   'staff_username' => 'EIGENER_MITARBEITER_NAME',
   'staff_password_hash' => 'MITARBEITER_HASH_HIER_EINFUEGEN'
];
```

Verwende lange, einzigartige Passwörter. Die Datei `auth.local.php` wird von Git ignoriert und durch `.htaccess` gegen direkten Abruf gesperrt. Lade sie per SFTP auf IONOS hoch und sichere sie getrennt. Ohne diese Datei bleibt der Login auf öffentlichen Domains deaktiviert; der lokale Entwicklungszugang funktioniert nur über eine echte Loopback-Verbindung.

### Weitere Seiten zu PHP konvertieren
Alle `*.html` Dateien können optional auch zu `.php` konvertiert werden für mehr Flexibilität.

---

## Support

Bei Fragen zur Deployment auf IONOS kontaktiere den IONOS Support oder einen lokalen Webentwickler.
