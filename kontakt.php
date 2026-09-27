<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kontakt & Rezeptanfragen – Praxis am Schloss</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

    @media (min-width: 640px)  { .hero__inner { padding: 5rem 1.5rem; } }
    @media (min-width: 768px)  { .hero__inner { padding: 7rem 2rem; } }
   .kontakt-section {
    --kontakt-primary: #004a7f;
    --kontakt-primary-light: rgba(0, 74, 127, 0.1);
    --kontakt-primary-soft: rgba(0, 74, 127, 0.05);
    --kontakt-bg: #f5f7fb;
    --kontakt-card: #ffffff;
    --kontakt-border: rgba(0, 74, 127, 0.15);
    --kontakt-text: #0f172a;
    --kontakt-muted: #475569;
    --kontakt-input: #f5f7fb;
    --kontakt-input-border: #cde7ff;
    --kontakt-radius: 12px;
    background: transparent;
    padding: 2.5rem 1rem 4rem;
  }
  @media (min-width: 640px) {
    .kontakt-section { padding-right: 1.5rem; padding-left: 1.5rem; }
  }
  .kontakt-container {
    max-width: 72rem;
    margin: 0 auto;
  }
  .kontakt-section-heading {
    margin: 0 0 1.5rem;
    color: var(--kontakt-primary);
    font-family: Georgia, "Times New Roman", serif;
    font-size: 2rem;
    font-weight: 600;
    text-align: center;
  }
  .kontakt-article {
    margin: 0;
    padding: 0;
    border: 0;
    border-radius: 0;
    background: transparent;
    box-shadow: none;
  }
  .kontakt-location-article {
    position: relative;
    left: 50%;
    width: 100vw;
    margin: 3rem 0 0 -50vw;
    padding: 2rem 1.5rem 3rem;
    border: 0;
    border-radius: 0;
    background: #ffffff;
    box-shadow: none;
    scroll-margin-top: 110px;
  }
  .kontakt-location-content {
    max-width: 72rem;
    margin: 0 auto;
  }
  .kontakt-location-heading {
    margin-top: 0;
  }
  .kontakt-location-article .kontakt-section-heading {
    margin-bottom: 1.5rem;
  }
  .kontakt-location {
    margin: 0;
  }
  .kontakt-location-heading {
    scroll-margin-top: 110px;
  }
  .kontakt-grid {
    display: grid;
    gap: 2rem;
  }
  @media (min-width: 1024px) {
    .kontakt-grid {
      grid-template-columns: 2fr 3fr;
      gap: 3rem;
    }
  }
  /* Infokarten */
  .kontakt-info {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }
  .kontakt-card {
    background: var(--kontakt-card);
    border: 1px solid var(--kontakt-border);
    border-radius: var(--kontakt-radius);
    padding: 1.25rem;
    box-shadow: 0 6px 20px rgba(0, 74, 127, 0.08);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .kontakt-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 74, 127, 0.12);
  }
  .kontakt-card-accent {
    background: var(--kontakt-primary-soft);
    border-color: rgba(0, 74, 127, 0.2);
  }
  .kontakt-card-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }
  .kontakt-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 2.5rem;
    height: 2.5rem;
    flex-shrink: 0;
    border-radius: 9999px;
    background: var(--kontakt-primary-light);
    color: var(--kontakt-primary);
  }
  .kontakt-icon i {
    width: 1.25rem;
    height: 1.25rem;
    font-size: 1.25rem;
  }
  .kontakt-card h2 {
    font-family: 'Georgia', 'Times New Roman', serif;
    font-size: 1.125rem;
    color: var(--kontakt-text);
    margin: 0;
  }
  .kontakt-card p {
    margin: 0.75rem 0 0;
    font-size: 0.875rem;
    line-height: 1.65;
    color: var(--kontakt-muted);
  }
  .kontakt-card strong {
    color: var(--kontakt-text);
    font-weight: 600;
  }
  /* Formular */
  .kontakt-form-wrapper {
    position: relative;
    background: var(--kontakt-card);
    border: 1px solid var(--kontakt-border);
    border-radius: var(--kontakt-radius);
    padding: 1.5rem;
    box-shadow: 0 8px 25px rgba(0, 74, 127, 0.1);
  }
  @media (min-width: 640px) {
    .kontakt-form-wrapper { padding: 2rem; }
  }
  @media (min-width: 768px) {
    .kontakt-form-wrapper { padding: 2.5rem; }
  }
  .kontakt-success {
    position: relative;
    text-align: center;
    padding: 2.5rem 0;
  }
  @media (min-width: 640px) {
    .kontakt-success { padding: 3.5rem 0; }
  }
  .kontakt-success-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 3.5rem;
    height: 3.5rem;
    border-radius: 9999px;
    background: var(--kontakt-primary-light);
    color: var(--kontakt-primary);
  }
  .kontakt-success h3 {
    font-family: 'Georgia', 'Times New Roman', serif;
    font-size: 1.5rem;
    color: var(--kontakt-text);
    margin: 1.25rem 0 0;
  }
  .kontakt-success p {
    max-width: 28rem;
    margin: 0.5rem auto 0;
    font-size: 0.875rem;
    color: var(--kontakt-muted);
  }
  .kontakt-form {
    position: relative;
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
    width: 100%;
    max-width: none;
    margin: 0;
    padding: 0;
    border: 0;
    border-radius: 0;
    background: transparent;
    box-shadow: none;
    backdrop-filter: none;
  }
  @media (min-width: 640px) {
    .kontakt-form { gap: 1.5rem; }
  }
  .kontakt-field label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--kontakt-primary);
  }
  .kontakt-field input,
  .kontakt-field textarea {
    width: 100%;
    margin-top: 0.5rem;
    padding: 0.875rem 1rem;
    font-size: 0.875rem;
    color: var(--kontakt-text);
    background: var(--kontakt-input);
    border: 1px solid var(--kontakt-input-border);
    border-radius: 0.5rem;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    box-sizing: border-box;
  }
  .kontakt-field textarea {
    resize: vertical;
    min-height: 8rem;
  }
  .kontakt-field input:focus,
  .kontakt-field textarea:focus {
    border-color: var(--kontakt-primary);
    box-shadow: 0 0 0 3px rgba(0, 74, 127, 0.15);
  }
  .kontakt-error {
    margin-top: 0.375rem;
    font-size: 0.75rem;
    font-weight: 500;
    color: #b91c1c;
  }
  .kontakt-form-footer {
    display: flex;
    flex-direction: column-reverse;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1rem;
    padding-top: 0.5rem;
  }
  @media (min-width: 640px) {
    .kontakt-form-footer {
      flex-direction: row;
      align-items: center;
    }
  }
  .kontakt-hint {
    font-size: 0.75rem;
    color: var(--kontakt-muted);
    margin: 0;
  }
  .kontakt-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    padding: 0.9rem 1.6rem;
    font-size: 0.9rem;
    font-weight: 600;
    color: #ffffff;
    background: linear-gradient(135deg, #004a7f, #0071c2);
    border: none;
    border-radius: 12px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0, 74, 127, 0.25);
    transition: all 0.3s ease;
  }
  @media (min-width: 640px) {
    .kontakt-submit { width: auto; }
  }
  .kontakt-submit:hover {
    background: linear-gradient(135deg, #005c9a, #0088e0);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 74, 127, 0.35);
  }

  .kontakt-location {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
    margin-top: 2rem;
    scroll-margin-top: 110px;
  }
  @media (min-width: 900px) {
    .kontakt-location {
      grid-template-columns: 2fr 3fr;
      gap: 2rem;
    }
  }
  .kontakt-location-card {
    min-width: 0;
    padding: 1.5rem;
    border: 1px solid var(--kontakt-border);
    border-radius: var(--kontakt-radius);
    background: var(--kontakt-card);
    box-shadow: 0 8px 25px rgba(0, 74, 127, 0.08);
  }
  .kontakt-location-card h2 {
    margin: 0 0 1rem;
    color: var(--kontakt-primary);
    font-family: Georgia, "Times New Roman", serif;
    font-size: 1.25rem;
  }
  .kontakt-address {
    margin: 0;
    color: var(--kontakt-text);
    font-size: 1rem;
    line-height: 1.6;
  }
  .kontakt-transit-title {
    margin: 1.25rem 0 0.5rem;
    color: var(--kontakt-primary);
    font-weight: 600;
  }
  .kontakt-transit-list {
    display: grid;
    gap: 0.45rem;
    margin: 0;
    padding: 0;
    list-style: none;
    color: var(--kontakt-muted);
    line-height: 1.5;
  }
  .kontakt-transit-list li {
    display: flex;
    align-items: flex-start;
    gap: 0.65rem;
  }
  .kontakt-transit-list i {
    flex: 0 0 1.15rem;
    margin-top: 0.2rem;
    color: var(--kontakt-primary);
    text-align: center;
  }
  .kontakt-location-map {
    padding: 0;
    overflow: hidden;
  }
  .kontakt-location-map iframe {
    display: block;
    width: 100%;
    min-height: 320px;
    height: 100%;
    border: 0;
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
      </ul>
    </nav>
  </header>

 <main class="container">
  
  <section class="hero page-intro-card">
  <div class="hero__inner">
    <p class="hero__eyebrow">Kontakt & Anfahrt</p>
    <h1 class="hero__title">
      Alle Wege zu unserer Praxis
    </h1>
    <p class="hero__lead">
      Ob Fragen zu unserer Praxis oder zur Terminvereinbarung, wir helfen Ihnen gerne weiter. Informieren Sie sich über unsere Kontaktmöglichkeiten und erfahren Sie, wie Sie uns vor Ort erreichen. Alle wichtigen Informationen zu Ihrer Anfahrt und unserem Standort finden Sie auf dieser Seite.
    </p>
  </div>
</section>
  <section class="kontakt-section">
  <div class="kontakt-container">
    <article class="kontakt-article" aria-labelledby="kontakt-heading">
    <h2 id="kontakt-heading" class="kontakt-section-heading">Kontakt</h2>
    <div class="kontakt-grid">
      <!-- Infospalte -->
      <aside class="kontakt-info">
        <div class="kontakt-card">
          <div class="kontakt-card-header">
            <span class="kontakt-icon" aria-hidden="true">
              <i class="fa-solid fa-clock"></i>
            </span>
            <h2>Antwortzeit</h2>
          </div>
          <p>
            Wir geben unser Bestes, Ihre Anliegen zügig zu bearbeiten. Aufgrund des
            hohen Aufkommens rechnen Sie bitte mit einer <strong>Antwortzeit von 1–2 Werktagen</strong>.
          </p>
        </div>
        <div class="kontakt-card kontakt-card-accent">
          <div class="kontakt-card-header">
            <span class="kontakt-icon" aria-hidden="true">
              <i class="fa-solid fa-circle-info"></i>
            </span>
            <h2>Wichtiger Hinweis</h2>
          </div>
          <p>
            Wir können <strong>keine medizinische Beratung per Nachricht</strong> anbieten.
            Bei akuten Beschwerden vereinbaren Sie bitte einen regulären Termin.
          </p>
        </div>
      </aside>
      <!-- Formularspalte -->
      <div class="kontakt-form-wrapper">
        <!-- Design-only contact form (no server-side logic) -->
        <form method="POST" action="#" novalidate class="kontakt-form">
          <div class="kontakt-field">
            <label for="name">Name</label>
            <input id="name" type="text" name="name" placeholder="Ihr vollständiger Name" required />
          </div>

          <div class="kontakt-field">
            <label for="email">E-Mail</label>
            <input id="email" type="email" name="email" placeholder="name@beispiel.de" required />
          </div>

          <div class="kontakt-field">
            <label for="message">Nachricht</label>
            <textarea id="message" name="message" rows="6" placeholder="Wie können wir Ihnen helfen?" required></textarea>
          </div>

          <div class="kontakt-form-footer">
            <p class="kontakt-hint">Ihre Angaben werden vertraulich behandelt.</p>
            <button type="submit" class="kontakt-submit">
              Nachricht senden
              <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
    </article>

    <article id="anfahrt" class="kontakt-location-article" aria-labelledby="anfahrt-heading">
      <div class="kontakt-location-content">
        <h2 id="anfahrt-heading" class="kontakt-section-heading kontakt-location-heading">Anfahrt</h2>
        <div class="kontakt-location">
      <section class="kontakt-location-card" aria-labelledby="kontakt-location-title">
        <h2 id="kontakt-location-title">Unsere Adresse</h2>
        <p class="kontakt-address">
          Pneumologische Praxis am Schloss Charlottenburg<br>
          Spandauer Damm 3<br>
          14059 Berlin<br>
          (Schloss Charlottenburg / Luisenplatz)
        </p>
        <p class="kontakt-transit-title">So erreichen Sie uns</p>
        <ul class="kontakt-transit-list">
          <li><i class="fa-solid fa-bus-simple" aria-hidden="true"></i><span>Bus M45, 109 oder 309 bis Luisenplatz</span></li>
          <li><i class="fa-solid fa-train-tram" aria-hidden="true"></i><span>S-Bahn S5 oder S7 bis Charlottenburg, ca. 10 Minuten zu Fuß</span></li>
          <li><i class="fa-solid fa-train-subway" aria-hidden="true"></i><span>U-Bahn U7 bis Richard-Wagner-Platz, ca. 12 Minuten zu Fuß</span></li>
        </ul>
      </section>

      <div class="kontakt-location-card kontakt-location-map">
        <iframe
          title="Karte zur Pneumologischen Praxis am Schloss Charlottenburg"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2427.7863180895724!2d13.296178077029818!3d52.51920603628782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47a851259a9f7a71%3A0x8278488b430ebc2e!2sPneumologische%20Praxis%20am%20Schloss%20Charlottenburg%20Dr.%20med.%20Andr%C3%A9s%20de%20Roux%20und%20Timo%20Wei%C3%9F!5e0!3m2!1sde!2sde!4v1761044269751!5m2!1sde!2sde"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          allowfullscreen>
        </iframe>
      </div>
        </div>
      </div>
    </article>
  </div>
</section>
</main>

  <?php include 'includes/footer.php'; ?>
  <script src="main.js"></script>
</body>
</html>