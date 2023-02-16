<?php

namespace crazy\action\catalog;

use crazy\models\Produit;
use crazy\models\Users;

class AddToCartAction
{
    public function execute(): string
    {
        //redirection vers la page d'origine
        $redirection = $_GET['redirection'] ?? "";
        //si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login&redirection=' . $redirection . '&error=needConnection');
        } else {
            //sinon on ajoute le produit au panier et on le redirige vers la page d'origine
            $idProduct = $_GET['id'] ?? "";
            $idUser = $_SESSION['user'];
            $user = Users::where('id', $idUser)->first();
            $product = Produit::where('id', $idProduct)->first();
            echo "test";
            if ($user->products()->where('product_id', $idProduct)->exists()) {
                echo "test";
                $user->products()->updateExistingPivot($idProduct, ['quantity' => $user->products()->where('product_id', $idProduct)->first()->pivot->quantity + 1]);
            } else {
                $user->products()->save($product, ['quantity' => 1]);
            }
            header('Location: index.php?action=' . $redirection);
        }
        return "";
    }
}