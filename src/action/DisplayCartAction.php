<?php

namespace crazy\action;

use crazy\models\Cart;
use crazy\models\Produit;

class DisplayCartAction
{
    public function execute(): string
    {
        $carbone = 0;
        $cart = [];
        $html = "";
        if (!isset($_SESSION['user']))
            header('Location: index.php?action=login&error=needConnection');
        else {
            $nbProduits = 0;
            $prixTotal = 0;
            $idUser = $_SESSION['user'];
            $cartProducts = Cart::where('user_id', $idUser)->get();
            foreach ($cartProducts as $cP) {
                $nbProduits += $cP->quantite;
            }
            $html .= <<<HTML
                <section class="h-100 h-custom" style="background-color: #eee;">
                  <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                      <div class="col">
                        <div class="card">
                          <div class="card-body p-4">
                
                            <div class="row">
                
                              <div class="col-lg-7">
                                <h5 class="mb-3"><a href="?action=ProductsAction" class="text-body"><i
                                      class="fas fa-long-arrow-alt-left me-2"></i>Retourner au catalogue</a></h5>
                                <hr>
HTML;
            if ($nbProduits == 0) {
                $html .= <<<HTML
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                          <div class="d-flex flex-row align-items-center">
                            <div class="ms-3">
                              <h5>Le panier est vide</h5>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
HTML;
            } else {
                foreach ($cartProducts as $cP) {
                    $product = Produit::where('id', $cP->product_id)->first();
                    $cart[] = $product;
                    $cart[] = $cP->quantite;
                    $prixTotal += $product->prix * $cP->quantite;
                    $carbone += $product->carbone * $product->distance * $cP->quantite;
                    $html .= <<<HTML
                        <div class="card mb-3">
                          <div class="card-body">
                            <div class="d-flex justify-content-between">
                              <div class="d-flex flex-row align-items-center">
                                <div>
                                  <img
                                    src="src/img/{$product->id}.jpg"
                                    class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                </div>
                                <div class="ms-3">
                                  <h5>{$product->nom}</h5>
                                  <p class="small mb-0">{$product->lieu}</p>
                                </div>
                              </div>
                              <div class="d-flex flex-row align-items-center">
                                <div style="width: 50px;">
                                  <h5 class="fw-normal mb-0">{$cP->quantite}</h5>
                                </div>
                                <div style="width: 80px;">
                                  <h5 class="mb-0">{$product->prix}</h5>
                                </div>
                                <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                              </div>
                            </div>
                          </div>
                        </div>
HTML;
                }
            }
            $_SESSION['cart'] = $cart;
            $html .= <<<HTML
                  </div>
                  <div class="col-lg-5">
    
                    <div class="card bg-primary text-white rounded-3">
                      <div class="card-body">
                        <div class="d-flex row justify-content-between align-items-center mb-4">
                        <h5 class="mb-1">Panier</h5>
                        <h5 class="mb-0">Vous avez {$nbProduits} dans votre panier</h5>
                        </div>
                        
                        <h5 class="small mb-2">Information</h5>
                        
                        <h5>Indicateur carbone total de la commande :</h5>
                        <h5><i class="fa-brands fa-envira"></i>{$carbone}g</h5>
    
                        <hr class="my-4">
    
                        <div class="d-flex justify-content-between mb-4">
                          <p class="mb-2">Total(Incl. taxes)</p>
                          <p class="mb-2">{$prixTotal}€</p>
                        </div>
    
                        <button type="button" class="btn btn-warning btn-block btn-lg" style="width: 60%">
                          <div>
                            <a href="?action=confirmChart&"><span>Prendre rendez vous<i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                          </div>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
HTML;
        }
        return $html;
    }
}