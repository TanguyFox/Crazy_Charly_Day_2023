<?php

namespace crazy\action;

use crazy\models\Produit;

class ProductsAction
{

    public function execute() : string
    {

        $catalogue  = '<div class="container mt-3">
        <div class="row">';
        $products = Produit::all();
        foreach ($products as $product) {
            $catalogue .= <<<END
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

        $catalogue .= '</div></div>';
        return $catalogue;
    }
}