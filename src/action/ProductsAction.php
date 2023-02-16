<?php

namespace crazy\action;

use crazy\models\Produit;

class ProductsAction
{

    public function execute(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $catalogue = '<div class="container mt-3">
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
                            <div class="row">
                                <div class="col">
                                    <p class="card-text">{$product->prix} €</p>
                                </div>
                                <div class="col">
                                    <p class="card-text">{$product->stock} en stock</p>
                                </div>
                            </div>
            
                            <div class="row">
                                <a href="#" class="btn btn-warning col">Ajouter au panier</a>
                                <a href="?action=productDetails&id={$product->id}" class="btn btn-primary col">Voir le produit</a>
                            </div>
                        </div>
                    </div>
                </div>
            END;
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
        }

        } else {

            $search = filter_var($_POST['bar'], FILTER_SANITIZE_SPECIAL_CHARS);
            echo $search;
            $productsSearch = [];
            $prod = Produit::where("nom", 'like', '%'.$search . '%')->get();
            foreach ($prod as $p) {
                array_push($productsSearch, $p);
            }
            $catalogue = '<div class="container mt-3">
        <div class="row">';
            foreach ($productsSearch as $pr) {
                $catalogue .= <<<END
        <div class="col">
            <div class="card" style="width: 18rem">
                <img class="card-img-top" src="src/img/{$pr->id}.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{$pr->nom}</h5>
                    <p class="card-text">$pr->description</p>
                    <a href="#" class="btn btn-primary">Ajouter au panier</a>
                </div>
            </div>
        </div>
    END;
            }
        }

        $catalogue .= '</div></div>';
        return $catalogue;
    }
}
