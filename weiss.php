<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Timo Weiß – Praxis am Schloss</title>
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
      background-color: #f8f9fa;
    }

    main.container {
      flex: 1 0 auto;
      padding-bottom: 4rem;
    }

    footer {
      flex-shrink: 0;
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

    /* ===== Premium Fokus-Layout ===== */
    .doctor-detail-container {
      max-width: 1150px;
      margin: 0 auto;
      background: #ffffff;
      border-radius: 24px;
      border: 1px solid rgba(0, 74, 127, 0.08);
      box-shadow: 0 12px 40px rgba(0, 74, 127, 0.06);
      overflow: hidden;
    }

    /* Profil-Header */
    .doctor-profile-header {
      background: linear-gradient(135deg, #f5f9ff 0%, #dbeeff 100%);
      padding: 4rem 2rem 3rem 2rem;
      text-align: center;
      border-bottom: 1px solid rgba(0, 74, 127, 0.06);
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .doctor-large-initials {
      width: 95px;
      height: 95px;
      background: #ffffff;
      border: 3px solid #004a7f;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      box-shadow: 0 0 0 6px rgba(0, 74, 127, 0.05), 0 8px 20px rgba(0, 74, 127, 0.15);
      color: #004a7f;
      font-size: 2.2rem;
      font-weight: 800;
      letter-spacing: 1px;
      margin-bottom: 1.5rem;
    }

    .doctor-profile-header h2 {
      margin: 0 !important;
      font-size: 2.4rem;
      color: #004a7f;
      font-weight: 800;
      letter-spacing: -0.5px;
    }

    .doctor-subtitle {
      background: #004a7f;
      color: #ffffff;
      font-size: 0.85rem;
      font-weight: 600;
      padding: 0.5rem 1.4rem;
      border-radius: 30px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      margin-top: 1rem;
      box-shadow: 0 4px 10px rgba(0, 74, 127, 0.15);
    }

    /* Inhaltsbereich */
    .doctor-info-body {
      padding: 3.5rem;
    }

    .gutachter-badge {
      font-size: 1.1rem;
      color: #004a7f;
      background: rgba(0, 113, 194, 0.05);
      padding: 1rem 1.5rem;
      border-radius: 12px;
      border-left: 4px solid #0071c2;
      margin-bottom: 2.5rem;
      font-weight: 600;
    }

    .doctor-info-body h4 {
      color: #004a7f;
      font-size: 1.3rem;
      margin-top: 2.5rem;
      margin-bottom: 1.2rem;
      font-weight: 700;
      position: relative;
    }

    .doctor-info-body h4:first-of-type {
      margin-top: 0;
    }

    .doctor-info-body h4::after {
      content: "";
      display: block;
      width: 40px;
      height: 3px;
      background: #0071c2;
      border-radius: 2px;
      margin-top: 0.4rem;
    }

    /* Listen mit Custom-Häkchen (Schwerpunkte & Mitgliedschaften) */
    .doctor-info-body ul {
      list-style: none;
      padding: 0;
      margin: 1rem 0;
    }

    .doctor-info-body li {
      color: #333;
      font-size: 1.05rem;
      line-height: 1.7;
      margin-bottom: 0.8rem;
      position: relative;
      padding-left: 2rem;
    }

    .doctor-info-body li::before {
      content: "";
      position: absolute;
      left: 2px;
      top: 5px;
      width: 16px;
      height: 16px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%230071c2' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='20 6 9 17 4 12'%3E%3C/polyline%3E%3C/svg%3E");
      background-size: contain;
      background-repeat: no-repeat;
    }

    /* Werdegang (Timeline-Look) */
    .timeline {
      margin: 1.5rem 0;
      padding-left: 0;
      list-style: none;
    }

    .timeline-item {
      display: flex;
      gap: 1.5rem;
      margin-bottom: 1.2rem;
      padding-left: 0 !important;
      line-height: 1.6;
    }

    .timeline-item::before {
      display: none; /* Kein Häkchen für den Lebenslauf */
    }

    .timeline-date {
      font-weight: 700;
      color: #004a7f;
      min-width: 100px;
      flex-shrink: 0;
    }

    .timeline-content {
      color: #333;
    }

    /* Publikationen / Literatur */
    .publications-list {
      list-style: none !important;
      padding-left: 0 !important;
    }

    .publications-list li {
      padding-left: 1.5rem !important;
      font-size: 0.98rem;
      color: #444;
      margin-bottom: 1.2rem;
      line-height: 1.6;
    }

    .publications-list li::before {
      content: "•";
      background-image: none;
      left: 2px;
      top: 0;
      color: #0071c2;
      font-size: 1.4rem;
    }

    /* Mobile Responsive Optimierung */
    @media (max-width: 768px) {
      .doctor-info-body {
        padding: 2rem 1.5rem;
      }
      .doctor-profile-header h2 {
        font-size: 1.9rem;
      }
      .timeline-item {
        flex-direction: column;
        gap: 0.2rem;
        margin-bottom: 1.5rem;
      }
      .timeline-date {
        min-width: auto;
      }
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
        <li>
          <a 
            href="https://www.doctolib.de/praxis/berlin/pneumologische-praxis-am-schloss-charlottenburg-dr-med-andres-de-roux-und-timo-weiss/booking/patient-insurance-sector?specialityId=1143&telehealth=false&placeId=practice-44058&profile_skipped=true&bookingFunnelSource=external_referral" 
            target="_blank" 
            rel="noopener noreferrer"
          >Onlinetermine</a>
        </li>
        <li><a href="leistung.php">Leistung</a></li>
        <li><a href="vorbereitung.php">Vor Ihrem Besuch</a></li>
        <li><a href="aerzte.php">Ärzte</a></li>
        <li><a href="kontakt.php">Kontakt</a></li>
        <li><a href="finden.php">So finden Sie uns</a></li>
        <li><a href="impressum.php">Impressum</a></li>
      </ul>
    </nav>
  </header>

  <main class="container">
    <!-- Schicker Zurück-Button -->
    <div class="back-link-wrapper">
      <a href="aerzte.php" class="back-link">
        <svg viewBox="0 0 24 24"><path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/></svg>
        Zurück zur Übersicht
      </a>
    </div>
    
    <div class="doctor-detail-container">
      <!-- Premium Header-Bereich -->
      <div class="doctor-profile-header">
        <div class="doctor-large-initials">TW</div>
        <h2>Timo Weiß</h2>
        <div class="doctor-subtitle">Facharzt für Innere Medizin und Pneumologie, Infektiologie</div>
      </div>
      
      <!-- Inhaltsbereich -->
      <div class="doctor-info-body">
        <div class="gutachter-badge">
          Medizinischer Gutachter (Ärztekammer Berlin)
        </div>

        <h4>Tätigkeitsschwerpunkte</h4>
        <ul>
          <li><strong>Pulmonale Infektionen:</strong> Tuberkulose, nicht-tuberkulöse Mykobakterien (NTM), Pneumonie, chronische Atemwegsinfekte, Bronchiektasen</li>
          <li><strong>Asthma bronchiale und COPD</strong></li>
          <li><strong>Interstitielle Lungenkrankheiten</strong></li>
          <li><strong>Pneumologische Begutachtung:</strong> Berufskrankheiten, Gutachten für Gerichte und Versicherungen</li>
          <li><strong>DGUV:</strong> EVA-Mesothel beauftragbarer Arzt der DGUV</li>
        </ul>

        <h4>Beruflicher Werdegang</h4>
        <ul class="timeline">
          <li class="timeline-item">
            <span class="timeline-date">seit 2018</span>
            <span class="timeline-content">niedergelassen in der Pneumologischen Praxis am Schloss Charlottenburg</span>
          </li>
          <li class="timeline-item">
            <span class="timeline-date">2016 – 2018</span>
            <span class="timeline-content">Oberarzt Klinik für Pneumologie, Gemeinschaftskrankenhaus Havelhöhe, Berlin</span>
          </li>
          <li class="timeline-item">
            <span class="timeline-date">2015 – 2016</span>
            <span class="timeline-content">Oberarzt Klinik für Pneumologie, Helios Klinikum Schwerin</span>
          </li>
          <li class="timeline-item">
            <span class="timeline-date">2015</span>
            <span class="timeline-content"><strong>Franz Redeker Preis</strong> des Deutschen Zentralkomitees zur Bekämpfung der Tuberkulose</span>
          </li>
          <li class="timeline-item">
            <span class="timeline-date">2014 – 2015</span>
            <span class="timeline-content">Fellowship Division of Infectious Diseases and HIV Medicine, Groote Schuur Hospital, University Cape Town/Southafrica, Prof. Marc Mendelson</span>
          </li>
          <li class="timeline-item">
            <span class="timeline-date">2013 – 2014</span>
            <span class="timeline-content">Lungenklinik Heckeshorn, Helios Klinikum E. v. Behring, Berlin</span>
          </li>
          <li class="timeline-item">
            <span class="timeline-date">2013</span>
            <span class="timeline-content">Facharzt für Innere Medizin und Pneumologie (Ärztekammer Berlin)</span>
          </li>
          <li class="timeline-item">
            <span class="timeline-date">2006 – 2013</span>
            <span class="timeline-content">Klinik für Pneumologie der Lungenklinik Heckeshorn, Prof. Dr. Torsten Bauer, internistische u. intensivmedizinische Kliniken am Helios Klinikum Emil von Behring, Berlin</span>
          </li>
          <li class="timeline-item">
            <span class="timeline-date">2005</span>
            <span class="timeline-content">Approbation zum Arzt</span>
          </li>
          <li class="timeline-item">
            <span class="timeline-date">1998 – 2005</span>
            <span class="timeline-content">Studium der Humanmedizin in München und Berlin</span>
          </li>
          <li class="timeline-item">
            <span class="timeline-date">1995 – 1997</span>
            <span class="timeline-content">Studium der Neueren deutschen Literatur und Soziologie in Berlin</span>
          </li>
        </ul>

        <h4>Mitgliedschaften in Fachgesellschaften</h4>
        <ul>
          <li>Deutsche Gesellschaft für Pneumologie und Beatmungsmedizin (DGP)</li>
          <li>Deutsche Gesellschaft für Infektiologie (DGI)</li>
          <li>European Respiratory Society (ERS)</li>
          <li>European Society of Clinical Microbiology and Infectious Diseases (ESCMID)</li>
          <li>International Society for Infectious Diseases (ISID)</li>
          <li>International Union against Tuberculosis and Lung Disease (The Union)</li>
          <li>Berufsverband deutscher Internisten (BDI)</li>
          <li>Landesverband Berlin Brandenburg der Pneumologen</li>
        </ul>

        <h4>Literatur- und Kongressbeiträge (Auswahl)</h4>
        <ul class="publications-list">
          <li>Weiß T, Schönfeld N, Otto-Knapp R, Bös L, Bettermann G, Mauch H, Bauer TT, Rüssmann H. Low minimal inhibitory concentrations of linezolid against multidrug-resistant tuberculosis strains. <em>Eur Respir J.</em> 2015 Jan;45(1):285-7.</li>
          <li>Weiß T, Schönfeld N, Bettermann G, Blum T, Kollmeier J, Mauch H, Bauer TT, Rüssmann H. In vitro susceptibility of Mycobacterium bovis against moxifloxacin. <em>Int J Tuberc Lung Dis.</em> 2012 Nov;16(11):1562.</li>
          <li>Weiß T, Schönfeld N, Bergmann T, Mauch H, Blum T, Rüssmann H, Bauer TT. In vitro susceptibility of non-tuberculous mycobacterial strains against moxifloxacin. Poster ERS Annual Congress Wien 2012.</li>
          <li>Weiß T, Kollmeier J, Blum TG, Boch C, Crolow C, Misch D, Rüssmann H, Bauer TT. Lactat-dehydrogenase, C-reactive protein and white blood cell count are prognostic factors in advanced small cell lung cancer (SCLC). Poster ERS Annual Congress München 2014.</li>
          <li>Misch D, Blum T, Boch C, Weiß T, Crolow C, Griff S, Mairinger T, Bauer TT, Kollmeier J. Value of thyroid transcription factor (TTF)-1 for diagnosis and prognosis of patients with locally advanced or metastatic small cell lung cancer. <em>Diagn Pathol.</em> 2015 Apr 2;10:21.</li>
          <li>Otto-Knapp R, Bös L, Schönfeld N, Wagner S, Starzacher AK, Weiß T, Vesenbeckh S, Glaser-Paschke G, Mauch H. Resistenzen gegen Zweitlinienmedikamente bei Migranten mit multiresistenter Tuberkulose in Region Berlin. <em>Pneumologie</em> 2014, 68:496-500.</li>
        </ul>
      </div>
    </div>
  </main>

  <footer>
    &copy; 2026 Praxis am Schloss Charlottenburg
  </footer>
  <script src="main.js"></script>
</body>
</html>