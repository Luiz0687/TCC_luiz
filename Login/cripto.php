<?php
$senha = 'minhasenha';
//gerar a hash da senha 
$hash = password_hash($senha, PASSWORD_ARGON2I);
//verfica se a senha confere
if (password_verify($senha, $hash)) {
    echo "senha confere.";
} else {
    echo "a senha nao confere.";
}
