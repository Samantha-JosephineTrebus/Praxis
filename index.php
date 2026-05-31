<?php
require_once 'config.php';

// Daten laden
$hours = getHours();
$note = getNote();
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home – Praxis am Schloss</title>
  <link rel="stylesheet" href="public/style.css">
  <style>
  /* ===== DURCHGEHENDER BLAUER HEADER (Responsive) ===== */
    header {
      background: linear-gradient(135deg, #004a7f 0%, #0071c2 100%);
      padding: 2rem 1.5rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
    }

    header .logo {
      font-size: 1.8rem;
      font-weight: 800;
      color: #ffffff;
      margin-bottom: 1.5rem;
      text-align: center;
      max-width: 90%;
    }

    /* Menü-Toggle für Mobile */
    .menu-toggle {
      display: none;
      background: none;
      border: 1px solid white;
      color: white;
      font-size: 1.5rem;
      cursor: pointer;
      padding: 0.2rem 0.6rem;
      border-radius: 4px;
    }

    nav { width: 100%; }

    header #main-nav {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 1.5rem;
      padding: 0;
      margin: 0;
      list-style: none;
    }

    header #main-nav a {
      color: rgba(255, 255, 255, 0.9);
      text-decoration: none;
      font-weight: 600;
      font-size: 1rem;
      transition: color 0.3s;
    }

    header #main-nav a:hover, header #main-nav a.active {
      color: #ffffff;
      border-bottom: 2px solid #ffffff;
    }

    /* RESPONSIVE ANPASSUNG */
 /* RESPONSIVE ANPASSUNG (unter 1024px) */
