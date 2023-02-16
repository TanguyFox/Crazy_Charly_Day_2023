<?php

namespace crazy\action;

use crazy\models\Cart;
use crazy\models\Produit;

class AddToCartAction
{
    public function execute(): string
    {
        //redirection vers la page d'origine
        $redirection = $_GET['redirection'];
        //si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login&redirection=' . $redirection . '&error=needConnection');
        } else {
            //sinon on ajoute le produit au panier et on le redirige vers la page d'origine
            $idProduct = $_GET['id'] ?? "";
            $idUser = $_SESSION['user']->id;
            $cart = new Cart();
            $cart->product_id = $idProduct;
            $cart->user_id = $idUser;
            $cart->save();
            header('Location: index.php?action=' . $redirection);
        }
        return "";
    }
}