<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vor Ihrem Besuch – Praxis am Schloss Charlottenburg</title>
  <link rel="stylesheet" href="public/style.css">
  <style>
    :root {
      --primary: #004a7f;          /* Petrol/Blau-Grün Akzent */
      --foreground: #0b1f2a;
      --muted: #5b6574;
      --bg: #ffffff;
      --secondary: #eef6ff;
      --primary-soft-1: rgba(15, 72, 118, 0.1);
      --primary-soft-2: rgba(15, 39, 118, 0.05);
    }

    * { box-sizing: border-box; }
    body {
      color: var(--foreground);
      background: var(--bg);
    }

  
    /* ==== Eigenes Design für Vorbereitung ==== */
    .vorbereitung-section {
      padding: 0;
      background: #ffffff;
    }

    .vorbereitung-section h2 {
      color: #004a7f;
      font-size: 2rem;
      font-weight: 600;
      text-align: center;
      padding: 3rem 2rem 1rem;
      margin: 0;
    }

    .vorbereitung-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
      padding: 2rem 2rem 4rem 2rem;
      background: #ffffff;
    }

    .vorbereitung-card {
      background: #fff;
      border-radius: 18px;
      padding: 2rem 1.5rem;
      box-shadow: 0 8px 20px rgba(0, 74, 127, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .vorbereitung-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 28px rgba(0, 74, 127, 0.2);
    }

    .vorbereitung-card h3 {
      color: #004a7f;
      font-size: 1.3rem;
      margin-bottom: 1rem;
      font-weight: 600;
    }

    .vorbereitung-card p {
      font-size: 0.95rem;
      color: #333;
      line-height: 1.6;
      margin-bottom: 1.5rem;
    }

    /* Deko-Kreis */
    .vorbereitung-card::before {
      content: "";
      position: absolute;
      top: -40px;
      right: -40px;
      width: 100px;
      height: 100px;
      background: rgba(0, 84, 153, 0.507);
      border-radius: 50%;
      z-index: 0;
      transition: transform 0.4s ease;
    }

    .vorbereitung-card:hover::before {
      transform: scale(1.3);
    }

    .vorbereitung-card * {
      position: relative;
      z-index: 1;
    }

    .download-btn {
      background: linear-gradient(135deg, #004a7f, #0071c2);
      color: #fff;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 10px;
      font-size: 0.95rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
      margin-right: 0.5rem;
      margin-bottom: 0.5rem;
    }

    .download-btn:hover {
      background: linear-gradient(135deg, #005c9a, #0088e0);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 74, 127, 0.3);
    }

    .vorbereitung-checklist {
      background: #ffffff;
      padding: 3rem 2rem;
      text-align: left;
      border-top: 2px solid rgba(0,74,127,0.1);
    }

    .vorbereitung-checklist h2 {
      color: #004a7f;
      font-size: 2rem;
      text-align: center;
      margin-bottom: 2rem;
      font-weight: 600;
    }

    .checklist-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .checklist-item {
      background: #f8fbff;
      padding: 1.5rem;
      border-radius: 12px;
      border-left: 4px solid #0071c2;
      box-shadow: 0 4px 12px rgba(0, 74, 127, 0.08);
    }

    .checklist-item h3 {
      color: #004a7f;
      font-size: 1.1rem;
      margin: 0 0 0.75rem 0;
      display: flex;
      align-items: center;
      font-weight: 600;
    }

    .checklist-item h3::before {
      content: "✓";
      color: #0071c2;
      font-weight: bold;
      font-size: 1.3rem;
      margin-right: 0.75rem;
    }

    .checklist-item p {
      color: #333;
      font-size: 0.95rem;
      line-height: 1.6;
      margin: 0;
    }

    .checklist-item ul {
      margin: 1rem 0 0 0;
      padding-left: 1.5rem;
      list-style: none;
    }

    .checklist-item li {
      color: #333;
      font-size: 0.95rem;
      margin-bottom: 0.5rem;
      padding-left: 1.5rem;
      position: relative;
    }

    .checklist-item li::before {
      content: "•";
      color: #0071c2;
      font-weight: bold;
      margin-right: 0.5rem;
      position: absolute;
      left: 0;
    }


    @media (max-width: 600px) {
      .vorbereitung-card {
        padding: 1.5rem 1rem;
      }

      .download-btn {
        width: 100%;
        text-align: center;
      }
    }
  </style>
</head>
<body>
  <header>
    <a href="login.php" class="login-trigger-area" title="Login"></a>
    <a href="/" class="logo praxis-logo">
  <span class="praxis-logo__title">Pneumologische Praxis</span>
  <span class="praxis-logo__subtitle">am Schloss Charlottenburg</span>
</a>
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
    <p class="hero__eyebrow">Vor Ihrem Besuch</p>
    <h1 class="hero__title">
      Gut vorbereitet zu Ihrem <span class="hero__title-accent">Termin</span>
    </h1>
    <p class="hero__lead">
      Um Ihren Besuch in unserer Praxis optimal vorzubereiten und Zeit zu sparen, möchten wir Ihnen hier wichtige Informationen und hilfreiche Formulare zur Verfügung stellen. Laden Sie gerne die notwendigen Dokumente herunter, füllen Sie diese zuhause aus und bringen Sie diese zu Ihrem Termin mit.
    </p>
  </div>
</section>
  </main>

  <section class="vorbereitung-section">
    <h2>Formulare & Dokumente zum Download</h2>
    <div class="vorbereitung-grid">
      <div class="vorbereitung-card">
        <h3>📋 Patientenfragebogen</h3>
        <p>
          Dieser Fragebogen hilft uns, Ihre medizinische Geschichte und aktuelle Symptome besser zu verstehen. Bitte füllen Sie diesen vor Ihrem Termin aus.
        </p>
        <button class="download-btn">⬇️ Herunterladen (PDF)</button>
      </div>

      <div class="vorbereitung-card">
        <h3>📝 Allergiepass</h3>
        <p>
          Falls Sie bekannte Allergien haben, können Sie diese hier dokumentieren. Dies ist wichtig für unsere Ärzte bei der Behandlung.
        </p>
        <button class="download-btn">⬇️ Herunterladen (PDF)</button>
      </div>

      <div class="vorbereitung-card">
        <h3>💊 Medikamentenliste</h3>
        <p>
          Eine übersichtliche Liste aller Ihrer aktuellen Medikamente. Füllen Sie diese aus, um unseren Ärzten einen schnellen Überblick zu geben.
        </p>
        <button class="download-btn">⬇️ Herunterladen (PDF)</button>
      </div>

      <div class="vorbereitung-card">
        <h3>🫁 Symptom-Tagebuch</h3>
        <p>
          Dokumentieren Sie Ihre Atemwegs-Symptome vor dem Besuch. Dies hilft uns, Ihre Beschwerden besser zu evaluieren.
        </p>
        <button class="download-btn">⬇️ Herunterladen (PDF)</button>
      </div>

      <div class="vorbereitung-card">
        <h3>😴 Schlaftagebuch</h3>
        <p>
          Wenn Sie an Schlafstörungen leiden, können Sie hier Ihr Schlafverhalten dokumentieren.
        </p>
        <button class="download-btn">⬇️ Herunterladen (PDF)</button>
      </div>
    </div>
  </section>

  <section class="vorbereitung-checklist">
    <h2>Was Sie zum Termin mitbringen sollten</h2>
    <div class="checklist-grid">
      <div class="checklist-item">
        <h3>Versichertenkarte</h3>
        <p>
          Bitte bringen Sie Ihre aktuelle Versichertenkarte mit. Diese benötigen wir für die Abrechnung Ihrer Behandlung.
        </p>
      </div>

      <div class="checklist-item">
        <h3>Ausweis</h3>
        <p>
          Ein gültiger Ausweis (Personalausweis oder Reisepass) wird für unsere Patientenakten benötigt.
        </p>
      </div>

      <div class="checklist-item">
        <h3>Medikamentenpläne</h3>
        <p>
          Falls vorhanden, bringen Sie bitte:
        </p>
        <ul>
          <li>Aktuelle Medikamentenpläne von Ihrem Hausarzt</li>
          <li>Übersicht aller regelmäßig eingenommenen Medikamente</li>
          <li>Dosierungen und Einnahmezeitpunkte</li>
        </ul>
      </div>

      <div class="checklist-item">
        <h3>Vorbefunde & Berichte</h3>
        <p>
          Wichtig für unsere Diagnose:
        </p>
        <ul>
          <li>Vorbefunde und Berichte von anderen Fachärzten</li>
          <li>Röntgen- oder CT-Aufnahmen (falls vorhanden)</li>
          <li>Ergebnisse von vorherigen Lungenfunktionstests</li>
          <li>Befunde von Allergietests</li>
        </ul>
      </div>

      <div class="checklist-item">
        <h3>Ausgefüllte Formulare</h3>
        <p>
          Bringen Sie gerne die heruntergeladenen und ausgefüllten Formulare mit:
        </p>
        <ul>
          <li>Patientenfragebogen</li>
          <li>Medikamentenliste</li>
          <li>Allergiepass (falls zutreffend)</li>
          <li>Symptom- oder Schlaftagebuch</li>
        </ul>
      </div>

      <div class="checklist-item">
        <h3>Weitere wichtige Unterlagen</h3>
        <p>
          Falls vorhanden:
        </p>
        <ul>
          <li>Aktuelle Lungenfunktionsergebnisse</li>
          <li>EKG-Befunde</li>
          <li>Blutuntersuchungsergebnisse</li>
          <li>Impfpass (bei Bedarf)</li>
        </ul>
      </div>
    </div>
  </section>

   <footer>
    &copy; 2025 Praxis am Schloss Charlottenburg
  </footer>

  <script src="main.js"></script>
</body>
</html>
