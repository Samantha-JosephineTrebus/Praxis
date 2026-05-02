# IONOS Deployment Anleitung

## Vorbereitung

Diese Website wurde zu **PHP** umgebaut und ist nun kompatibel mit IONOS Hosting.

### Anforderungen:
- PHP 7.4 oder höher (IONOS unterstützt dies)
- FTP oder SFTP Zugang zu deinem IONOS Account
- Schreibberechtigung für `/data` Ordner

---

## Schritt 1: Dateien hochladen

1. Verbinde dich per **FTP** oder **SFTP** mit deinem IONOS Hosting
2. Lade alle Dateien in den **Root-Verzeichnis** (oder `/public_html`) hoch:
   - `config.php`
   - `index.php`
   - `login.php`
   - `admin.php`
   - `logout.php`
   - `mitarbeiter.php`
   - `.htaccess`
   - `public/` (alle HTML, CSS, JS, Bilder)
   - `data/` (Ordner mit `hours.json` und `note.json`)

## Schritt 2: Berechtigungen setzen

Der `/data` Ordner muss **Schreibberechtigung** haben:

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
4. Login als **Admin**:
   - Benutzername: `admin`
   - Passwort: `1234`
5. Du solltest zum Admin-Panel weitergeleitet werden

## Schritt 4: Öffnungszeiten bearbeiten

1. Im Admin-Panel → "Öffnungszeiten verwalten"
2. Ändere die Zeiten nach Bedarf
3. Klick "Öffnungszeiten speichern"
4. Die Änderungen werden sofort auf der Startseite angezeigt!

---

## Login-Daten

**Admin:**
- Benutzername: `admin`
- Passwort: `1234`

**Mitarbeiter:**
- Benutzername: `mitarbeiter`
- Passwort: `abcd`

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

### Passwort ändern
Bearbeite `config.php`:
```php
define('ADMIN_PASSWORD', 'dein-neues-passwort');
define('STAFF_PASSWORD', 'mitarbeiter-passwort');
```

### Weitere Seiten zu PHP konvertieren
Alle `*.html` Dateien können optional auch zu `.php` konvertiert werden für mehr Flexibilität.

---

## Support

Bei Fragen zur Deployment auf IONOS kontaktiere den IONOS Support oder einen lokalen Webentwickler.
