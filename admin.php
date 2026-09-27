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
  } elseif ($action === 'add_study') {
    $study = [
      'title' => trim($_POST['study_title'] ?? ''),
      'criteria' => trim($_POST['study_criteria'] ?? ''),
      'compensation' => trim($_POST['study_compensation'] ?? ''),
      'procedures' => trim($_POST['study_procedures'] ?? ''),
      'expires' => trim($_POST['study_expires'] ?? '')
    ];
    $uploadedPdf = getStudyPdfUpload($uploadError);

    if (in_array('', $study, true)) {
      $error_studies = 'Bitte füllen Sie alle Studienangaben aus.';
    } elseif ($uploadError !== '') {
      $error_studies = $uploadError;
    } elseif (!isValidStudyDate($study['expires'], true)) {
      $error_studies = 'Bitte geben Sie ein gültiges Ablaufdatum ab heute an.';
    } elseif (addStudy($study, $uploadedPdf)) {
      $success_studies = 'Studie erfolgreich hinzugefügt.';
    } else {
      $error_studies = 'Die Studie konnte nicht gespeichert werden.';
    }
  } elseif ($action === 'edit_study') {
    $editingStudyId = trim($_POST['study_id'] ?? '');
    $study = [
      'title' => trim($_POST['study_title'] ?? ''),
      'criteria' => trim($_POST['study_criteria'] ?? ''),
      'compensation' => trim($_POST['study_compensation'] ?? ''),
      'procedures' => trim($_POST['study_procedures'] ?? ''),
      'expires' => trim($_POST['study_expires'] ?? '')
    ];
    $uploadedPdf = getStudyPdfUpload($uploadError);
    $removePdf = isset($_POST['remove_study_pdf']) && $_POST['remove_study_pdf'] === '1';

    if (!preg_match('/\A[a-f0-9]{24}\z/', $editingStudyId)) {
      $error_studies = 'Die ausgewählte Studie ist ungültig.';
    } elseif (in_array('', $study, true)) {
      $error_studies = 'Bitte füllen Sie alle Studienangaben aus.';
    } elseif ($uploadError !== '') {
      $error_studies = $uploadError;
    } elseif (!isValidStudyDate($study['expires'])) {
      $error_studies = 'Bitte geben Sie ein gültiges Ablaufdatum an.';
    } elseif (updateStudy($editingStudyId, $study, $uploadedPdf, $removePdf)) {
      $success_studies = 'Studie erfolgreich aktualisiert.';
      $editingStudyId = '';
    } else {
      $error_studies = 'Die Studie konnte nicht gespeichert werden.';
    }
  } elseif ($action === 'delete_study') {
    if (deleteStudy($_POST['study_id'] ?? '')) {
      $success_studies = 'Studie gelöscht.';
    } else {
      $error_studies = 'Die Studie konnte nicht gelöscht werden.';
    }
  }
}

