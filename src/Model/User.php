<?php
namespace Blog\Model;



		class  User
			{
	private $_id;
	private $_nom;
	private $_prénom;
	private $_email;
	private $_motdePasse;

	public function __construct(  $nom, $prénom, $email, $motdePasse)
	{
	
		$this->_nom = $nom;
		$this->_prénom = $prénom;
		$this->_email = $email;
		$this->_motdePasse = $motdePasse;

		
		
	}

		public function getId() {
			return $this-> _id;
		}

		public function setID($id) {
			$this->_id = $id;
		}

		public function getNom() {
			return $this-> _nom;
		}

		public function setNom($nom) {
			$this->_nom = $nom;
		}

		public function getPrénom() {
			return $this-> _prénom;
		}

		public function setPrénom($prénom) {
			$this->_prénom = $prénom;
		}
		
		public function getEmail() {
			return $this-> _email;
		}

		public function setEmail($email) {
			$this->_email = $email;
		}
		
		public function getMotDePasse() {
			return $this-> _motdePasse;
		}

		public function setMotDePasse($motdePasse) {
			$this->_motdePasse = $motdePasse;
		}

		



	
	
		
			}





	?>