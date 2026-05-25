<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dr. med. Andrés de Roux – Praxis am Schloss</title>
  <link rel="stylesheet" href="public/style.css">
  <style>
    .back-link {
      display: inline-block;
      color: #0071c2;
      text-decoration: none;
      font-weight: 600;
      margin-bottom: 1.5rem;
      transition: color 0.3s ease, transform 0.3s ease;
    }

    .back-link:hover {
      color: #004a7f;
      transform: translateX(-4px);
    }

    .doctor-detail {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
      align-items: start;
      margin-top: 2rem;
    }

    .doctor-detail img {
      width: 100%;
      max-width: 400px;
      border-radius: 18px;
      box-shadow: 0 8px 20px rgba(0, 74, 127, 0.1);
    }

    .doctor-info {
      padding-right: 1rem;
    }

    .doctor-info h3 {
      color: #0071c2;
      font-size: 0.95rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .doctor-info p {
      font-size: 1rem;
      color: #333;
      line-height: 1.8;
      margin-bottom: 1rem;
    }

    .doctor-info ul {
      list-style: none;
      padding: 0;
      margin: 1.5rem 0;
    }

    .doctor-info li {
      color: #333;
      line-height: 1.8;
      margin-bottom: 1rem;
      position: relative;
      padding-left: 1.5rem;
    }

    .doctor-info li::before {
      content: "•";
      position: absolute;
      left: 0;
      color: #0071c2;
      font-weight: bold;
    }

    .links-section {
      display: flex;
      gap: 1.5rem;
      margin-top: 1.5rem;
      flex-wrap: wrap;
    }

    .doc-link {
      display: inline-block;
      background: linear-gradient(135deg, #004a7f, #0071c2);
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      padding: 0.75rem 1.5rem;
      border-radius: 12px;
      transition: all 0.3s ease;
    }

    .doc-link:hover {
      background: linear-gradient(135deg, #005c9a, #0088e0);
      transform: translateY(-2px);
    }

    .aktuelle-info {
      background: linear-gradient(135deg, #cde7ff 0%, #b3dbff 100%);
      border-left: 6px solid #004a7f;
      padding: 1.5rem;
      border-radius: 12px;
      margin-top: 2rem;
      color: #002a4d;
    }

    .aktuelle-info h4 {
      margin-top: 0;
      color: #004a7f;
      font-size: 1rem;
      font-weight: 600;
    }

    .aktuelle-info p {
      margin-bottom: 0;
      font-size: 0.95rem;
    }

    .edit-btn {
      font-size: 0.75rem;
      background: #004a7f;
      color: #fff;
      border: none;
      padding: 0.4rem 0.8rem;
      border-radius: 6px;
      cursor: pointer;
      margin-top: 0.75rem;
      transition: background 0.3s ease;
    }

    .edit-btn:hover {
      background: #0071c2;
    }

    @media (max-width: 768px) {
      .doctor-detail {
        grid-template-columns: 1fr;
      }

      .doctor-detail img {
        max-width: 100%;
      }

      .doctor-info {
        padding-right: 0;
      }

      .links-section {
        flex-direction: column;
      }

      .doc-link {
        text-align: center;
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
    <a href="aerzte.php" class="back-link">← Zurück zu den Ärzten</a>
    <h2>Dr. med. Andrés de Roux</h2>
    
    <div class="doctor-detail">
      <img src="public/AndresDeRoux.webp" alt="Dr. med. Andrés de Roux">
      
      <div class="doctor-info">
        <h3>Facharzt für Innere Medizin, Schwerpunkt Pneumologie</h3>
        
        <p><strong>Zusatzbezeichnungen:</strong> Infektiologie und Somnologie</p>

        <h4 style="color: #004a7f; font-size: 1.1rem; margin-top: 1.5rem;">Tätigkeitsschwerpunkte</h4>
        
        <ul>
          <li><strong>Atemwegsinfektionen bei pulmonalen Grunderkrankungen:</strong> Pneumonie, chronische Atemwegsinfekte, Bronchiektasen, Tuberkulose, Lungeninfektionen durch atypische Mykobakterien</li>
          <li><strong>Impfprävention beim Erwachsenen / Senioren:</strong> Insbesondere Influenza, Pneumokokken, Pertussis</li>
          <li><strong>Schlafmedizinische Erkrankungen:</strong> Vor allem aus dem lungenfachärztlichen Bereich (Schnarchen, Tagesmüdigkeit, nächtliche Atemaussetzer), Einleitung und Überprüfung von nächtlichen Beatmungstherapien (CPAP, BIPAP, NIV)</li>
        </ul>

        <div class="links-section">
          <a href="https://pubmed.ncbi.nlm.nih.gov/?orig_db=PubMed&db=pubmed&cmd=Search&term=De+Roux+A[author]" target="_blank" rel="noopener noreferrer" class="doc-link">PubMed Publikationen</a>
          <a href="https://pneumochatbb.de/" target="_blank" rel="noopener noreferrer" class="doc-link">Pneumo QZ Berlin</a>
        </div>

        <div id="aktuelle-info-container" class="aktuelle-info">
          <h4>Aktuelles</h4>
          <p id="aktuelle-info-text">Keine aktuellen Informationen verfügbar.</p>
          <button class="edit-btn" onclick="editAktuelleInfo()">Bearbeiten</button>
        </div>
      </div>
    </div>
  </main>

  <footer>
    &copy; 2025 Praxis am Schloss Charlottenburg
  </footer>
  <script src="main.js"></script>
  <script>
    // Laden der aktuellen Informationen beim Seitenaufruf
    window.addEventListener('DOMContentLoaded', () => {
      const savedInfo = localStorage.getItem('deRoux-aktuelle-info');
      if (savedInfo) {
        document.getElementById('aktuelle-info-text').innerText = savedInfo;
      }
    });

    // Funktion zum Bearbeiten der aktuellen Informationen
    function editAktuelleInfo() {
      const currentText = document.getElementById('aktuelle-info-text').innerText;
      const newText = prompt('Aktuelle Informationen bearbeiten:', currentText);
      
      if (newText !== null) {
        document.getElementById('aktuelle-info-text').innerText = newText;
        localStorage.setItem('deRoux-aktuelle-info', newText);
        alert('Informationen gespeichert!');
      }
    }
  </script>
</body>
</html>
