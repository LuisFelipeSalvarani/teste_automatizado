<?php

class Login extends Model {

    public function validate() {
        $errors = [];

        if(!$this->usuario) {
            $errors['usuario'] = "Por favor, informe o usuário.";
        }

        if(!$this->senha) {
            $errors['senha'] = "Por favor, informe a senha.";
        }

        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
    public function checkLogin() {
        $this->validate();
        $user = User::getOne(['usuario' => $this->usuario]);
        if($user) {
            if(password_verify($this->senha, $user->senha)) {
                return $user;
            }
        }
        //$hash = password_hash($this->senha, PASSWORD_DEFAULT);
        //echo $hash;
        throw new AppException("Usuário e Senha inválidos.");
        
    }
}
