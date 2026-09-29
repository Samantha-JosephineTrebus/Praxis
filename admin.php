<?php
require_once 'config.php';

if (!isAdminLoggedIn()) {
  header('Location: login.php');
  exit;
}

function getStudyPdfUpload(&$uploadError) {
  $uploadError = '';
  $pdfUpload = $_FILES['study_pdf'] ?? null;
  if (!$pdfUpload || $pdfUpload['error'] === UPLOAD_ERR_NO_FILE) {
    return null;
  }

  if ($pdfUpload['error'] !== UPLOAD_ERR_OK) {
    $uploadError = 'Der PDF-Upload ist fehlgeschlagen.';
  } elseif ($pdfUpload['size'] > 2 * 1024 * 1024) {
    $uploadError = 'Die PDF-Datei darf höchstens 2 MB groß sein.';
  } elseif (!is_uploaded_file($pdfUpload['tmp_name'])) {
    $uploadError = 'Die hochgeladene Datei konnte nicht geprüft werden.';
  } else {
    $signature = file_get_contents($pdfUpload['tmp_name'], false, null, 0, 5);
    $validPdf = $signature === '%PDF-';
    if ($validPdf && class_exists('finfo')) {
      $fileInfo = new finfo(FILEINFO_MIME_TYPE);
      $validPdf = $fileInfo->file($pdfUpload['tmp_name']) === 'application/pdf';
    }

    if (!$validPdf) {
      $uploadError = 'Bitte laden Sie eine gültige PDF-Datei hoch.';
    } else {
      return $pdfUpload['tmp_name'];
    }
  }

  return null;
}

function isValidStudyDate($date, $mustBeCurrent = false) {
  $parsedDate = DateTimeImmutable::createFromFormat('!Y-m-d', $date);
  $dateErrors = DateTimeImmutable::getLastErrors();
  return $parsedDate !== false
    && $parsedDate->format('Y-m-d') === $date
    && ($dateErrors === false || ($dateErrors['warning_count'] === 0 && $dateErrors['error_count'] === 0))
    && (!$mustBeCurrent || $date >= date('Y-m-d'));
}

// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? '';
  if ($action === 'save_hours') {
    $hours_input = [
      'monday_morning' => $_POST['monday_morning'] ?? '',
      'monday_afternoon' => $_POST['monday_afternoon'] ?? '',
      'tuesday_morning' => $_POST['tuesday_morning'] ?? '',
      'tuesday_afternoon' => $_POST['tuesday_afternoon'] ?? '',
      'wednesday_morning' => $_POST['wednesday_morning'] ?? '',
      'wednesday_afternoon' => $_POST['wednesday_afternoon'] ?? '',
      'thursday_morning' => $_POST['thursday_morning'] ?? '',
      'thursday_afternoon' => $_POST['thursday_afternoon'] ?? '',
      'friday' => $_POST['friday'] ?? ''
    ];
    if (function_exists('saveHours') && saveHours($hours_input)) {
      $success_hours = 'Öffnungszeiten erfolgreich gespeichert!';
    } else {
      $error_hours = 'Fehler beim Speichern!';
    }
  } elseif ($action === 'save_note') {
    $note_input = [
      'title' => $_POST['note_title'] ?? '',
      'text' => $_POST['note_text'] ?? ''
    ];
    if (function_exists('saveNote') && saveNote($note_input)) {
      $success_note = 'Haftnotiz erfolgreich gespeichert!';
    } else {
      $error_note = 'Fehler beim Speichern!';
    }
  } elseif ($action === 'save_deroux_text') {
    $newData = $_POST['deroux_text'] ?? '';
    if (function_exists('saveJSONData') && saveJSONData('deroux_content', ['text' => $newData])) {
      $success_deroux = 'Text erfolgreich gespeichert!';
    } else {
      $error_deroux = 'Fehler beim Speichern!';
    }
  } elseif ($action === 'save_weiss_text') {
    $newData = $_POST['weiss_text'] ?? '';
    if (function_exists('saveJSONData') && saveJSONData('weiss_content', ['text' => $newData])) {
      $success_weiss = 'Text erfolgreich gespeichert!';
    } else {
      $error_weiss = 'Fehler beim Speichern!';
    }
  }
}

// Load data for forms
$hours = function_exists('getHours') ? getHours() : [];
$note = function_exists('getNote') ? getNote() : ['title' => '', 'text' => ''];
$deroux_data = function_exists('getJSONData') ? getJSONData('deroux_content') : [];
$weiss_data = function_exists('getJSONData') ? getJSONData('weiss_content') : [];
$current_deroux_text = $deroux_data['text'] ?? '';
$current_weiss_text = $weiss_data['text'] ?? '';

