<?php

namespace crazy\action\catalog;

use crazy\models\Produit;
use crazy\models\Users;

class ProductsAction
{

    public function execute(): string
    {
        if (isset($_GET['confirmChart'])){
            $user_id = $_SESSION['user'];
            $user = Users::where('id', $user_id)->first();
            //remove all products in user cart;
            $user->products()->detach();
        }
        $catalogue = <<<END

        <div class="container mt-3">
        <div class="row">
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
                        <button class="btn btn-outline-success" type="submit" name="submit">Valider</button>
                    </form>
        
END;

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $products = Produit::all();
            $catalogue .= '<div class="row">';

            foreach ($products as $product) {
                $catalogue .= <<<END
                  <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card w-auto h-auto m-2">
                        <img class="card-img-top" src="src/img/{$product->id}.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{$product->nom}</h5>
                            <p class="card-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-geo-alt-fill me-1 mb-1" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                </svg>$product->lieu</p>
                            <div class="row">
                                <div class="col">
                                    <p class="card-text align-content-center text-success mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-tags-fill" viewBox="0 0 16 16" style="margin-right: 0.3rem">
                                        <path d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                        <path d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043-7.457-7.457z"/>
                                        </svg>{$product->prix} €</p>
                                </div>
                            </div>
            
                            <div class="row">
                                <a href="?action=addToChart&id={$product->id}" class="btn btn-warning col d-flex align-items-center justify-content-center mx-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart4 me-0.5" viewBox="0 0 16 16">
                                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                                    </svg>Ajouter au panier</a>
                                <a href="?action=productDetails&id={$product->id}" class="btn btn-primary col d-flex align-items-center justify-content-center mx-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-eye me-0.5" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>Voir le produit</a>
                            </div>
                        </div>
                    </div>
                </div>
            END;
            }
        } else {

            if(isset($_POST['submit'])){
                if ($_POST['ville'] != "none" && $_POST['categ'] != "none" && $_POST['search'] != ""){
                    $ville = filter_var($_POST['ville']);
                    $categorie = filter_var($_POST['categ']);
                    $search = filter_var($_POST['search']);
                    $prod = Produit::where('lieu', 'like', '%' . $ville . '%')->where('categorie', 'like', '%' . $categorie . '%')->where('nom', 'like', '%' . $search . '%')->get();
                } else if ($_POST['ville'] != "none" && $_POST['categ'] != "none"){
                    $ville = filter_var($_POST['ville']);
                    $categorie = filter_var($_POST['categ']);
                    $prod = Produit::where('lieu', 'like', '%' . $ville . '%')->where('categorie', 'like', '%' . $categorie . '%')->get();
                }else if ($_POST['search'] != ""){
                    $search = filter_var($_POST['search']);
                    $prod = Produit::where('nom', 'like', '%' . $search . '%')->get();
                } else if ($_POST['ville'] != "none"){
                    $ville = filter_var($_POST['ville']);
                    $prod = Produit::where('lieu', 'like', '%' . $ville . '%')->get();
                } else if ($_POST['categ'] != "none "){
                    $categorie = filter_var($_POST['categorie']);
                    $prod = Produit::where('categorie', 'like', '%' . $categorie . '%')->get();
                }
            } else {
                $search = filter_var($_POST['search']);
                $prod = Produit::where('nom', 'like', '%' . $search . '%')->get();
            }

            if (count($prod) == 0) {
                $catalogue .= <<<END
                    <div class="col-12">
                        <div class="alert alert-danger my-4" role="alert">
                            Aucun produit ne correspond à votre recherche.
                        </div>
                    </div>
                END;
            } else {
                $catalogue .= <<<END
                    <div class="col-12">
                        <div class="alert alert-success my-4" role="alert">
                            Voici les produits correspondant à votre recherche.
                        </div>
                    </div>
                END;
            }

            $productsSearch = [];
            foreach ($prod as $p) {
                array_push($productsSearch, $p);
            }

            foreach ($productsSearch as $pr) {
                $catalogue .= <<<END
                    <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card w-auto h-auto m-2">
                        <img class="card-img-top" src="src/img/{$pr->id}.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{$pr->nom}</h5>
                            <p class="card-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-geo-alt-fill me-1 mb-1" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                </svg>$pr->lieu</p>
                            <div class="row">
                                <div class="col">
                                    <p class="card-text align-content-center text-success mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-tags-fill" viewBox="0 0 16 16" style="margin-right: 0.3rem">
                                        <path d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                        <path d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043-7.457-7.457z"/>
                                        </svg>{$pr->prix} €</p>
                                </div>
                            </div>
                            <div class="row">
                                <a href="?action=addToChart&id={$pr->id}" class="btn btn-warning col d-flex align-items-center justify-content-center mx-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart4 me-0.5" viewBox="0 0 16 16">
                                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                                    </svg>Ajouter au panier</a>
                                <a href="?action=productDetails&id={$pr->id}" class="btn btn-primary col d-flex align-items-center justify-content-center mx-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-eye me-0.5" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>Voir le produit</a>
                            </div>
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
