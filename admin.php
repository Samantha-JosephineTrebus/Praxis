<?php
require_once 'config.php';

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
  }
}

// Load data for forms
$hours = function_exists('getHours') ? getHours() : [];
$note = function_exists('getNote') ? getNote() : ['title' => '', 'text' => ''];
$deroux_data = function_exists('getJSONData') ? getJSONData('deroux_content') : [];
$current_deroux_text = $deroux_data['text'] ?? '';

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
    
    <form method="POST" action="admin.php">
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
    
    <form method="POST" action="admin.php">
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
<article id="deroux-anpassen">
    <h2>Dr. de Roux Profiltext</h2>
    <p>Bearbeiten Sie hier den Text für das Profil von Dr. de Roux.</p>
    
    <form method="POST" action="admin.php#deroux-anpassen">
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

</body>
</html>
