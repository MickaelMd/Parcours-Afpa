import React, { useState, useEffect } from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Navbar from "./components/Navbar";
import DiscList from "./components/DiscList";
import DiscDetails from "./components/DiscDetails";
import NotFound from "./components/NotFound";
import axios from "axios";
import Footer from "./components/Footer";

function App() {
  const [discs, setDiscs] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get("http://localhost:5000/api/discs");
        setDiscs(response.data);
      } catch (error) {
        console.error("Erreur lors de la récupération des disques :", error);
      }
    };

    fetchData();
  }, []);

  return (
    <Router>
      <Navbar />
      <Routes>
        <Route path="/" element={<DiscList discs={discs} />} />
        <Route path="/disc/:discId" element={<DiscDetails />} />{" "}
        {/* Nouvelle route pour les détails du disque */}
        <Route path="*" element={<NotFound />} />
      </Routes>
      <Footer />
    </Router>
  );
}

export default App;
