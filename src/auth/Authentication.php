<?php

namespace crazy\auth;

use crazy\models\Users;

class Authentication
{

    // controler la solidité des mots de passe avant de les hacher dans la base
    public static function checkPasswordStrength(string $pass, int $minimumLength): bool
    {
        $length = strlen($pass) > $minimumLength; // longueur minimale
        $digit = preg_match("#\d#", $pass); // au moins un digit
        $special = preg_match("#\W#", $pass); // au moins un car. spécial
        $lower = preg_match("#[a-z]#", $pass); // au moins une minuscule
        $upper = preg_match("#[A-Z]#", $pass); // au moins une majuscule

        return $length && $digit && $special && $lower && $upper;
    }

    public static function authenticate($email, $password)
    {
        $user = Users::where('email', $email)->first();

        // si l'utilisateur n'existe pas
        if (!$user) return false;

        if (!password_verify($password, $user->password)) return false;

        return $user;
    }

    public static function register($nom, $email, $password, $telephone)
    {
        if (!self::checkPasswordStrength($password, 6))
            return "Le mot de passe n'est pas assez fort : le mot de passe doit contenir : <br>1 nombre, <br>1 majuscule ou minuscule, <br>1 caractère spécial (!:;,...) <br>minimum 6 caractères";

        $user = Users::where('email', $email)->first();
        if ($user) return "Email déjà utilisé";

        // on créé un hash du mot de passe
        $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

        // on créé le nouvel utilisateur
        $user = new Users();
        $user->nom = $nom;
        $user->email = $email;
        $user->password = $hash;
        $user->telephone = $telephone == "" ? null : $telephone;

        // on l'enregistre dans la base
        $user->save();

        return $user;
    }
}
