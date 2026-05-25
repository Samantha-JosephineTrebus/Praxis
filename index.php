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
</head>
<body>
  <header>
    <div class="logo">Pneumologische Praxis am Schloss Charlottenburg</div>
    <button id="menu-toggle" class="menu-toggle" aria-label="Menü öffnen">☰</button>
    <nav>
      <ul id="main-nav">
        <li><a href="index.php" class="active">Home</a></li>
        <li><a 
              href="https://www.doctolib.de/praxis/berlin/pneumologische-praxis-am-schloss-charlottenburg-dr-med-andres-de-roux-und-timo-weiss/booking/patient-insurance-sector?specialityId=1143&telehealth=false&placeId=practice-44058&profile_skipped=true&bookingFunnelSource=external_referral" 
              target="_blank" 
              rel="noopener noreferrer"
            >
            Onlinetermine
        </a></li>
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
  
<section class="login-section">
  <?php if (isAdminLoggedIn()): ?>
    <span style="color: #004a7f; font-weight: 600; margin-right: 1rem;">Admin</span>
    <a href="admin.php" class="login-btn">⚙️ Admin-Panel</a>
    <a href="logout.php" class="login-btn" style="background: #ff6b6b;">🚪 Logout</a>
  <?php else: ?>
    <a href="login.php" class="login-btn">🔐 Anmelden</a>
  <?php endif; ?>
</section>


 <!-- Willkommenstext -->
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
        <p><span class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" 
               viewBox="0 0 24 24" fill="none" stroke="#004a7f" stroke-width="2" 
               stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="6" x2="12" y2="12"></line>
            <line x1="12" y1="12" x2="16" y2="14"></line>
          </svg>
        </span> Mo: <?php echo htmlspecialchars($hours['monday_morning']); ?></p>
        
        <p><span class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" 
               viewBox="0 0 24 24" fill="none" stroke="#004a7f" stroke-width="2" 
               stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="6" x2="12" y2="12"></line>
            <line x1="12" y1="12" x2="16" y2="14"></line>
          </svg>
        </span> Mo: <?php echo htmlspecialchars($hours['monday_afternoon']); ?></p>
        
        <p><span class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" 
               viewBox="0 0 24 24" fill="none" stroke="#004a7f" stroke-width="2" 
               stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="6" x2="12" y2="12"></line>
            <line x1="12" y1="12" x2="16" y2="14"></line>
          </svg>
        </span> Di: <?php echo htmlspecialchars($hours['tuesday_morning']); ?></p>
        
        <p><span class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" 
               viewBox="0 0 24 24" fill="none" stroke="#004a7f" stroke-width="2" 
               stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="6" x2="12" y2="12"></line>
            <line x1="12" y1="12" x2="16" y2="14"></line>
          </svg>
        </span> Di: <?php echo htmlspecialchars($hours['tuesday_afternoon']); ?></p>
        
        <p><span class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" 
               viewBox="0 0 24 24" fill="none" stroke="#004a7f" stroke-width="2" 
               stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="6" x2="12" y2="12"></line>
            <line x1="12" y1="12" x2="16" y2="14"></line>
          </svg>
        </span> Mi: <?php echo htmlspecialchars($hours['wednesday_morning']); ?></p>
        
        <p><span class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" 
               viewBox="0 0 24 24" fill="none" stroke="#004a7f" stroke-width="2" 
               stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="6" x2="12" y2="12"></line>
            <line x1="12" y1="12" x2="16" y2="14"></line>
          </svg>
        </span> Mi: <?php echo htmlspecialchars($hours['wednesday_afternoon']); ?></p>
        
        <p><span class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" 
               viewBox="0 0 24 24" fill="none" stroke="#004a7f" stroke-width="2" 
               stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="6" x2="12" y2="12"></line>
            <line x1="12" y1="12" x2="16" y2="14"></line>
          </svg>
        </span> Do: <?php echo htmlspecialchars($hours['thursday_morning']); ?></p>
        
        <p><span class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" 
               viewBox="0 0 24 24" fill="none" stroke="#004a7f" stroke-width="2" 
               stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="6" x2="12" y2="12"></line>
            <line x1="12" y1="12" x2="16" y2="14"></line>
          </svg>
        </span> Do: <?php echo htmlspecialchars($hours['thursday_afternoon']); ?></p>
        
        <p><span class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" 
               viewBox="0 0 24 24" fill="none" stroke="#004a7f" stroke-width="2" 
               stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="6" x2="12" y2="12"></line>
            <line x1="12" y1="12" x2="16" y2="14"></line>
          </svg>
        </span> Fr: <?php echo htmlspecialchars($hours['friday']); ?></p>
        
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


<!-- Ärzte-Vorstellung -->
   <section class="doctors">
  <h2>Unsere Ärzte</h2>
  <div class="doctor-list">
    <div class="doctor-card">
      <img src="public/AndresDeRoux.webp" alt="Dr. med. Andres de Roux">
      <h3>Dr. med. Andres de Roux</h3>
      <p>Spezialist für Pneumologie und Schlafmedizin, mit langjähriger Erfahrung.</p>
    </div>
    <div class="doctor-card">
      <img src="public/TimoWeiß.jpg" alt="Timo Weiss">
      <h3>Timo Weiss</h3>
      <p>Spezialist für Pneumologie, engagiert für individuelle Patientenbetreuung.</p>
    </div>
  </div>
</section>

    <!-- Leistungen -->
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
    &copy; 2025 Praxis am Schloss Charlottenburg
  </footer>

<script src="main.js"></script>

</body>
</html>