// Current script name for nav highlighting
$current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin – Praxis</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="stylesheet" href="public/adminHomeStyle.css">
</head>
<body>

<header>
  <a href="/" class="logo praxis-logo">
    <span class="praxis-logo__title">Pneumologische Praxis</span>
    <span class="praxis-logo__subtitle">am Schloss Charlottenburg</span>
  </a>
  <button id="menu-toggle" class="menu-toggle" aria-label="Menü öffnen" aria-controls="nav-list" aria-expanded="false">☰</button>
  <nav>
    <ul id="nav-list">
      <li><a href="index.php">Startseite</a></li>
      <li><a href="#oeffnungszeiten">Öffnungszeiten</a></li>
      <li><a href="#info-anpassen">Aktuelle Informationen</a></li>
      <li><a href="#deroux-anpassen">Dr. de Roux</a></li>
      <li><a href="#weiss-anpassen">Timo Weiß</a></li>
      <li><a href="logout.php" style="color: #ff6b6b;">Logout</a></li>
    </ul>
  </nav>
</header>

<main>
<div id="user-info">
  Eingeloggt als: <strong>Admin</strong>
</div>

  <!-- ÖFFNUNGSZEITEN SECTION -->
  <article id="oeffnungszeiten">
    <h2>Öffnungszeiten verwalten</h2>
    <p>Passen Sie hier die Öffnungszeiten der Praxis an.</p>
    
    <form class="admin-form" method="POST" action="admin.php">
      <input type="hidden" name="action" value="save_hours">
      
      <h3>Montag</h3>
      <label>Morgens:</label>
      <input type="text" name="monday_morning" value="<?php echo htmlspecialchars($hours['monday_morning']); ?>" placeholder="z.B. 08:30–12:30">
      
      <label>Nachmittags:</label>
      <input type="text" name="monday_afternoon" value="<?php echo htmlspecialchars($hours['monday_afternoon']); ?>" placeholder="z.B. 14:00–18:00">
      
      <h3>Dienstag</h3>
      <label>Morgens:</label>
      <input type="text" name="tuesday_morning" value="<?php echo htmlspecialchars($hours['tuesday_morning']); ?>" placeholder="z.B. 08:30–12:30">
      
      <label>Nachmittags:</label>
      <input type="text" name="tuesday_afternoon" value="<?php echo htmlspecialchars($hours['tuesday_afternoon']); ?>" placeholder="z.B. 14:00–18:00">
      
      <h3>Mittwoch</h3>
      <label>Morgens:</label>
      <input type="text" name="wednesday_morning" value="<?php echo htmlspecialchars($hours['wednesday_morning']); ?>" placeholder="z.B. 08:30–12:30">
      
      <label>Nachmittags:</label>
      <input type="text" name="wednesday_afternoon" value="<?php echo htmlspecialchars($hours['wednesday_afternoon']); ?>" placeholder="z.B. 14:00–18:00">
      
      <h3>Donnerstag</h3>
      <label>Morgens:</label>
      <input type="text" name="thursday_morning" value="<?php echo htmlspecialchars($hours['thursday_morning']); ?>" placeholder="z.B. 08:30–12:30">
      
      <label>Nachmittags:</label>
      <input type="text" name="thursday_afternoon" value="<?php echo htmlspecialchars($hours['thursday_afternoon']); ?>" placeholder="z.B. 14:00–18:00">
      
      <h3>Freitag</h3>
      <label>Status:</label>
      <input type="text" name="friday" value="<?php echo htmlspecialchars($hours['friday']); ?>" placeholder="z.B. nach Vereinbarung">
      
      <button type="submit">Öffnungszeiten speichern</button>
      
      <?php if (isset($success_hours)): ?>
        <p style="color: #4caf50; font-weight: bold; margin-top: 1rem;">✓ <?php echo $success_hours; ?></p>
      <?php elseif (isset($error_hours)): ?>
        <p style="color: #d32f2f; font-weight: bold; margin-top: 1rem;">✗ <?php echo $error_hours; ?></p>
      <?php endif; ?>
    </form>
  </article>

  <!-- HAFTNOTIZ SECTION -->
  <article id="info-anpassen">
    <h2>Aktuelle Information (Haftnotiz)</h2>
    <p>Bearbeiten Sie hier die Haftnotiz auf der Startseite.</p>
    
    <form class="admin-form" method="POST" action="admin.php">
      <input type="hidden" name="action" value="save_note">
      
      <label>Titel:</label>
      <input type="text" name="note_title" value="<?php echo htmlspecialchars($note['title']); ?>" placeholder="Titel der Haftnotiz" required>
      
      <label>Text:</label>
      <textarea name="note_text" rows="4" placeholder="Inhalt der Haftnotiz (HTML-Tags erlaubt)" required><?php echo htmlspecialchars($note['text']); ?></textarea>
      
    
