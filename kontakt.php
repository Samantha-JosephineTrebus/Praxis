<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kontakt & Rezeptanfragen – Praxis am Schloss</title>
  <link rel="stylesheet" href="public/style.css">

<style>
   .container p {
      font-size: 1.1rem;
      line-height: 1.7;
      color: #333;
      max-width: 800px;
      margin: 0 auto;
      text-align: center;
    }
</style>

</head>
<body>
 <header>
    <div class="logo">Pneumologische Praxis am Schloss Charlottenburg</div>
    <button id="menu-toggle" class="menu-toggle" aria-label="Menü öffnen">☰</button>
    <nav>
      <ul id="main-nav">
        <li><a href="index.php">Startseite</a></li>
        <li><a 
              href="https://www.doctolib.de/praxis/berlin/pneumologische-praxis-am-schloss-charlottenburg-dr-med-andres-de-roux-und-timo-weiss/booking/patient-insurance-sector?specialityId=1143&telehealth=false&placeId=practice-44058&profile_skipped=true&bookingFunnelSource=external_referral" 
              target="_blank" 
              rel="noopener noreferrer"
            >
            Onlinetermine
        </a></li>
        <li><a href="leistung.php">Leistung</a></li>
        <li><a href="vorbereitung.php">Vor Ihrem Besuch</a></li>
        <li><a href="aerzte.php" class="active">Ärzte</a></li>
        <li><a href="kontakt.php">Kontakt</a></li>
        <li><a href="finden.php">Anfahrt</a></li>
      </ul>
    </nav>
  </header>

 <main class="container">
  <h2>Kontakt</h2>
  
  <!-- Dieser Bereich sorgt für den Hintergrund-Look wie in image_6023ba.png -->
  <section class="info-highlight-section">
    <p>
      Wir geben unser Bestes, um Ihre Anliegen so schnell wie möglich zu bearbeiten. Aufgrund des derzeit hohen Anfrageaufkommens bitten wir um Geduld – bitte planen Sie eine <strong>Antwortzeit von 1 bis 2 Werktagen</strong> ein.
      <br><br>
      <strong>Hinweis:</strong> Wir können <strong>keine medizinische Beratung per E-Mail</strong> anbieten. Bei akuten gesundheitlichen Fragen vereinbaren Sie bitte einen regulären Termin.
    </p>
  </section>

 <form action="mail.php" method="POST" class="contact-form">
  <label>Name</label>
  <input type="text" name="name" required>

  <label>E-Mail</label>
  <input type="email" name="email" required>

  <label>Nachricht</label>
  <textarea name="message" rows="6" required></textarea>

  <button type="submit">Absenden</button>
</form>
</main>

  <footer>
    &copy; 2025 Praxis am Schloss Charlottenburg
  </footer>
  <script src="main.js"></script>
</body>
</html>