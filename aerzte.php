<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ärzte – Praxis am Schloss</title>
  <link rel="stylesheet" href="public/style.css">
  <style>
    /* ===== KORREKTUR: Footer immer unten halten ===== */
    html, body {
      height: 100%;
      margin: 0;
    }

    body {
      display: flex;
      flex-direction: column;
    }

    main.container {
      flex: 1 0 auto; /* Füllt den leeren Raum aus und schiebt den Footer runter */
    }

    footer {
      flex-shrink: 0; /* Verhindert, dass der Footer zusammengedrückt wird */
    }

    /* ===== Neues kartenbasiertes Design mit Monogrammen ===== */
    .doctors-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 3rem;
      margin-top: 3rem;
      padding: 1rem 0 3rem 0;
    }

    .doctor-card {
      background: #fff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 25px rgba(0, 74, 127, 0.08);
      border: 2px solid rgba(0, 74, 127, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
      text-align: center;
      cursor: pointer;
      display: flex;
      flex-direction: column;
    }

    .doctor-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 15px 35px rgba(0, 74, 127, 0.18);
      border-color: rgba(0, 113, 194, 0.4);
    }

    /* Oberer Balken der Karte */
    .doctor-card-header {
      background: linear-gradient(135deg, #f3f8ff 0%, #e6f2ff 100%);
      padding: 2.5rem 1rem 1.5rem 1rem;
      border-bottom: 1px solid rgba(0, 74, 127, 0.05);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* Das Monogramm-Feld als edler Foto-Ersatz */
    .doctor-initials-wrapper {
      width: 75px;
      height: 75px;
      background: #ffffff;
      border: 3px solid #004a7f;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      box-shadow: 0 4px 15px rgba(0, 74, 127, 0.1);
      color: #004a7f;
      font-size: 1.6rem;
      font-weight: 700;
      letter-spacing: 1px;
      font-family: 'Inter', Arial, sans-serif;
      transition: all 0.3s ease;
    }

    .doctor-card:hover .doctor-initials-wrapper {
      transform: scale(1.08);
      background: #004a7f;
      color: #ffffff;
      box-shadow: 0 6px 20px rgba(0, 74, 127, 0.2);
    }

    .doctor-card-content {
      padding: 2rem;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    /* Berufsbezeichnung-Tag */
    .doctor-title {
      display: inline-block;
      align-self: center;
      background: rgba(0, 74, 127, 0.08);
      color: #004a7f;
      font-size: 0.85rem;
      font-weight: 600;
      padding: 0.35rem 1rem;
      border-radius: 30px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 1rem;
    }

    .doctor-card h3 {
      font-size: 1.5rem;
      margin: 0 0 1rem 0;
      font-weight: 700;
    }

    .doctor-card h3 a {
      color: #004a7f;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .doctor-card:hover h3 a {
      color: #0071c2;
    }

    .doctor-card p {
      font-size: 1rem;
      color: #444;
      line-height: 1.6;
      margin: 0;
    }

    /* Profil-Link Button */
    .doctor-profile-btn {
      margin-top: auto;
      padding-top: 1.5rem;
      color: #0071c2;
      font-weight: 600;
      font-size: 0.95rem;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      transition: color 0.3s ease;
    }

    .doctor-card:hover .doctor-profile-btn {
      color: #004a7f;
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">Pneumologische Praxis am Schloss Charlottenburg</div>
    <button id="menu-toggle" class="menu-toggle" aria-label="Menü öffnen">☰</button>
    <nav>
      <ul id="main-nav">
        <li><a href="index.php">Home</a></li>
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
        <li><a href="finden.php">So finden Sie uns</a></li>
        <li><a href="impressum.php">Impressum</a></li>
      </ul>
    </nav>
  </header>

  <main class="container">
    <h2>Unser Ärzteteam</h2>
    
    <div class="intro-text-block" style="max-width: 800px; margin: 0 auto 3rem auto; text-align: center; line-height: 1.8;">
      <p style="font-size: 1.15rem; color: #004a7f; font-weight: 600; margin-bottom: 0.5rem;">
        Höchste Fachkompetenz für Ihre Lungengesundheit
      </p>
      <p style="font-size: 1.05rem; color: #444; margin: 0;">
        In unserer Praxis am Schloss verbinden wir langjährige klinische Erfahrung mit modernster Diagnostik. 
        Unser Anspruch ist es, Sie nicht nur medizinisch auf höchstem Niveau zu behandeln, sondern Sie auch 
        menschlich und individuell zu betreuen. Gemeinsam setzen wir uns täglich dafür ein, Ihnen die bestmögliche 
        Versorgung und spürbare Erleichterung im Alltag zu bieten.
      </p>
    </div>

    <div class="doctors-grid">
      <div class="doctor-card" onclick="window.location.href='weiss.php'">
        <div class="doctor-card-header">
          <div class="doctor-initials-wrapper">TW</div>
        </div>
        <div class="doctor-card-content">
          <div class="doctor-title">Facharzt für Pneumologie</div>
          <h3><a href="weiss.php">Timo Weiß</a></h3>
          <p>Spezialist für Atemwegserkrankungen und allergologische Diagnostik. Engagiert sich für innovative Therapieansätze und patientenorientierte Medizin.</p>
          <div class="doctor-profile-btn">Zum Profil →</div>
        </div>
      </div>

      <div class="doctor-card" onclick="window.location.href='deRoux.php'">
        <div class="doctor-card-header">
          <div class="doctor-initials-wrapper">AR</div>
        </div>
        <div class="doctor-card-content">
          <div class="doctor-title">Facharzt für Pneumologie</div>
          <h3><a href="deRoux.php">Dr. med. Andrés de Roux</a></h3>
          <p>Spezialisiert auf Lungenfunktionsprüfungen und Schlafmedizin. Mit großer klinischer Erfahrung und Leidenschaft für eine ganzheitliche Patientenversorgung.</p>
          <div class="doctor-profile-btn">Zum Profil →</div>
        </div>
      </div>
    </div>
  </main>

  <footer>
    &copy; 2026 Praxis am Schloss Charlottenburg
  </footer>
  <script src="main.js"></script>
</body>
</html>