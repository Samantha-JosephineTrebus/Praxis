<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kontakt & Rezeptanfragen – Praxis am Schloss</title>
  <link rel="stylesheet" href="public/style.css">

<style>

    @media (min-width: 640px)  { .hero__inner { padding: 5rem 1.5rem; } }
    @media (min-width: 768px)  { .hero__inner { padding: 7rem 2rem; } }
   .kontakt-section {
    --kontakt-primary: #004a7f;
    --kontakt-primary-light: rgba(0, 74, 127, 0.1);
    --kontakt-primary-soft: rgba(0, 74, 127, 0.05);
    --kontakt-bg: #f8fafc;
    --kontakt-card: #ffffff;
    --kontakt-border: rgba(0, 74, 127, 0.15);
    --kontakt-text: #0f172a;
    --kontakt-muted: #475569;
    --kontakt-input: #f1f5f9;
    --kontakt-input-border: #cbd5e1;
    --kontakt-radius: 1rem;
    background: var(--kontakt-card);
    padding: 3rem 1rem;
  }
  @media (min-width: 640px) {
    .kontakt-section { padding: 4rem 1.5rem; }
  }
  @media (min-width: 768px) {
    .kontakt-section { padding: 6rem 1.5rem; }
  }
  .kontakt-container {
    max-width: 72rem;
    margin: 0 auto;
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
    box-shadow: 0 1px 3px rgba(15, 118, 110, 0.08);
    transition: box-shadow 0.2s ease;
  }
  .kontakt-card:hover {
    box-shadow: 0 4px 12px rgba(15, 118, 110, 0.12);
  }
  .kontakt-card-accent {
    background: var(--kontakt-primary-soft);
    border-color: rgba(15, 118, 110, 0.2);
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
  .kontakt-icon svg {
    width: 1.25rem;
    height: 1.25rem;
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
    overflow: hidden;
    background: var(--kontakt-card);
    border: 1px solid var(--kontakt-border);
    border-radius: var(--kontakt-radius);
    padding: 1.5rem;
    box-shadow: 0 10px 25px -5px rgba(15, 118, 110, 0.1);
  }
  @media (min-width: 640px) {
    .kontakt-form-wrapper { padding: 2rem; }
  }
  @media (min-width: 768px) {
    .kontakt-form-wrapper { padding: 2.5rem; }
  }
  .kontakt-form-wrapper::before {
    content: '';
    position: absolute;
    top: -6rem;
    right: -6rem;
    width: 16rem;
    height: 16rem;
    border-radius: 9999px;
    background: var(--kontakt-primary-light);
    filter: blur(40px);
    pointer-events: none;
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
  }
  @media (min-width: 640px) {
    .kontakt-form { gap: 1.5rem; }
  }
  .kontakt-field label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--kontakt-text);
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
    box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.15);
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
    padding: 0.875rem 1.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #ffffff;
    background: var(--kontakt-primary);
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
    box-shadow: 0 1px 2px rgba(15, 118, 110, 0.2);
    transition: opacity 0.2s, box-shadow 0.2s;
  }
  @media (min-width: 640px) {
    .kontakt-submit { width: auto; }
  }
  .kontakt-submit:hover {
    opacity: 0.9;
    box-shadow: 0 4px 10px rgba(15, 118, 110, 0.25);
  }
  .kontakt-submit svg {
    width: 1rem;
    height: 1rem;
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
  
  <!-- Dieser Bereich sorgt für den Hintergrund-Look wie in image_6023ba.png -->
   <section class="hero">
  <div class="hero__inner">
    <p class="hero__eyebrow">Kontakt</p>
    <h1 class="hero__title">
      Schreiben Sie uns – <span class="hero__title-accent">wir hören zu.</span>
    </h1>
    <p class="hero__lead">
      Haben Sie eine organisatorische Frage oder ein anderes Anliegen?
      Nutzen Sie unser Formular, wir melden uns zeitnah bei Ihnen zurück.
    </p>
  </div>
</section>
  <section class="kontakt-section">
  <div class="kontakt-container">
    <div class="kontakt-grid">
      <!-- Infospalte -->
      <aside class="kontakt-info">
        <div class="kontakt-card">
          <div class="kontakt-card-header">
            <span class="kontakt-icon" aria-hidden="true">
              <!-- Clock -->
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
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
              <!-- ShieldAlert -->
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
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
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"/><path d="m21.854 2.147-10.94 10.939"/></svg>
            </button>
          </div>
        </form>
      </div>
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