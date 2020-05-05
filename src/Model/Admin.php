<?php
namespace Blog\Model;




            class Admin

            {
                private $_id;
                private $_nom;
                private $_prenom;
                private $_email;
                private $_accroche;
                private $_motdePasse;
                private $_lienCv;
                private $_lienGithub;
                private $_lienLinkedin;
                private $_lienTwitter;
                private $_lienFacebook;
                private $_lienPhoto;
                private $_role;

                
                
            public function __construct($nom, $prenom, $email, $accroche, $motdePasse, $lienCv, $lienGithub, $lienLinkedin, $lienTwitter, $lienFacebook, $lienPhoto, $_role) {
                    
                    $this->_nom=$nom;
                    $this->_prenom=$prenom;
                    $this->_email=$email;
                    $this->_accroche=$accroche;
                    $this->_lienCv=$lienCv;
                    $this->_motdePasse=$motdePasse;
                    $this->_lienCv=$lienGithub;
                    $this->l_ienLinkedin=$lienLinkedin;
                    $this->_lienTwitter=$lienTwitter;
                    $this->_lienFacebook=$lienFacebook;
                    $this->_lienPhoto=$lienPhoto;
                    $this->_role=$_role;

                }


                public function getId() {
                    return $this->_id;
                }
                
                public function getAccroche() {
                    return $this->_accroche;
                }

                public function setAccroche($accroche) {
                    $this->_accroche = $accroche;
                }
                
                    public function getNom() {
                        return $this->_nom;
                    }

                    public function setNom($nom) {
                        $this->_nom = $nom;
                    }

                    public function setPrenom($prenom) {
                        $this->_prenom = $prenom;
                    }

                    public function getPrenom(){

                        return $this->_prenom;
                    }

                    public function getEmail() {
                        return $this->_email;
                    }

                    public function setEmail($email){

                        $this->_email= $email;
                    }

                    public function getmotdePasse() {
                        return $this->_motdePasse;
                    }

                    public function setMotdepasse($motdePasse) {

                        $this->_motdePasse = $motdePasse;
                    }

                    public function getlienCv() {
                        return $this->_lienCv;
                    }

                    public function setLienCv($lienCv) {

                        $this->_lienCv = $lienCv;

                    }



                    public function getlienGithub() {
                        return $this->_lienGithub;
                    }

                    public function setLienGithub ($lienGithub){

                        $this->_lienGithub = $lienGithub;
                    }


                    public function getlienLinkedin() {
                        return $this->_lienLinkedin;
                    }

                    public function setLienLinkedin($lienLinkedin) {

                        $this->_lienLinkedin = $lienLinkedin;
                    }

                    public function getlienTwitter() {
                        return $this->_lienTwitter;
                    }

                    public function setLienTwitter($lienTwitter) {
                        $this->_lienTwitter = $lienTwitter;

                    }

                    public function getlienFacebook() {
                        return $this->_lienFacebook;
                    }

                    public function setLienFacebook($_lienFacebook){

                        $this->_lienFacebook = $_lienFacebook;
                    }



                    public function getlienPhoto() {
                        return $this->_lienPhoto;
                    }


                    public function setLienPhoto($lienPhoto){

                        $this->_lienPhoto = $lienPhoto;

                    }


                    public function getrole() {
                        return $this->_role;
                    }

                    public function setRole($role) {
                        $this->_role = $role;
                    }


                    


            }






            ?>