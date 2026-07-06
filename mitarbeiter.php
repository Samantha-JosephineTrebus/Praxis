<?php
require_once 'config.php';

// Nur Mitarbeiter & Admin dürfen hier rein
if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

// Daten laden
$hours = getHours();
$note = getNote();
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mitarbeiter – Praxis</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="stylesheet" href="adminHomeStyle.css">
</head>
<body>

<header>
  <a href="/" class="logo praxis-logo">
  <span class="praxis-logo__title">Pneumologische Praxis</span>
  <span class="praxis-logo__subtitle">am Schloss Charlottenburg</span>
</a>
  <nav>
    <ul id="nav-list">
        <li><a href="index.php">← Zurück zur Startseite</a></li>
        <li><a href="logout.php" style="color: #ff6b6b;">Logout</a></li>
    </ul>
  </nav>
</header>

<main>
<div id="user-info">
  Eingeloggt als: <strong><?php echo $_SESSION['role'] === 'admin' ? 'Admin' : 'Mitarbeiter'; ?></strong>
</div>

  <!-- ÖFFNUNGSZEITEN ANZEIGE -->
  <article>
    <h2>Aktuelle Öffnungszeiten</h2>
    <div class="hours-card">
      <p><strong>Montag:</strong><br> morgens: <?php echo htmlspecialchars($hours['monday_morning']); ?><br> nachmittags: <?php echo htmlspecialchars($hours['monday_afternoon']); ?></p>
      <p><strong>Dienstag:</strong><br> morgens: <?php echo htmlspecialchars($hours['tuesday_morning']); ?><br> nachmittags: <?php echo htmlspecialchars($hours['tuesday_afternoon']); ?></p>
      <p><strong>Mittwoch:</strong><br> morgens: <?php echo htmlspecialchars($hours['wednesday_morning']); ?><br> nachmittags: <?php echo htmlspecialchars($hours['wednesday_afternoon']); ?></p>
      <p><strong>Donnerstag:</strong><br> morgens: <?php echo htmlspecialchars($hours['thursday_morning']); ?><br> nachmittags: <?php echo htmlspecialchars($hours['thursday_afternoon']); ?></p>
      <p><strong>Freitag:</strong><br> <?php echo htmlspecialchars($hours['friday']); ?></p>
    </div>
    
    <?php if (isAdminLoggedIn()): ?>
      <p style="margin-top: 1rem;">
        <a href="admin.php#oeffnungszeiten" style="color: #0071c2; text-decoration: none; font-weight: 600;">✏️ Bearbeiten (Admin)</a>
      </p>
    <?php endif; ?>
  </article>

  <!-- HAFTNOTIZ ANZEIGE -->
  <article>
    <h2><?php echo htmlspecialchars($note['title']); ?></h2>
    <p><?php echo $note['text']; ?></p>
    
    <?php if (isAdminLoggedIn()): ?>
      <p style="margin-top: 1rem;">
        <a href="admin.php#info-anpassen" style="color: #0071c2; text-decoration: none; font-weight: 600;">✏️ Bearbeiten (Admin)</a>
      </p>
    <?php endif; ?>
  </article>

</main>

</body>
</html>
