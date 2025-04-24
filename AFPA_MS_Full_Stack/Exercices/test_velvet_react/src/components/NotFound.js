import React from "react";

function NotFound() {
  return (
    <div className="text-center mt-20">
      <h1 className="text-4xl font-bold text-red-500">404</h1>
      <p className="text-gray-700">Page non trouvée.</p>
      <a href="/" className="text-blue-500 underline">
        Retour à l'accueil
      </a>
    </div>
  );
}

export default NotFound;
