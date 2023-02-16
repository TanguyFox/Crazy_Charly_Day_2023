<?php

namespace crazy\action\catalog;

use crazy\models\Produit;

class ProductDetailsAction
{

    public function execute(): string
    {
        $id = $_GET['id'];
        $product = Produit::where('id', $id)->first();
        $HTML = <<<END
        <div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center ">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4"> <img id="main-image" src="src/img/{$product->id}.jpg" width="500" /></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand">{$product->lieu}</span>
                                <h5 class="text-uppercase">{$product->nom}</h5>
                                <div class="price d-flex flex-row align-items-center"> <span class="act-price">{$product->prix}€</span>
                                </div>
                            </div>
                            <h3 class="mt-4"><u>Description</u></h3>
                            <div class="about">{$product->description}</div>
                            <div class="row">
                            <div class="cart mt-4 align-items-center col">
                                <a href="?action=addToChart&redirection=productDetails&id={$product->id}"><button class="btn btn-danger text-uppercase mr-2 px-4">Ajouter au panier</button>
                            </div>
                            <div class="cart mt-4 align-items-center col">
                                <a href="?"><button class="btn btn-primary text-uppercase mr-2 px-4">Retour</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
END;
    return $HTML;
    }
}
