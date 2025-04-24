const express = require("express");
const mysql = require("mysql2");
const cors = require("cors");
const dotenv = require("dotenv");

dotenv.config({ path: "../../../../.env" });
// dotenv.config();

const app = express();
app.use(cors());
app.use(express.json());

// Configurer la connexion à la base de données
const db = mysql.createConnection({
  host: process.env.DB_HOST,
  port: process.env.DB_PORT,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_NAME_REACT_VELET,
});

db.connect((err) => {
  if (err) {
    console.error("Erreur de connexion à la base de données :", err.message);
  } else {
    console.log("Connecté à la base de données MariaDB.");
  }
});

// Exemple de route pour récupérer les disques
app.get("/api/discs", (req, res) => {
  const sql = `SELECT * FROM disc JOIN artist ON disc.artist_id = artist.artist_id`;

  db.query(sql, (err, results) => {
    if (err) {
      res
        .status(500)
        .json({ error: "Erreur lors de la récupération des disques" });
    } else {
      res.json(results);
    }
  });
});
// Route pour récupérer les détails d'un disque spécifique par son ID
app.get("/api/discs/:id", (req, res) => {
  const discId = req.params.id; // Récupérer l'ID du disque à partir des paramètres de la requête
  const sql = `
    SELECT * 
    FROM disc 
    JOIN artist ON disc.artist_id = artist.artist_id 
    WHERE disc.disc_id = ?
  `;

  db.query(sql, [discId], (err, results) => {
    if (err) {
      res
        .status(500)
        .json({ error: "Erreur lors de la récupération du disque" });
    } else if (results.length === 0) {
      res.status(404).json({ error: "Disque non trouvé" });
    } else {
      res.json(results[0]); // Envoyer le premier résultat car il s'agit d'un disque unique
    }
  });
});

// Démarrer le serveur
const PORT = process.env.PORT || 5000;
app.listen(PORT, () => {
  console.log(`Serveur backend démarré sur le port ${PORT}`);
});
