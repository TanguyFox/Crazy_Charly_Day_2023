<?php

namespace crazy\action;

use crazy\models\Produit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\ArrayObject;

class ProductsAction
{

    public function execute(): string
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $products = Produit::all();
            $catalogue = <<<END
                        <form class="d-flex" method='post' action='?action=catalogue'>
                        <input class="form-control me-2" type="search" name="search" placeholder="Produit" aria-label="Search">
                        <label>Trier par</label>
                        <select class="form-select" name="ville">
                            <option value="none" selected> </option>
                            <option value="Santeny">Santeny</option>
                            <option value="Villeurbanne">Villeurbanne</option>
                            <option value="Nancy">Nancy</option>
                            <option value="Lucey">Lucey</option>
                            <option value="Wiwersheim">Wiwercheim</option>
                            <option value="Pont à Mousson">Pont à Mousson</option>
                            <option value="Chauny">Chauny</option>
                            <option value="Annecy">Annecy</option>
                            <option value="Les Pennes-Mirabeau">Les Pennes-Mirabeau</option>
                            <option value="Leyr">Leyr</option>
                            <option value="Sarralbe">Sarralbe</option>
                            <option value="Goviller">Goviller</option>
                        </select>
                        <select class='form-select' name="categ">
                            <option value="none" selected> </option>
                            <option value="1">Epicerie</option>
                            <option value="2">Boissons</option>
                            <option value="3">Droguerie</option>
                            <option value="4">Cosmétiques</option>
                            <option value="5">Produits frais</option>
                        </select>
                        <button class="btn btn-outline-success" type="submit">Rechercher</button>
                    </form>
            END;
            $catalogue .= '<div class="container mt-3">
        <div class="row">';
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
        } else {




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
            echo $ville;
            echo $categ;
            echo $search;
        }
        $catalogue .= '</div></div>';

        return $catalogue;
    }
}
