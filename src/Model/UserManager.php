<?php
namespace Blog\Model;


// IL VA SE CHARGER DE CONTENIR LES METHODE d operation des user

    


    class UserManager  extends Model
        {

    public function addUser($user) {
        return $this->addUser($user);
    }

    public function registerVisitorUser($administrateur) {
        return $this->registerUser($administrateur);
    }
 
    public function validerUserNameAndPassword( $email, $motdePAsse) {
        
       
    }

    public function deleteUserDb($id){
        
        return $this->deleteUser($id);
    }

    public function getAllUserDB(){
        
        return $this->getAllUser();
    }
        }
        



?>