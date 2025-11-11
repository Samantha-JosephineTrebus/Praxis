const express = require("express");
const session = require("express-session");
const path = require("path");

const app = express();
const PORT = 3000;

// Session-Einstellungen
app.use(session({
  secret: "geheimer_schluessel",
  resave: false,
  saveUninitialized: true
}));

// Formulardaten lesen
app.use(express.urlencoded({ extended: true }));

// Statische Dateien aus dem Ordner "public" bereitstellen
app.use(express.static(path.join(__dirname, "public")));

// === ROUTEN ===

// Login-Seite (GET)
app.get("/login", (req, res) => {
  res.sendFile(path.join(__dirname, "public", "login.html"));
});

// Login-Daten prüfen (POST)
app.post("/login", (req, res) => {
  const { username, password } = req.body;

  if (username === "admin" && password === "1234") {
    req.session.loggedIn = true;
    res.redirect("/adminHome.html");
  } else if (username === "mitarbeiter" && password === "abcd") {
    req.session.loggedIn = true;
    res.redirect("/mitarbeiterHome.html"); // andere Seite
  } else {
    res.send("❌ Falsche Anmeldedaten. <a href='/login'>Zurück</a>");
  }
});

// Kalenderseite nur für eingeloggte Nutzer
app.get("/adminHome.html", (req, res) => {
  if (req.session.loggedIn) {
    res.sendFile(path.join(__dirname, "public", "adminHome.html"));
  } else {
    res.redirect("/login");
  }
});

// Fallback auf Startseite
app.get("/", (req, res) => {
  res.sendFile(path.join(__dirname, "public", "index.html"));
});

app.listen(PORT, () => console.log(`✅ Server läuft auf Port ${PORT}`));