<div style="font-size: 0.85rem; color: #666; line-height: 1.7; margin-top: 12px; padding: 14px; background: #f5f8fc; border-left: 3px solid #0875c9; border-radius: 5px;">
    <strong style="color: #07558c; font-size: 0.95rem;">Formatierungshilfe</strong>
    <p style="margin: 5px 0 10px;">
        Mit den folgenden Tags können Sie Ihren Text formatieren:
    </p>
    <ul style="margin: 0; padding-left: 20px;">
        <li style="margin-bottom: 5px;">
            <code>&lt;strong&gt;Text&lt;/strong&gt;</code>
            – <strong>Fettgedruckt</strong>
        </li>
        <li style="margin-bottom: 5px;">
            <code>&lt;em&gt;Text&lt;/em&gt;</code>
            – <em>Kursiv</em>
        </li>
        <li style="margin-bottom: 5px;">
            <code>&lt;u&gt;Text&lt;/u&gt;</code>
            – <u>Unterstrichen</u>
        </li>
        <li style="margin-bottom: 5px;">
            <code>&lt;br&gt;</code>
            – Neue Zeile beginnen
        </li>
        <li style="margin-bottom: 5px;">
            <code>&lt;p&gt;Text&lt;/p&gt;</code>
            – Neuen Absatz erstellen
        </li>
        <li style="margin-bottom: 5px;">
            <code>&lt;ul&gt;&lt;li&gt;Text&lt;/li&gt;&lt;/ul&gt;</code>
            – Aufzählung mit Stichpunkten
        </li>
        <li style="margin-bottom: 5px;">
            <code>&lt;ol&gt;&lt;li&gt;Text&lt;/li&gt;&lt;/ol&gt;</code>
            – Nummerierte Liste
        </li>
        <li style="margin-bottom: 5px;">
            <code>&lt;a href="URL"&gt;Text&lt;/a&gt;</code>
            – Verlinkung einfügen
        </li>
    </ul>
</div>
      
      <button type="submit">Haftnotiz speichern</button>
      
      <?php if (isset($success_note)): ?>
        <p style="color: #4caf50; font-weight: bold; margin-top: 1rem;">✓ <?php echo $success_note; ?></p>
      <?php elseif (isset($error_note)): ?>
        <p style="color: #d32f2f; font-weight: bold; margin-top: 1rem;">✗ <?php echo $error_note; ?></p>
      <?php endif; ?>
    </form>
  </article>

<article id="deroux-anpassen">
    <h2>Dr. de Roux Profiltext</h2>
    <p>Bearbeiten Sie hier den Text für das Profil von Dr. de Roux.</p>
    
    <form class="admin-form" method="POST" action="admin.php#deroux-anpassen">
      <input type="hidden" name="action" value="save_deroux_text">
      
      <label>Profiltext:</label>
      <textarea name="deroux_text" rows="8" required><?php echo htmlspecialchars($current_deroux_text); ?></textarea>
      
      <button type="submit">Profiltext speichern</button>
      
      <?php if (isset($success_deroux)): ?>
        <p style="color: #4caf50; font-weight: bold; margin-top: 1rem;">✓ <?php echo $success_deroux; ?></p>
      <?php elseif (isset($error_deroux)): ?>
        <p style="color: #d32f2f; font-weight: bold; margin-top: 1rem;">✗ <?php echo $error_deroux; ?></p>
      <?php endif; ?>
    </form>
  </article>

  <article id="weiss-anpassen">
    <h2>Timo Weiß Profiltext</h2>
    <p>Bearbeiten Sie hier den Text für das Profil von Timo Weiß.</p>

    <form class="admin-form" method="POST" action="admin.php#weiss-anpassen">
      <input type="hidden" name="action" value="save_weiss_text">

      <label>Profiltext:</label>
      <textarea name="weiss_text" rows="8" required><?php echo htmlspecialchars($current_weiss_text); ?></textarea>

      <button type="submit">Profiltext speichern</button>

      <?php if (isset($success_weiss)): ?>
        <p style="color: #4caf50; font-weight: bold; margin-top: 1rem;">✓ <?php echo $success_weiss; ?></p>
      <?php elseif (isset($error_weiss)): ?>
        <p style="color: #d32f2f; font-weight: bold; margin-top: 1rem;">✗ <?php echo $error_weiss; ?></p>
      <?php endif; ?>
    </form>
  </article>
</body>
</html>
