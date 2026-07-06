<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>So finden Sie uns – Praxis am Schloss</title>
  <link rel="stylesheet" href="public/style.css">
</head>
<body>
  <header>
   
   <a href="/" class="logo praxis-logo">
  <span class="praxis-logo__title">Pneumologische Praxis</span>
  <span class="praxis-logo__subtitle">am Schloss Charlottenburg</span>
</a>
  <a href="login.php" class="login-trigger-area" title="Login"></a>
    <button id="menu-toggle" class="menu-toggle" aria-label="Menü öffnen">☰</button>
    <?php $current = basename($_SERVER['PHP_SELF']); ?>
    <nav>
      <ul id="main-nav">
        <li><a href="index.php" <?php if ($current === 'index.php') echo 'class="active"'; ?>>Startseite</a></li>
        <li><a 
              href="https://www.doctolib.de/praxis/berlin/pneumologische-praxis-am-schloss-charlottenburg-dr-med-andres-de-roux-und-timo-weiss/booking/patient-insurance-sector?specialityId=1143&telehealth=false&placeId=practice-44058&profile_skipped=true&bookingFunnelSource=external_referral" 
              target="_blank" 
              rel="noopener noreferrer"
            >
            Onlinetermine
        </a></li>
        <li><a href="leistung.php" <?php if ($current === 'leistung.php') echo 'class="active"'; ?>>Leistungen</a></li>
        <li><a href="vorbereitung.php" <?php if ($current === 'vorbereitung.php') echo 'class="active"'; ?>>Vor Ihrem Besuch</a></li>
        <li><a href="aerzte.php" <?php if ($current === 'aerzte.php') echo 'class="active"'; ?>>Ärzte</a></li>
        <li><a href="kontakt.php" <?php if ($current === 'kontakt.php') echo 'class="active"'; ?>>Kontakt</a></li>
        <li><a href="finden.php" <?php if ($current === 'finden.php') echo 'class="active"'; ?>>Anfahrt</a></li>
      </ul>
    </nav>
  </header>
  
<main class="container">
   <section class="hero">
  <div class="hero__inner">
    <p class="hero__eyebrow">Anfahrt</p>
    <h1 class="hero__title">
      Ihr Weg zu uns in die <span class="hero__title-accent">Praxis</span>
    </h1>
    <p class="hero__lead">
      Unsere Praxis ist bequem mit dem Auto sowie mit öffentlichen Verkehrsmitteln erreichbar. Hier finden Sie alle wichtigen Informationen zur Anfahrt, Parkmöglichkeiten und den nächstgelegenen Haltestellen, damit Sie Ihren Termin entspannt und pünktlich wahrnehmen können.
    </p>
  </div>
</section>

  <div class="anfahrts-container" style="display: flex; gap: 2rem; flex-wrap: wrap; align-items: center; margin-top: 1rem;">
    
    <!-- Text links -->
    <div class="anfahrts-info" style="
        flex: 1;
        min-width: 280px;
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(8px);
        border-radius: 16px;
        border: 2px solid rgba(0, 74, 127, 0.2);
        padding: 1.5rem 2rem;
        box-shadow: 0 6px 20px rgba(0, 74, 127, 0.1);
        font-family: Arial, sans-serif;
        color: #000;
        line-height: 1.6;
    ">
      <p style="font-size: 1.1rem; font-weight: 500; margin-bottom: 0.5rem;">
        <strong style="color: #004a7f;">Unsere Adresse:</strong><br>
        Spandauer Damm 3<br>
        14059 Berlin<br>
        (Schloß Charlottenburg / Luisenplatz)
      </p>

      <p style="font-size: 1rem; font-weight: 500; margin-bottom: 0.3rem; margin-top: 1rem;"><strong style="color: #004a7f;">So erreichen Sie uns:</strong></p>
      <ul style="padding-left: 1.2rem; margin: 0; list-style-type: disc;">
        <li>Bus: M45, 109, 309 bis Luisenplatz</li>
        <li>S-Bahn: S5 / S7 bis Charlottenburg, ca. 10 Minuten zu Fuß</li>
        <li>U-Bahn: U7 bis Richard-Wagner-Platz, ca. 12 Minuten zu Fuß</li>
      </ul>
    </div>

    <!-- Karte rechts -->
    <div class="map-container" style="flex: 2; min-width: 300px;">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2427.7863180895724!2d13.296178077029818!3d52.51920603628782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47a851259a9f7a71%3A0x8278488b430ebc2e!2sPneumologische%20Praxis%20am%20Schloss%20Charlottenburg%20Dr.%20med.%20Andr%C3%A9s%20de%20Roux%20und%20Timo%20Wei%C3%9F!5e0!3m2!1sde!2sde!4v1761044269751!5m2!1sde!2sde"
        width="95%"
        height="600"
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>

  </div>
</main>


  <footer>
    &copy; 2025 Praxis am Schloss Charlottenburg
  </footer>
  <script src="main.js"></script>
</body>
</html>
