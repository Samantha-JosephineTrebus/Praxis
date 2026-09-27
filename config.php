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
define('STUDIES_FILE', DATA_DIR . 'studies.json');
define('STUDY_FILES_DIR', DATA_DIR . 'study-files/');

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

function getStudies($includeExpired = false) {
    if (!file_exists(STUDIES_FILE)) {
        return [];
    }

    $studies = json_decode(file_get_contents(STUDIES_FILE), true);
    if (!is_array($studies)) {
        return [];
    }

    if (!$includeExpired) {
        $today = date('Y-m-d');
        $studies = array_filter($studies, function ($study) use ($today) {
            return isset($study['expires']) && $study['expires'] >= $today;
        });
    }

    usort($studies, function ($first, $second) {
        return strcmp($first['expires'] ?? '', $second['expires'] ?? '');
    });

    return array_values($studies);
}

function saveStudies($studies) {
    $json = json_encode($studies, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    return $json !== false && file_put_contents(STUDIES_FILE, $json, LOCK_EX) !== false;
}

function addStudy($study, $uploadedPdf = null) {
    $studies = getStudies(true);
    $study['id'] = bin2hex(random_bytes(12));
    $study['pdf'] = false;

    if ($uploadedPdf !== null) {
        if (!is_dir(STUDY_FILES_DIR) && !mkdir(STUDY_FILES_DIR, 0755, true)) {
            return false;
        }

        if (!move_uploaded_file($uploadedPdf, STUDY_FILES_DIR . $study['id'] . '.pdf')) {
            return false;
        }

        $study['pdf'] = true;
    }

    $studies[] = $study;
    if (!saveStudies($studies)) {
        if ($uploadedPdf !== null) {
            @unlink(STUDY_FILES_DIR . $study['id'] . '.pdf');
        }
        return false;
    }

    return true;
}

function updateStudy($id, $changes, $uploadedPdf = null, $removePdf = false) {
    if (!preg_match('/\A[a-f0-9]{24}\z/', $id)) {
        return false;
    }

    $studies = getStudies(true);
    $studyIndex = null;
    foreach ($studies as $index => $study) {
        if (($study['id'] ?? '') === $id) {
            $studyIndex = $index;
            break;
        }
    }

    if ($studyIndex === null) {
        return false;
    }

    $originalStudies = $studies;
    $originalStudy = $studies[$studyIndex];
    $pdfPath = STUDY_FILES_DIR . $id . '.pdf';
    $stagedPdfPath = null;
    $backupPdfPath = null;

    if ($uploadedPdf !== null) {
        if (!is_dir(STUDY_FILES_DIR) && !mkdir(STUDY_FILES_DIR, 0755, true)) {
            return false;
        }

        $stagedPdfPath = STUDY_FILES_DIR . $id . '.upload-' . bin2hex(random_bytes(8)) . '.tmp';
        if (!move_uploaded_file($uploadedPdf, $stagedPdfPath)) {
            return false;
        }
    }

    $studies[$studyIndex] = array_merge($originalStudy, $changes, [
        'id' => $id,
        'pdf' => $uploadedPdf !== null || (!$removePdf && !empty($originalStudy['pdf']))
    ]);

    if (!saveStudies($studies)) {
        if ($stagedPdfPath !== null) {
            @unlink($stagedPdfPath);
        }
        return false;
    }

    if ($uploadedPdf !== null) {
        if (is_file($pdfPath)) {
            $backupPdfPath = STUDY_FILES_DIR . $id . '.backup-' . bin2hex(random_bytes(8)) . '.tmp';
            if (!rename($pdfPath, $backupPdfPath)) {
                saveStudies($originalStudies);
                @unlink($stagedPdfPath);
                return false;
            }
        }

        if (!rename($stagedPdfPath, $pdfPath)) {
            if ($backupPdfPath !== null) {
                @rename($backupPdfPath, $pdfPath);
            }
            saveStudies($originalStudies);
            @unlink($stagedPdfPath);
            return false;
        }

        if ($backupPdfPath !== null) {
            @unlink($backupPdfPath);
        }
    } elseif ($removePdf && !empty($originalStudy['pdf']) && is_file($pdfPath) && !@unlink($pdfPath)) {
        saveStudies($originalStudies);
        return false;
    }

    return true;
}

function deleteStudy($id) {
    $studies = getStudies(true);
    $studyToDelete = null;
    $remaining = array_values(array_filter($studies, function ($study) use ($id) {
        return ($study['id'] ?? '') !== $id;
    }));

    foreach ($studies as $study) {
        if (($study['id'] ?? '') === $id) {
            $studyToDelete = $study;
            break;
        }
    }

    if ($studyToDelete === null || !saveStudies($remaining)) {
        return false;
    }

    $pdfPath = STUDY_FILES_DIR . $id . '.pdf';
    if (!empty($studyToDelete['pdf']) && is_file($pdfPath) && !@unlink($pdfPath)) {
        saveStudies($studies);
        return false;
    }

    return true;
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