// Load data for forms
$hours = function_exists('getHours') ? getHours() : [];
$note = function_exists('getNote') ? getNote() : ['title' => '', 'text' => ''];
$deroux_data = function_exists('getJSONData') ? getJSONData('deroux_content') : [];
$current_deroux_text = $deroux_data['text'] ?? '';
$studies = getStudies(true);

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
  <a href="login.php" class="login-trigger-area" title="Login"></a>
  <a href="/" class="logo praxis-logo">
    <span class="praxis-logo__title">Pneumologische Praxis</span>
    <span class="praxis-logo__subtitle">am Schloss Charlottenburg</span>
  </a>
  <button id="menu-toggle" class="menu-toggle" aria-label="Menü öffnen">☰</button>
  <nav>
    <ul id="nav-list">
      <li><a href="index.php">Startseite</a></li>
      <li><a href="#oeffnungszeiten">Öffnungszeiten</a></li>
      <li><a href="#info-anpassen">Aktuelle Informationen</a></li>
      <li><a href="#studien-anpassen">Aktuelle Studien</a></li>
      <li><a href="#deroux-anpassen">Dr. de Roux</a></li>
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
      
      <p style="font-size: 0.9rem; color: #666;">Tipp: Sie können HTML-Tags wie &lt;strong&gt;, &lt;em&gt;, &lt;u&gt; verwenden.</p>
      
      <button type="submit">Haftnotiz speichern</button>
      
      <?php if (isset($success_note)): ?>
        <p style="color: #4caf50; font-weight: bold; margin-top: 1rem;">✓ <?php echo $success_note; ?></p>
      <?php elseif (isset($error_note)): ?>
        <p style="color: #d32f2f; font-weight: bold; margin-top: 1rem;">✗ <?php echo $error_note; ?></p>
      <?php endif; ?>
    </form>
  </article>
  <article id="studien-anpassen">
    <h2>Aktuelle Studien verwalten</h2>
    <p>Fügen Sie Studien hinzu. Abgelaufene Studien werden automatisch nicht mehr auf der Startseite angezeigt.</p>

    <form class="admin-form" method="POST" action="admin.php#studien-anpassen" enctype="multipart/form-data">
      <input type="hidden" name="action" value="add_study">

      <label for="study-title">Name der Studie</label>
      <input id="study-title" type="text" name="study_title" required>

      <label for="study-criteria">Teilnahmekriterien</label>
      <textarea id="study-criteria" name="study_criteria" rows="3" required></textarea>

      <label for="study-compensation">Aufwandsentschädigung oder Gegenleistung</label>
      <textarea id="study-compensation" name="study_compensation" rows="2" required></textarea>

      <label for="study-procedures">Untersuchungen und Ablauf der Studie</label>
      <textarea id="study-procedures" name="study_procedures" rows="4" required></textarea>

      <label for="study-expires">Ablaufdatum</label>
      <input id="study-expires" type="date" name="study_expires" min="<?php echo date('Y-m-d'); ?>" required>

      <label for="study-pdf">Studieninformation als PDF (optional, maximal 2 MB)</label>
      <input id="study-pdf" type="file" name="study_pdf" accept="application/pdf,.pdf">

      <button type="submit">Studie hinzufügen</button>
    </form>

    <?php if (isset($success_studies)): ?>
      <p class="study-admin-message study-admin-message--success"><?php echo htmlspecialchars($success_studies); ?></p>
    <?php elseif (isset($error_studies)): ?>
      <p class="study-admin-message study-admin-message--error"><?php echo htmlspecialchars($error_studies); ?></p>
    <?php endif; ?>

    <h3 class="study-admin-list-title">Vorhandene Studien</h3>
    <?php if (empty($studies)): ?>
      <p>Es sind noch keine Studien eingetragen.</p>
    <?php else: ?>
      <div class="study-admin-list">
        <?php foreach ($studies as $study): ?>
          <div class="study-admin-item">
            <div>
              <strong><?php echo htmlspecialchars($study['title'] ?? ''); ?></strong>
              <span>Ablaufdatum: <?php echo htmlspecialchars($study['expires'] ?? ''); ?></span>
              <?php if (!empty($study['pdf'])): ?>
                <span>PDF-Datei angehängt</span>
              <?php endif; ?>
              <?php if (($study['expires'] ?? '') < date('Y-m-d')): ?>
                <span class="study-expired">Abgelaufen, wird nicht öffentlich angezeigt</span>
              <?php endif; ?>
              <details class="study-edit-details" <?php echo isset($editingStudyId) && $editingStudyId === ($study['id'] ?? '') ? 'open' : ''; ?>>
                <summary>Studie bearbeiten</summary>
                <form class="admin-form study-edit-form" method="POST" action="admin.php#studien-anpassen" enctype="multipart/form-data">
                  <input type="hidden" name="study_id" value="<?php echo htmlspecialchars($study['id'] ?? ''); ?>">

                  <div class="study-field-group">
                    <label for="study-title-<?php echo htmlspecialchars($study['id'] ?? ''); ?>">Name der Studie</label>
                    <input id="study-title-<?php echo htmlspecialchars($study['id'] ?? ''); ?>" type="text" name="study_title" value="<?php echo htmlspecialchars($study['title'] ?? ''); ?>" required>
                  </div>

                  <div class="study-field-group">
                    <label for="study-criteria-<?php echo htmlspecialchars($study['id'] ?? ''); ?>">Teilnahmekriterien</label>
                    <textarea id="study-criteria-<?php echo htmlspecialchars($study['id'] ?? ''); ?>" name="study_criteria" rows="3" required><?php echo htmlspecialchars($study['criteria'] ?? ''); ?></textarea>
                  </div>

                  <div class="study-field-group">
                    <label for="study-compensation-<?php echo htmlspecialchars($study['id'] ?? ''); ?>">Aufwandsentschädigung oder Gegenleistung</label>
                    <textarea id="study-compensation-<?php echo htmlspecialchars($study['id'] ?? ''); ?>" name="study_compensation" rows="2" required><?php echo htmlspecialchars($study['compensation'] ?? ''); ?></textarea>
                  </div>

                  <div class="study-field-group">
                    <label for="study-procedures-<?php echo htmlspecialchars($study['id'] ?? ''); ?>">Untersuchungen und Ablauf der Studie</label>
                    <textarea id="study-procedures-<?php echo htmlspecialchars($study['id'] ?? ''); ?>" name="study_procedures" rows="4" required><?php echo htmlspecialchars($study['procedures'] ?? ''); ?></textarea>
                  </div>

                  <div class="study-field-group">
                    <label for="study-expires-<?php echo htmlspecialchars($study['id'] ?? ''); ?>">Ablaufdatum</label>
                    <input id="study-expires-<?php echo htmlspecialchars($study['id'] ?? ''); ?>" type="date" name="study_expires" value="<?php echo htmlspecialchars($study['expires'] ?? ''); ?>" required>
                  </div>

                  <div class="study-field-group">
                    <label for="study-pdf-<?php echo htmlspecialchars($study['id'] ?? ''); ?>">PDF ersetzen oder hinzufügen (optional, maximal 2 MB)</label>
                    <input id="study-pdf-<?php echo htmlspecialchars($study['id'] ?? ''); ?>" type="file" name="study_pdf" accept="application/pdf,.pdf">
                    <?php if (!empty($study['pdf'])): ?>
                      <label class="study-remove-pdf"><input type="checkbox" name="remove_study_pdf" value="1"> Vorhandene PDF entfernen</label>
                    <?php endif; ?>
                  </div>

                  <div class="study-form-actions">
                    <button type="submit" name="action" value="edit_study">Änderungen speichern</button>
                    <button type="submit" name="action" value="delete_study" class="study-delete-button" onclick="return confirm('Diese Studie wirklich löschen?');">Studie löschen</button>
                  </div>
                </form>
              </details>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
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
</main>

  <?php include 'includes/footer.php'; ?>
</body>
</html>
