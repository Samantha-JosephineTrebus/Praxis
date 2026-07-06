<?php
// 1. PHP MUSS GANZ OBEN STEHEN
require_once 'config.php';
$deroux_data = getDerouxText();
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dr. med. Andrés de Roux – Praxis am Schloss</title>
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
      flex: 1 0 auto; /* Schiebt den Footer bei wenig Inhalt nach ganz unten */
      padding-bottom: 4rem;
    }

    footer {
      flex-shrink: 0;
    }

    /* ===== Zurück-Link Styling ===== */
    .back-link {
      display: inline-block;
      color: #0071c2;
      text-decoration: none;
      font-weight: 600;
      margin-bottom: 2rem;
      transition: color 0.3s ease, transform 0.3s ease;
    }

    .back-link:hover {
      color: #004a7f;
      transform: translateX(-4px);
    }

    /* ===== Einspaltiges Fokus-Layout ohne Bild ===== */
    .doctor-detail-container {
      max-width: 1150px;
      margin: 0 auto;
      background: #ffffff;
      border-radius: 20px;
      border: 2px solid rgba(0, 74, 127, 0.1);
      box-shadow: 0 8px 25px rgba(0, 74, 127, 0.06);
      overflow: hidden;
    }

    /* Personalisierter Profil-Header mit Monogramm */
    .doctor-profile-header {
      background: linear-gradient(135deg, #f3f8ff 0%, #e6f2ff 100%);
      padding: 3rem 2rem;
      text-align: center;
      border-bottom: 1px solid rgba(0, 74, 127, 0.08);
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
    }

    .doctor-large-initials {
      width: 90px;
      height: 90px;
      background: #ffffff;
      border: 3px solid #004a7f;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      box-shadow: 0 4px 15px rgba(0, 74, 127, 0.1);
      color: #004a7f;
      font-size: 2rem;
      font-weight: 700;
      letter-spacing: 1px;
      margin-bottom: 0.5rem;
    }

    .doctor-profile-header h2 {
      margin: 0 !important;
      font-size: 2.2rem;
      color: #004a7f;
    }

    .doctor-subtitle {
      background: rgba(0, 74, 127, 0.08);
      color: #004a7f;
      font-size: 0.9rem;
      font-weight: 600;
      padding: 0.4rem 1.2rem;
      border-radius: 30px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-top: 0.5rem;
    }

    /* Inhaltsbereich */
    .doctor-info-body {
      padding: 3rem;
    }

    .doctor-info-body p {
      font-size: 1.1rem;
      color: #333;
      line-height: 1.8;
      margin-bottom: 1.5rem;
    }

    .doctor-info-body h4 {
      color: #004a7f;
      font-size: 1.3rem;
      margin-top: 2.5rem;
      margin-bottom: 1rem;
      font-weight: 600;
      border-bottom: 2px solid #e6f2ff;
      padding-bottom: 0.5rem;
    }

    .doctor-info-body ul {
      list-style: none;
      padding: 0;
      margin: 1.5rem 0;
    }

    .doctor-info-body li {
      color: #333;
      font-size: 1.05rem;
      line-height: 1.8;
      margin-bottom: 1.2rem;
      position: relative;
      padding-left: 1.8rem;
    }

    .doctor-info-body li::before {
      content: "•";
      position: absolute;
      left: 0;
      color: #0071c2;
      font-weight: bold;
      font-size: 1.3rem;
      top: -2px;
    }

    /* Links im Fließtext */
    .doc-link {
      position: relative;
      display: inline-flex;
      align-items: center;
      gap: 0.2rem;
      color: #005c9a;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .doc-link::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: -1px;
      width: 0%;
      height: 2px;
      background: linear-gradient(90deg, #0071c2, #00a6ff);
      transition: width 0.3s ease;
    }

    .doc-link:hover {
      color: #0088e0;
    }

    .doc-link:hover::after {
      width: 100%;
    }

   /* ===== Aktuelles Kasten im Haftnotiz-Look ===== */
    .aktuelle-info {
    color: #002a4d;
  background: linear-gradient(135deg, #cde7ff 0%, #b3dbff 100%);
  border-left: 6px solid #004a7f;
  box-shadow: 0 8px 20px rgba(0, 74, 127, 0.15);
  padding: 1.2rem 1.5rem;
  border-radius: 10px;
  max-width: 420px;
  position: relative;
  transform: rotate(-1deg);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .aktuelle-info:hover {
        transform: rotate(0deg) scale(1.02);
  box-shadow: 0 10px 25px rgba(0, 74, 127, 0.25);
    }

    /* Das Tesafilm-Element */
    .aktuelle-info::after {
        content: "";
  position: absolute;
  top: -12px;
  left: 42%;
  width: 40px;
  height: 20px;
  background: rgba(0, 74, 127, 0.2);
  clip-path: polygon(0 0, 100% 0, 80% 100%, 20% 100%);
  border-radius: 2px;
}
    }

/* ===== Moderner, animierter Zurück-Button ===== */
    .back-link-wrapper {
      margin-bottom: 2rem;
    }

    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      color: #004a7f;
      background: #ffffff;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.95rem;
      padding: 0.6rem 1.2rem;
      border-radius: 50px;
      border: 1px solid rgba(0, 74, 127, 0.15);
      box-shadow: 0 4px 10px rgba(0, 74, 127, 0.04);
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .back-link svg {
      width: 16px;
      height: 16px;
      fill: currentColor;
      transition: transform 0.3s ease;
    }

    .back-link:hover {
      color: #ffffff;
      background: #004a7f;
      border-color: #004a7f;
      box-shadow: 0 6px 15px rgba(0, 74, 127, 0.2);
      transform: translateY(-2px);
    }

    .back-link:hover svg {
      transform: translateX(-4px);
    }

    .aktuelle-info h4 {
      margin-top: 0 !important;
      border-bottom: none !important;
      padding-bottom: 0 !important;
      color: #004a7f;
      font-size: 1.1rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 0.75rem !important;
    }

    .aktuelle-info p {
      margin-bottom: 0;
      font-size: 1rem;
      color: #222;
      line-height: 1.6;
      padding-bottom: 1rem;
    }

    .edit-btn {
      font-size: 0.8rem;
      background: #004a7f;
      color: #fff;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 2.2rem;
      font-weight: 600;
      box-shadow: 0 3px 10px rgba(0, 74, 127, 0.15);
      transition: all 0.3s ease;
    }

    .edit-btn:hover {
      background: #0071c2;
      transform: translateY(-1px);
      box-shadow: 0 5px 15px rgba(0, 113, 194, 0.25);
    }

/* ===== Responsive Anpassung ===== */
    
    /* 1. Basis-Struktur (Mobil zuerst) */
    .content-wrapper {
      display: flex;
      flex-direction: column;
      gap: 2rem;
      padding: 3rem;
    }

    /* 2. Desktop-Anpassung (ab 1024px) */
    @media (min-width: 1024px) {
      .content-wrapper {
        flex-direction: row; /* Jetzt erst werden sie nebeneinander gesetzt */
        align-items: flex-start;
      }

      .doctor-info-body {
        flex: 2;
        padding: 0; 
      }
      
      .aktuelle-info {
        flex: 1;
        margin-top: 0 !important;
      }
    }

    /* 3. Anpassungen für kleinere Screens (inkl. Tablets) */
    @media (max-width: 1023px) {
      .doctor-info-body {
        padding: 1.5rem;
      }
      .content-wrapper {
        padding: 1.5rem;
        /* Auf mobilen Geräten: poste-it (aktuelle-info) oben anzeigen */
        flex-direction: column-reverse;
      }
      /* Auf Tablets und Handys: Aktuelle-Info zentrieren */
      .aktuelle-info {
        align-self: center;
        margin: 0 auto;
        max-width: 92%;
      }
      .doctor-profile-header h2 {
        font-size: 1.8rem;
      }
    }
  </style>
</head>
<body>
  <header>
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
    <a href="aerzte.php" class="back-link"><svg viewBox="0 0 24 24"><path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/></svg>Zurück zu den Ärzten</a>
    
    <div class="doctor-detail-container">
      <div class="doctor-profile-header">
        <div class="doctor-large-initials">AR</div>
        <h2>Dr. med. Andrés de Roux</h2>
        <div class="doctor-subtitle">Facharzt für Innere Medizin, Schwerpunkt Pneumologie</div>
      </div>
      
      <div class="content-wrapper"> <div class="doctor-info-body">
        <p><strong>Zusatzbezeichnungen:</strong> Infektiologie und Somnologie</p>

        <h4>Tätigkeitsschwerpunkte</h4>
        <ul>
          <li><strong>Atemwegsinfektionen bei pulmonalen Grunderkrankungen:</strong> Pneumonie, chronische Atemwegsinfekte, Bronchiektasen, Tuberkulose, Lungeninfektionen durch atypische Mykobakterien</li>
          <li><strong>Impfprävention beim Erwachsenen / Senioren:</strong> Insbesondere Influenza, Pneumokokken, Pertussis</li>
          <li><strong>Schlafmedizinische Erkrankungen:</strong> Vor allem aus dem lungenfachärztlichen Bereich (Schnarchen, Tagesmüdigkeit, nächtliche Atemaussetzer), Einleitung und Überprüfung von nächtlichen Beatmungstherapien (CPAP, BIPAP, NIV)</li>
          <li><strong>Publikationen:</strong> Wissenschaftliche Veröffentlichungen und Fachartikel von Dr. de Roux finden Sie auf <a href="https://pubmed.ncbi.nlm.nih.gov/?orig_db=PubMed&db=pubmed&cmd=Search&term=De+Roux+A[author]" target="_blank" rel="noopener noreferrer" class="doc-link">PubMed</a></li>
          <li><strong>Engagement:</strong> Dr. de Roux organisiert den Berliner <a href="https://pneumochatbb.de/" target="_blank" rel="noopener noreferrer" class="doc-link">Pneumo QZ</a> und fördert damit regelmäßig den fachlichen Austausch und die pneumologische Fortbildung in Berlin.</li>
        </ul>
</div>
        <div id="aktuelle-info-container" class="aktuelle-info">
          <h4>Aktuelles</h4>
          <p id="aktuelle-info-text"><?php echo nl2br(htmlspecialchars($deroux_data['text'])); ?></p>
          
          <?php if (isAdminLoggedIn()): ?>
            <a href="admin.php#deroux-anpassen" class="edit-btn">Bearbeiten</a>
          <?php endif; ?>
        </div>
      
    </div>
  </main>

  <footer>
    &copy; 2026 Praxis am Schloss Charlottenburg
  </footer>
  <script src="main.js"></script>
</body>
</html>