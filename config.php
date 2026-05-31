<?php
// Konfiguration & Session-Management
session_start();

// Sicherheits-Einstellungen
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', '1234');
define('STAFF_USERNAME', 'mitarbeiter');
define('STAFF_PASSWORD', 'abcd');
define('SECRET_KEY', 'geheimer_schluessel_praxis');

// Datenpfade
define('DATA_DIR', __DIR__ . '/data/');
define('HOURS_FILE', DATA_DIR . 'hours.json');
define('NOTE_FILE', DATA_DIR . 'note.json');
define('DEROUX_FILE', DATA_DIR . 'deroux.json');

// Stelle sicher, dass data Ordner existiert
if (!is_dir(DATA_DIR)) {
    mkdir(DATA_DIR, 0755, true);
}

// Standard Öffnungszeiten (falls Datei nicht existiert)
$DEFAULT_HOURS = [
    'monday_morning' => '08:30–12:30',
    'monday_afternoon' => '14:00–18:00',
    'tuesday_morning' => '08:30–12:30',
    'tuesday_afternoon' => '14:00–18:00',
    'wednesday_morning' => '08:30–12:30',
    'wednesday_afternoon' => '14:00–18:00',
    'thursday_morning' => '08:30–12:30',
    'thursday_afternoon' => '14:00–18:00',
    'friday' => 'nach Vereinbarung'
];

$DEFAULT_NOTE = [
    'title' => 'Aktuelle Information',
    'text' => 'Am <strong>31. Oktober</strong> bleibt unsere Praxis wegen des Feiertags geschlossen.'
];

// Öffnungszeiten laden
function getHours() {
    if (file_exists(HOURS_FILE)) {
        return json_decode(file_get_contents(HOURS_FILE), true);
    }
    return $GLOBALS['DEFAULT_HOURS'];
}

// Öffnungszeiten speichern
function saveHours($hours) {
    return file_put_contents(HOURS_FILE, json_encode($hours, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

// Haftnotiz laden
function getNote() {
    if (file_exists(NOTE_FILE)) {
        return json_decode(file_get_contents(NOTE_FILE), true);
    }
    return $GLOBALS['DEFAULT_NOTE'];
}

// Haftnotiz speichern
function saveNote($note) {
    return file_put_contents(NOTE_FILE, json_encode($note, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

// Prüfe ob Admin eingeloggt ist
function isAdminLoggedIn() {
    return isset($_SESSION['loggedIn']) && $_SESSION['role'] === 'admin';
}

// Prüfe ob jemand eingeloggt ist
function isLoggedIn() {
    return isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true;
}

// Standardtext für Dr. de Roux (falls Datei nicht existiert)
$DEFAULT_DEROUX = [
    'text' => 'Spezialist für Pneumologie und Schlafmedizin, mit langjähriger Erfahrung.'
];

// Text für Dr. de Roux laden
function getDerouxText() {
    if (file_exists(DEROUX_FILE)) {
        return json_decode(file_get_contents(DEROUX_FILE), true);
    }
    return $GLOBALS['DEFAULT_DEROUX'];
}

// Text für Dr. de Roux speichern
function saveDerouxText($data) {
    return file_put_contents(DEROUX_FILE, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}
// Allgemeine Funktion zum Laden beliebiger JSON-Dateien
function getJSONData($fileKey) {
    // Definiere hier, wo die Dateien liegen
    $files = [
        'hours' => HOURS_FILE,
        'note' => NOTE_FILE,
        'deroux_content' => DEROUX_FILE
    ];

    if (isset($files[$fileKey]) && file_exists($files[$fileKey])) {
        return json_decode(file_get_contents($files[$fileKey]), true);
    }
    return []; // Gibt ein leeres Array zurück, wenn nichts gefunden wurde
}

// Allgemeine Funktion zum Speichern beliebiger JSON-Dateien
function saveJSONData($fileKey, $data) {
    $files = [
        'hours' => HOURS_FILE,
        'note' => NOTE_FILE,
        'deroux_content' => DEROUX_FILE
    ];

    if (isset($files[$fileKey])) {
        return file_put_contents($files[$fileKey], json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
    return false;
}
function logout() {
    // Da session_start() in der config.php bereits gelaufen ist, 
    // müssen wir es hier NICHT erneut aufrufen.
    
    $_SESSION = array(); // Session-Variablen löschen
    
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    session_destroy(); // Session zerstören
    
    // Weiterleitung
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/index.php");
exit();
}
?>
