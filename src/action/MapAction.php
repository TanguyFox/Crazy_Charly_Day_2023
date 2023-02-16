<?php

namespace crazy\action;

use crazy\models\Produit;

class MapAction
{

    public function execute(): string
    {

        $catalogue  = '<div class="container mt-3">';
        
        // script for map creation using leaflet
        $catalogue .= '<script>';
        $catalogue .= 'var mymap = L.map("mapid").setView([48.856614, 2.3522219], 13);';
        $catalogue .= 'var osm = L.tileLayer("https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}", {';
        $catalogue .= 'attribution: "Map data &copy; <a href=\"https://www.openstreetmap.org/\">OpenStreetMap</a> contributors, <a href=\"https://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>, Imagery © <a href=\"https://www.mapbox.com/\">Mapbox</a>",';
        $catalogue .= 'maxZoom: 18,';
        $catalogue .= 'id: "mapbox/streets-v11",';
        $catalogue .= 'tileSize: 512,';
        $catalogue .= 'zoomOffset: -1});';
        $catalogue .= 'osm.addTo(mymap);';
        $catalogue .= '</script>';

        $catalogue .= '</div>';

        // add leaflet script
        $catalogue .= '<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>';

        return $catalogue;
    }
}
