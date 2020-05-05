<?php
namespace Blog\Model ;


       

        class AdminManager  extends Model
        {
            //gérer la fonction qui va ajouter les user dan bdd

            public function addUser($user) {
                return $this->addUser($user);
            }

            public function registerAdministrateur($administrateur) {
                return $this->registerAdmin($administrateur);
            }


            
        
            public function deleteComment( $id) {
                
                return $this->deleteComment($id); 
            }

            public function deleteUser( $user) {
                
                return $this->deleteUser($user); 
            }
        }

        ?>