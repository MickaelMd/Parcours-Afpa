import React from "react";

function Navbar() {
  return (
    <nav className="bg-gray-900 text-white fixed top-0 w-full z-50 shadow-md">
      <div className="container mx-auto flex justify-between items-center p-4">
        <button
          className="text-white focus:outline-none md:hidden"
          aria-controls="navbar"
          aria-expanded="false"
        >
          <span className="material-icons">menu</span>
        </button>
        <div className="hidden md:flex md:flex-grow justify-center" id="navbar">
          <ul className="flex space-x-4">
            <li>
              <a href="/" className="text-white hover:text-gray-300">
                Accueil
              </a>
            </li>
            <li>
              <a href="/disc/1" className="text-white hover:text-gray-300">
                Details
              </a>
            </li>
            <li>
              <a href="/addform/" className="text-white hover:text-gray-300">
                Ajouter
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
}

export default Navbar;
