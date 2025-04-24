import React from "react";
import { Link } from "react-router-dom";

function DiscList({ discs }) {
  return (
    <div className="container mt-20 mx-auto p-4">
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        {discs.map((disc) => (
          <div
            key={disc.disc_id}
            className="bg-white shadow-lg rounded-lg overflow-hidden"
          >
            <div className="flex">
              <div className="w-1/3">
                <img
                  src={`/img/pictures/${disc.disc_picture}`}
                  alt={disc.disc_title}
                  className="object-cover w-full h-full"
                />
              </div>
              <div className="w-2/3 p-4">
                <h5 className="text-lg font-bold text-gray-900">
                  {disc.disc_title}
                </h5>
                <p className="text-gray-700">{disc.artist_name}</p>
                <p className="text-gray-600">Label: {disc.disc_label}</p>
                <p className="text-gray-600">Year: {disc.disc_year}</p>
                <p className="text-gray-600">Genre: {disc.disc_genre}</p>
                <div className="mt-4 flex justify-center">
                  <Link
                    to={`/disc/${disc.disc_id}`} // Utilisation de Link pour une redirection React
                    className="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                  >
                    Détails
                  </Link>
                </div>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}

export default DiscList;
