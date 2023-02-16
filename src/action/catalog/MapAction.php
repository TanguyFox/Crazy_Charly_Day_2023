<?php

namespace crazy\action\catalog;

use crazy\models\Produit;

class MapAction
{

    public function execute(): string
    {
        $catalogue  = '<div class="container"><div id="map"></div></div>';

        // add leaflet script
        $catalogue .= '<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>';

        // script for map creation using leaflet
        $catalogue .= '<script>';

        $catalogue .= <<<END
            document.getElementById("map").style.height = window.innerHeight + "px";
            var map = L.map("map").setView([48.856614, 2.3522219], 13);
            navigator.geolocation.getCurrentPosition((position) => {
                map.setView([position.coords.latitude, position.coords.longitude], 13);
            });
            var osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
            });
            osm.addTo(map);
        END;

        $produits = Produit::All();
        foreach ($produits as $produit) {
            $catalogue .= <<<END
                var marker = L.marker([$produit->latitude, $produit->longitude]).addTo(map);
                marker.bindPopup(`<b>$produit->nom</b><br>$produit->lieu<br><a href='index.php?action=productDetails&id=$produit->id'>Voir le produit</a>`);
            END;
        }

        $catalogue .= '</script>';

        return $catalogue;
    }
}
