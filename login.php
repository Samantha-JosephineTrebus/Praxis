<?php
require_once 'config.php';

if (!$requestUsesHttps && !$requestIsLocalhost) {
  http_response_code(403);
  exit('Bitte öffnen Sie die Anmeldung über HTTPS.');
}

// Wenn bereits eingeloggt, zur Admin-Seite
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error = '';

// Login-Verarbeitung
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = is_string($_POST['username'] ?? null) ? $_POST['username'] : '';
  $password = is_string($_POST['password'] ?? null) ? $_POST['password'] : '';

  if (!$requestUsesHttps && !$requestIsLocalhost) {
    http_response_code(400);
    $error = 'Die Anmeldung ist nur über eine HTTPS-Verbindung möglich.';
  } elseif (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    http_response_code(403);
    $error = 'Sitzung abgelaufen. Bitte laden Sie die Seite neu.';
  } elseif (verifyLoginCredentials($username, $password, 'admin_username', 'admin_password_hash')) {
    session_regenerate_id(true);
    unset($_SESSION['csrf_token']);
    $_SESSION['loggedIn'] = true;
    $_SESSION['role'] = 'admin';
    $_SESSION['username'] = $username;
    header('Location: admin.php');
    exit;
  } elseif (verifyLoginCredentials($username, $password, 'staff_username', 'staff_password_hash')) {
    session_regenerate_id(true);
    unset($_SESSION['csrf_token']);
    $_SESSION['loggedIn'] = true;
    $_SESSION['role'] = 'staff';
    $_SESSION['username'] = $username;
    header('Location: index.php');
    exit;
    } else {
        $error = '❌ Falsche Anmeldedaten. Bitte versuchen Sie es erneut.';
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Anmelden – Praxis am Schloss</title>
  <link rel="stylesheet" href="public/style.css">
  <style>
    .login-container {
      max-width: 400px;
      margin: 5rem auto;
      padding: 2rem;
      background: white;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0, 74, 127, 0.15);
    }
    
    .login-container h2 {
      text-align: center;
      color: #004a7f;
      margin-bottom: 1.5rem;
    }
    
    .login-container input {
      width: 100%;
      padding: 0.8rem;
      margin-bottom: 1rem;
      border: 2px solid #cde7ff;
      border-radius: 8px;
      font-size: 1rem;
    }
    
    .login-container input:focus {
      border-color: #0071c2;
      outline: none;
    }
    
    .login-container button {
      width: 100%;
      padding: 0.8rem;
      background: linear-gradient(135deg, #004a7f, #0071c2);
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.2s;
    }
    
    .login-container button:hover {
      transform: translateY(-2px);
    }
    
    .error-msg {
      color: #d32f2f;
      padding: 1rem;
      background: #ffebee;
      border-radius: 8px;
      margin-bottom: 1rem;
      text-align: center;
    }
  </style>
</head>
<body>
  <header>
     <a href="/" class="logo praxis-logo">
  <span class="praxis-logo__title">Pneumologische Praxis</span>
  <span class="praxis-logo__subtitle">am Schloss Charlottenburg</span>
</a>
  </header>

  <main>
    <div class="login-container">
      <h2>🔐 Anmelden</h2>
      
      <?php if ($error): ?>
        <div class="error-msg"><?php echo htmlspecialchars($error, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></div>
      <?php endif; ?>
      
      <form method="POST" action="login.php">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(csrfToken(), ENT_QUOTES, 'UTF-8'); ?>">
        <input 
          type="text" 
          name="username" 
          placeholder="Benutzername" 
          required
          autofocus
        >
        <input 
          type="password" 
          name="password" 
          placeholder="Passwort" 
          required
        >
        <button type="submit">Anmelden</button>
      </form>
      
      <p style="text-align: center; margin-top: 1.5rem;">
        <a href="index.php" style="color: #004a7f; text-decoration: none;">← Zurück zur Startseite</a>
      </p>
    </div>
  </main>
  <?php include 'includes/footer.php'; ?>
</body>
</html>