@media (max-width: 1024px) {
  header {
    /* Erzwingt eine Zeile: Logo links, Button rechts */
    flex-direction: row; 
    justify-content: space-between;
    padding: 1rem 1.5rem;
  }

  header .logo {
    font-size: 1.2rem; /* Etwas kleiner für schmale Bildschirme */
    margin-bottom: 0;   /* Kein Platz unter dem Logo mehr */
    text-align: left;
    max-width: 70%;     /* Platz für den Button lassen */
  }

  .menu-toggle {
    display: block;
    margin-bottom: 0;
  }

  nav { 
    display: none; 
    position: absolute;
    top: 100%; /* Klappt direkt unter den Header aus */
    left: 0;
    width: 100%;
    background: #004a7f;
    padding: 1rem 0;
    z-index: 1000;
  }

  nav.active { display: block; }

  header #main-nav { 
    flex-direction: column; 
    align-items: center; 
    gap: 1rem; 
  }
}

    /* ===== Custom Styles für die Ärzte-Sektion im Glass-Look mit Custom-Hintergrund ===== */
    .doctors {
      margin: 4rem 0;
      background: linear-gradient(rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.1)), url('public/praxis.jpg') no-repeat center center;
      background-size: cover;
      background-attachment: scroll;
      padding: 4rem 2rem;
      border-radius: 24px;
    }
    
    .doctors h2 {
      color: #004a7f;
      text-align: center;
      margin-top: 0;
      margin-bottom: 3rem;
      font-size: 2rem;
      font-weight: 700;
      text-shadow: 0 2px 4px rgba(255, 255, 255, 0.6);
    }

    .doctor-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 2.5rem;
      max-width: 900px;
      margin: 0 auto;
    }

    .doctor-card-link {
      text-decoration: none;
      color: inherit;
      display: block;
      border-radius: 24px;
      transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .doctor-card {
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(255, 255, 255, 0.4);
      box-shadow: 0 12px 35px rgba(0, 74, 127, 0.06);
      border-radius: 24px;
      padding: 3.5rem 2rem;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      height: 100%;
      box-sizing: border-box;
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .doctor-card-link:hover {
      transform: translateY(-6px);
    }

    .doctor-card-link:hover .doctor-card {
      background: rgba(255, 255, 255, 0.45);
      border-color: rgba(255, 255, 255, 0.6);
      box-shadow: 0 20px 45px rgba(0, 74, 127, 0.12);
    }

    .doctor-avatar-placeholder {
      width: 85px;
      height: 85px;
      background: rgba(255, 255, 255, 0.5);
      border: 2px solid #004a7f;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #004a7f;
      font-size: 1.9rem;
      font-weight: 800;
      letter-spacing: 1px;
      margin-bottom: 1.5rem;
      box-shadow: 0 6px 20px rgba(0, 74, 127, 0.05);
      transition: transform 0.3s ease;
    }

    .doctor-card-link:hover .doctor-avatar-placeholder {
      transform: scale(1.05);
      background: #ffffff;
    }

    .doctor-card h3 {
      color: #004a7f;
      font-size: 1.45rem;
      margin: 0 0 0.8rem 0;
      font-weight: 700;
      text-shadow: 0 1px 2px rgba(255, 255, 255, 0.4);
    }

    .doctor-card p {
      color: #222;
      font-size: 1rem;
      line-height: 1.6;
      margin: 0 0 1.5rem 0;
      font-weight: 500;
    }

    .doctor-more-btn {
      font-size: 0.9rem;
      font-weight: 600;
      color: #004a7f;
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      margin-top: auto;
      transition: gap 0.2s ease;
    }

    .doctor-card-link:hover .doctor-more-btn {
      color: #0071c2;
      gap: 0.6rem;
    }
/* Unsichtbarer Login-Bereich */
.login-trigger-area {
    position: absolute;
    top: 0;
    right: 0;
    width: 50px; /* Trefferfläche von 50x50px oben rechts */
    height: 50px;
    z-index: 9999;
    opacity: 0; /* Komplett unsichtbar */
    cursor: default; /* Kein Cursor-Wechsel */
}
.admin-dashboard-bar {
    background: #ffffff;
    border-bottom: 2px solid #004a7f;
    padding: 0.75rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    margin-bottom: 2rem;
}

.admin-info {
    color: #004a7f;
    font-size: 0.9rem;
}

.admin-actions {
    display: flex;
    gap: 1rem;
}

.admin-btn {
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 600;
    padding: 0.4rem 1rem;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.admin-btn.panel {
    background: #004a7f;
    color: white;
}

.admin-btn.panel:hover {
    background: #0071c2;
}

.admin-btn.logout {
    background: #f8f9fa;
    color: #d32f2f;
    border: 1px solid #d32f2f;
}

.admin-btn.logout:hover {
    background: #d32f2f;
    color: white;
}
    /* Responsive Anpassung für Mobile */
    @media (max-width: 768px) {
      header .logo {
        font-size: 1.4rem;
        margin-bottom: 1rem;
      }
      header #main-nav {
        gap: 1rem;
      }
    }
  </style>
</head>
<body>
 <header>
  <a href="login.php" class="login-trigger-area" title="Login"></a>

    <div class="logo">Pneumologische Praxis am Schloss Charlottenburg</div>
    <button id="menu-toggle" class="menu-toggle" aria-label="Menü öffnen">☰</button>
    <nav id="nav-container">
      <ul id="main-nav">
        <li><a href="index.php" class="active">Home</a></li>
       <li>
          <a 
            href="https://www.doctolib.de/praxis/berlin/pneumologische-praxis-am-schloss-charlottenburg-dr-med-andres-de-roux-und-timo-weiss/booking/patient-insurance-sector?specialityId=1143&telehealth=false&placeId=practice-44058&profile_skipped=true&bookingFunnelSource=external_referral" 
            target="_blank" 
            rel="noopener noreferrer"
          >Onlinetermine</a>
        </li>
        <li><a href="leistung.php">Leistungen</a></li>
        <li><a href="vorbereitung.php">Vor Ihrem Besuch</a></li>
        <li><a href="aerzte.php">Ärzte</a></li>
        <li><a href="kontakt.php">Kontakt</a></li>
        <li><a href="finden.php">Anfahrt</a></li>
      </ul>
    </nav>
</header>

  <main class="container">
 
  <?php if (isLoggedIn()): ?>
    <section class="admin-dashboard-bar">
      <div class="admin-info">
          <span>✅ Eingeloggt als <strong>Administrator</strong></span>
      </div>
      <div class="admin-actions">
          <a href="admin.php" class="admin-btn panel">⚙️ Admin-Panel</a>
          <a href="logout.php" class="admin-btn logout">🚪 Logout</a>
      </div>
    </section>
  <?php endif; ?>

  <section class="intro-section">
      <div class="intro-left">
        <div class="welcome">
          <h1>Willkommen in unserer Praxis</h1>
          <p>Liebe Patientinnen und Patienten, wir freuen uns, Sie in unserer pneumologischen Praxis am Schloss Charlottenburg begrüßen zu dürfen. 
          Unsere erfahrenen Ärzte bieten Ihnen umfassende Diagnostik und Therapie auf höchstem Niveau.</p>

          <div class="haftnotiz">
            <h3><?php echo htmlspecialchars($note['title']); ?></h3>
            <p><?php echo $note['text']; ?></p>
          </div>
        </div>
      </div>

      <div class="intro-right">
        <div class="oeffnungszeiten">
          <h1>Unsere Öffnungszeiten</h1>
          <?php if (isAdminLoggedIn()): ?>
            <div style="margin-bottom: 1rem;">
              <a href="admin.php#oeffnungszeiten" style="color: #0071c2; text-decoration: none; font-weight: 600;">✏️ Bearbeiten</a>
            </div>
          <?php endif; ?>
          <div class="hours-card">
            <table class="hours-table">
            <?php
            $tage = [
              'monday' => 'Montag',
              'tuesday' => 'Dienstag',
              'wednesday' => 'Mittwoch',
              'thursday' => 'Donnerstag',
              'friday' => 'Freitag'
            ];
            foreach ($tage as $key => $label) {
              echo '<tr>';
              echo '<td class="hours-icon"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004a7f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="6" x2="12" y2="12"></line><line x1="12" y1="12" x2="16" y2="14"></line></svg></span></td>';
              echo '<td class="hours-day">'.$label.':</td>';
              echo '<td class="hours-time">';
              if ($key === 'friday' && isset($hours['friday']) && trim($hours['friday']) !== '') {
                echo htmlspecialchars($hours['friday']);
              } else {
                $morgens = trim($hours[$key.'_morning'] ?? '');
                $nachm = trim($hours[$key.'_afternoon'] ?? '');
                if ($morgens !== '' && $nachm !== '') {
                  echo htmlspecialchars($morgens).' und '.htmlspecialchars($nachm);
                } elseif ($morgens !== '') {
                  echo htmlspecialchars($morgens);
                } elseif ($nachm !== '') {
                  echo htmlspecialchars($nachm);
                } else {
                  echo '&mdash;';
                }
              }
              echo '</td>';
              echo '</tr>';
            }
            ?>
            </table>
            <p><a 
                    href="https://www.doctolib.de/praxis/berlin/pneumologische-praxis-am-schloss-charlottenburg-dr-med-andres-de-roux-und-timo-weiss/booking/patient-insurance-sector?specialityId=1143&telehealth=false&placeId=practice-44058&profile_skipped=true&bookingFunnelSource=external_referral" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    class="doctolib-link"
                  >
                  Buche deinen Termin ganz einfach Online über Doctolib!
              </a></p>
          </div>
        </div>
      </div>
    </section>

    <section class="doctors">
      <h2>Unsere Ärzte</h2>
      <div class="doctor-list">
        
        <a href="deroux.php" class="doctor-card-link">
          <div class="doctor-card">
            <div class="doctor-avatar-placeholder">AR</div>
            <h3>Dr. med. Andres de Roux</h3>
            <p>Spezialist für Pneumologie und Schlafmedizin, mit langjähriger Erfahrung.</p>
            <div class="doctor-more-btn">
              Zum Profil 
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </div>
          </div>
        </a>

        <a href="weiss.php" class="doctor-card-link">
          <div class="doctor-card">
            <div class="doctor-avatar-placeholder">TW</div>
            <h3>Timo Weiss</h3>
            <p>Spezialist für Pneumologie, engagiert für individuelle Patientenbetreuung.</p>
            <div class="doctor-more-btn">
              Zum Profil 
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </div>
          </div>
        </a>

      </div>
    </section>

    <section class="services">
      <h2>Unsere Leistungen</h2>
      <div class="service-cards">
        <div class="service-card">
          <h3>Lungenfunktionsdiagnostik</h3>
          <p>Präzise Messungen zur Beurteilung Ihrer Lungenfunktion.</p>
        </div>
        <div class="service-card">
          <h3>Allergietests & Immuntherapie</h3>
          <p>Individuelle Tests und Therapiepläne für Allergien.</p>
        </div>
        <div class="service-card">
          <h3>Schlafmedizinische Diagnostik</h3>
          <p>Untersuchungen und Lösungen bei Schlafapnoe & Co.</p>
        </div>
        <div class="service-card">
          <h3>Atemtherapie & Rehabilitation</h3>
          <p>Therapien zur Stärkung und Wiederherstellung der Atemwege.</p>
        </div>
        <div class="service-card">
          <h3>Infektions- & Entzündungserkrankungen</h3>
          <p>Behandlung von akuten und chronischen Atemwegserkrankungen.</p>
        </div>
        <div class="service-card">
          <h3>Asthma & COPD Management</h3>
          <p>Spezialisierte Therapie und Beratung zur Krankheitsbewältigung.</p>
        </div>
      </div>
    </section>
  </main>

  <footer>
    &copy; 2026 Praxis am Schloss Charlottenburg
            <a href="impressum.php">Impressum</a>
  </footer>

  <script>
    // Direktes Skript für den Menü-Toggle
    const menuToggle = document.getElementById('menu-toggle');
    const navContainer = document.getElementById('nav-container');

    if (menuToggle && navContainer) {
      menuToggle.addEventListener('click', function() {
        // Toggle der Klasse 'active' am nav-container
        navContainer.classList.toggle('active');
      });
    }
  </script>
</body>
</html>