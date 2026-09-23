<?php $footerPage = basename($_SERVER['PHP_SELF']); ?>
<footer class="site-footer">
  <div class="footer-top">
    <div class="footer-col">
      <h3>Pneumologische Praxis am Schloss Charlottenburg</h3>
      <p class="doctor-names">
        Dr. med. Andrés de Roux &<br>
        Timo Weiß
      </p>
    </div>

    <div class="footer-col footer-contact">
      <div class="footer-item">
        <i class="fa-solid fa-location-dot"></i>
        <span>Spandauer Damm 3<br>14059 Berlin-Charlottenburg</span>
      </div>
      <div class="footer-item">
        <i class="fa-solid fa-phone"></i>
        <a href="tel:+4930341611">030 / 341 61 18</a>
      </div>
    </div>

    <div class="footer-col">
      <h4>Schnellzugriff</h4>
      <ul class="footer-links">
        <li><a href="index.php" class="<?php echo $footerPage === 'index.php' ? 'active' : ''; ?>">Startseite</a></li>
        <li><a href="https://www.doctolib.de/praxis/berlin/pneumologische-praxis-am-schloss-charlottenburg-dr-med-andres-de-roux-und-timo-weiss/booking/patient-insurance-sector?specialityId=1143&telehealth=false&placeId=practice-44058&profile_skipped=true&bookingFunnelSource=external_referral" target="_blank" rel="noopener noreferrer">Onlinetermine</a></li>
        <li><a href="leistung.php" class="<?php echo $footerPage === 'leistung.php' ? 'active' : ''; ?>">Leistungen</a></li>
        <li><a href="vorbereitung.php" class="<?php echo $footerPage === 'vorbereitung.php' ? 'active' : ''; ?>">Vor Ihrem Besuch</a></li>
        <li><a href="aerzte.php" class="<?php echo $footerPage === 'aerzte.php' ? 'active' : ''; ?>">Ärzte</a></li>
        <li><a href="kontakt.php" class="<?php echo $footerPage === 'kontakt.php' ? 'active' : ''; ?>">Kontakt</a></li>
        <li><a href="finden.php" class="<?php echo $footerPage === 'finden.php' ? 'active' : ''; ?>">Anfahrt</a></li>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <span>&copy; 2026 Pneumologische Praxis am Schloss Charlottenburg</span>
    <span><a href="impressum.php">Impressum</a> &middot; <a href="datenschutz.php">Datenschutz</a></span>
  </div>
</footer>
