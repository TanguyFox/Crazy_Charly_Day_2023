<?php

require 'header.php';

echo '<div class="container my-3">
<div class="row align-items-center">';

use crazy\models\Produit;
$products = Produit::all();
foreach ($products as $product) {
    echo <<<END
        <div class="col">
            <div class="card" style="width: 18rem">
                <img class="card-img-top" src="src/img/{$product->id}.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{$product->nom}</h5>
                    <p class="card-text">$product->description</p>
                    <a href="#" class="btn btn-primary">Ajouter au panier</a>
                </div>
            </div>
        </div>
    END;
}

echo '</div></div>';

require 'footer.php';