import React, { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import axios from "axios";

function DiscDetails() {
  const { discId } = useParams();
  const [disc, setDisc] = useState(null);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchDiscDetails = async () => {
      try {
        const response = await axios.get(
          `http://localhost:5000/api/discs/${discId}`
        );
        if (response.data) {
          setDisc(response.data);
        } else {
          setError("Le disque n'existe pas.");
        }
      } catch (error) {
        console.error(
          "Erreur lors de la récupération des détails du disque :",
          error
        );
        setError("Erreur lors de la récupération des détails du disque.");
      }
    };

    fetchDiscDetails();
  }, [discId]);

  if (error) return <p>{error}</p>;
  if (!disc) return <p>Chargement des détails du disque...</p>;

  return (
    <>
      <section className="text-white">
        <div className="container mx-auto p-4 mt-20">
          <h2 className="text-2xl font-bold mb-4">{disc.disc_title}</h2>
          <img
            src={`/img/pictures/${disc.disc_picture}`}
            alt={disc.disc_title}
            className="w-full max-w-md mb-4"
          />
          <p>Artiste : {disc.artist_name}</p>
          <p>Label : {disc.disc_label}</p>
          <p>Année : {disc.disc_year}</p>
          <p>Genre : {disc.disc_genre}</p>
          <p>Prix : {disc.disc_price} €</p>
        </div>
      </section>
    </>
  );
}

export default DiscDetails;
