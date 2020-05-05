<?php
 namespace Blog\Controller;
 
use Blog\App\Controller;
use Blog\App\View;
use Blog\Model\BlogPostManager;
use Blog\Model\AdminManager;
use Blog\Model\UserManager;
use Blog\Model\User;
use Blog\Model\Admin;



     class Account extends Controller
     {
     public function __construct()
     {
          parent::__construct(); 
          
     }
     public function login($request)
     {
          
          $this->render('login'); 
     }
     

     public function loginUser($request)
     {
          
          
          

          $blogPostManager = new BlogPostManager();
          
         
          $userValidated = $blogPostManager->validerLogin($_POST['UserEmail'],$_POST["UserPassword"] );
          // si le user/ le password est invalide cela doit le retourner à la meme page du login  et affiche le message d'erreur
          if ($userValidated == null){

          $errorMessage = array ("errorMessage"  =>   "password or email invalid");
          $viewToDisplay = new View();
          $viewToDisplay->setTemplate('login');
          $viewToDisplay->render($errorMessage);
          return; // sort de cette fonction

          }
             
          $_SESSION['name'] = $userValidated->nom ;
          
         
          
        

          if ($userValidated->role == 'admin') {
               
               $_SESSION['role'] = 'admin';
               
               $_SESSION['adminId'] = $userValidated->id;
               
               
               $view = new View();
               $view->redirect('blog');
          }
          else {

               $_SESSION['userId'] = $userValidated->id;
               $_SESSION ['role'] = 'user';
               $view = new View();
               $view->redirect('blog');
               
          }

          
     }

     public function registerUser($request)
     {
                    
                    
          $this->render('registerUser');
     }


     public function registerUserPost($request)
          {

     //on créer l'objet 
          $passwordcryptage=password_hash($_POST["MotdePasse"], PASSWORD_DEFAULT);
          $user = new User($_POST["UserName"], $_POST["UserSurname"], $_POST["UserEmail"],$passwordcryptage );
          $userManager= new UserManager();//permet de sauvegarder dand la BDD
          $userManager->registerVisitorUser($user);// on appel la fonction qui enregistre ce user
          
          $view = new view();
          $view->redirect('login');
          
          



          }

          public function registerAdmin($request)
          {
                    
                    
               $this->render('registerAdmin');
          }

          public function registerAdminPost($request)
          {

     //on créer l'objet 
          $passwordcryptage=password_hash($_POST["MotdePasse"], PASSWORD_DEFAULT);

          $administrateur = new admin($_POST["adminName"], $_POST["adminSurname"], $_POST["adminEmail"],$_POST["adminAccroche"], $passwordcryptage, $_POST["lienCv"], $_POST["Github"], $_POST["lienLinkedin"], $_POST["lienTwitter"], $_POST["lienFacebook"], "", "admin");
          $AdminManager= new AdminManager();//permet de sauvegarder dand la BDD
          $AdminManager->registerAdministrateur($administrateur);// on appel la fonction qui enregistre ce admin
          
          $view = new view();
          $view->redirect('login');
          
          



          }

          public function logout($request)
          {
          unset($_SESSION['role']) ;
          unset($_SESSION['userId']) ;
          unset($_SESSION['adminId']);
          
          $view = new view();
          $view->redirect('blog');
                    
               
          }
     

          public function getAllUser(){

               if(isset($_SESSION['adminId'])){

                    $userManager= new UserManager();


                    $allUser = $userManager->getAllUserDB();
                    
     
     
                    $param = array ("allUser"  =>  $allUser);
                    
                    $this->render('getListUser', $param);

               }
               
               
               


          }

          public function deleteUserDb($request)
               {
                   if (isset($_SESSION['adminId'])) {
                       $userManager= new UserManager();//permet de sauvegarder dand la BDD
                       //  $userManager->deleteUser($id);// on appel la fonction qui enregistre ce user
                       // $user = $userManager->deleteUser($id);
                       // $userManager->deleteUser($id);
                       $id = $request->getParams()['id'];
                        $userManager->deleteUserDb($id);
                       $view = new View();
                       // $this->render('templateAdmin');
                       $view->redirect('listUser');
                   }
               }



     }
