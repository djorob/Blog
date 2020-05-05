<?php
namespace  Blog\Model;
require  './vendor/autoload.php';
use Blog\Model\BlogPost;
use Blog\Model\Comment;
    


  abstract class Model
    {
      private static $_bdd;


      private static function setBdd()
      {
          self::$_bdd = new \PDO('mysql:host=localhost;dbname=mon_blog;charset=utf8', 'root', 'root'); //root
          self::$_bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
      }


      protected function getBDD()
      {
          if (self::$_bdd == null) {
              self::setBdd();
              return self::$_bdd;
          }
      }



      


      protected function getAll($tableName, $className)
      {
          $this->getBdd();
          $var = [];
          $req = self::$_bdd->prepare('SELECT * FROM '.$tableName);
          $req->execute();

    
        

          while ($data =$req->fetchALL(\PDO::FETCH_OBJ)) {
              $var[] = $className::getListFromDataRows($data);
          }
          
        


        


          $req->closeCursor();
          return $var;
      }

      protected function getAllComments( $CommentClassName, $blogid)
      {
          $this->getBdd();
          $var = [];
          $req = self::$_bdd->prepare('SELECT commentaires.id,commentaires.userid,commentaires.comment, commentaires.date, commentaires.comment_Statut, commentaires.BlogPostid, administrateur.nom, administrateur.prenom FROM commentaires INNER JOIN administrateur on commentaires.userid=administrateur.id WHERE commentaires.BlogPostid = :blogId AND commentaires.comment_Statut=1;' );//.$tableName. 'ORDER BY id DESC');
          $req->bindParam(':blogId', $blogid, \PDO::PARAM_INT);
          $req->execute();
        
            $var = array();
          while ($data =$req->fetchALL(\PDO::FETCH_OBJ)) {
              $var[] = $CommentClassName::getListFromDataRows($data);
          }
          return $var;
      }

      protected function AddBlogPostDB($blogPostObjet)
      {
          $this->getBdd();
          $req = self::$_bdd->prepare('INSERT INTO blog_Post(  chapo, lienBlogPost, content, titre, auteur, date_Creation, adminid) VALUES
            :chapo, :lienBlogPost, :content, :titre, :auteur, :dateCreation, :adminId');
          $req->bindParam(':chapo',  $blogPostObjet->Getchapo(), \PDO::PARAM_STR);
          $req->bindParam(':lienBlogPost',  $blogPostObjet->GetlienBlogPost(), \PDO::PARAM_STR);
          $req->bindParam(':content',   $blogPostObjet->GetContent(), \PDO::PARAM_STR);
          $req->bindParam(':titre',   $blogPostObjet->getTitre(), \PDO::PARAM_STR);
          $req->bindParam(':auteur',   $blogPostObjet->getAuteur() , \PDO::PARAM_STR);
          $req->bindParam(':dateCreation',   $blogPostObjet->GetdateCreation() , \PDO::PARAM_STR);
          $req->bindParam(':adminId',   $blogPostObjet->Getadminid() , \PDO::PARAM_INT);


          $req->execute();

      }

      protected function updateBlog_post($blogPostObjet)
      {
          $this->getBdd();
          $titre = $blogPostObjet->getTitre();
          $chapo = $blogPostObjet->Getchapo();
          $lienBlogPost = $blogPostObjet->GetlienBlogPost();
          $content = $blogPostObjet->GetContent();
          $auteur = $blogPostObjet->getAuteur();
          $dateModification= $blogPostObjet->GetDateModification();
          $adminId =  $blogPostObjet->Getadminid();
        $blogPostId = $blogPostObjet->GetId();

          $req = self::$_bdd->prepare('UPDATE blog_Post SET date_modification = :dateModification, 
          chapo = :chapo , 
          lienBlogPost = :lienBlogPost, 
          content = :content , titre = :titre, auteur = :auteur, adminid = :adminId WHERE blog_Post.id = :id;');
          $req->bindParam(':chapo',  $chapo, \PDO::PARAM_STR);
          $req->bindParam(':lienBlogPost',  $lienBlogPost, \PDO::PARAM_STR);
          $req->bindParam(':content',   $content, \PDO::PARAM_STR);
          $req->bindParam(':titre', $titre  , \PDO::PARAM_STR);
          $req->bindParam(':auteur',   $auteur , \PDO::PARAM_STR);
          $req->bindParam(':dateModification',   $dateModification , \PDO::PARAM_STR);
          $req->bindParam(':adminId',   $adminId , \PDO::PARAM_INT);
          $req->bindParam(':id',   $blogPostId , \PDO::PARAM_INT);

          $req->execute();

      }

      

      protected function deleteBlog_post($id)
      {
          $req = self::$_bdd->prepare('DELETE FROM blog_post WHERE id = :blogPostId ');
          $req->bindParam(':blogPostId',  $id, \PDO::PARAM_INT);
        
          $req->execute();

      }


      protected function getBlogPost($id)
      {
        $this->getBdd();
          $req = self::$_bdd->prepare('SELECT * FROM blog_Post WHERE id = :blogPostId');
          $req->bindParam(':blogPostId',  $id, \PDO::PARAM_STR);
 
        
          $req->execute();
          $newBlogPost = null;
          while ($data =$req->fetchALL(\PDO::FETCH_OBJ)) {

            foreach(  $data as $row){
       
                $newBlogPost = new BlogPost($row->id, $row->date_modification, $row->chapo, $row->lienBlogPost, $row->content,$row->titre,$row->auteur,$row->date_Creation,$row->adminid);
                
                
            } 
              
            return $newBlogPost;
            
           
      }
      

      }

      protected function addUser($user)
      {
          $this->getBdd();
                    $req = self::$_bdd->prepare('INSERT INTO user(  nom, prenom, email, motdePasse) VALUES
                    :nom, :prenom, :email'); 
                $req->bindParam(':nom',  $user->GetNom(), \PDO::PARAM_STR);
                $req->bindParam(':prenom',  $user->GetPrenom(), \PDO::PARAM_STR);
                $req->bindParam(':email',   $user->GetEmail(), \PDO::PARAM_STR);
                
        
          $req->execute();

      }

      protected function validerUserNameAndPassword($email, $Password)
      {
          $this->getBdd();
         
          $req = self::$_bdd->prepare( 'SELECT * FROM administrateur where  email= :email'); //and   motdePasse = \''.$Password.'\'');
          $req->bindParam(':email',   $email, \PDO::PARAM_STR);
          $req->execute();
          while ($data =$req->fetch(\PDO::FETCH_OBJ)) {
             
            
             if (isset($data)) {
                 // c'est ici que l'on vérifie  si le password hash qui est hash dans la BDD correspond au password que l'on a fournit au moment de Login
                 $value = password_verify($Password, $data->motdePasse);
               
                 if ($value == true) {
                    
                      return $data;
                 }
                 else {
                     return null;
                 }
                 
                 

             }
             else {
                 return null;
             }
        }
        
        
          
      }

            public function insertComment($comment)
            {
                $this->getBdd();
                $blogPostId = (int)$comment->GetBlogPostid();
                $userId = $comment->GetUserId();
                $comment =  $comment->GetComment();
               
                $req = self::$_bdd->prepare( 'INSERT INTO commentaires ( userid, comment,  BlogPostid) VALUES 
                (:userid, :comment, :BlogPostid)'); 
               
                
                $req->bindParam(':userid',  $userId, \PDO::PARAM_INT);
                $req->bindParam(':comment', $comment, \PDO::PARAM_STR);
                $req->bindParam(':BlogPostid',  $blogPostId, \PDO::PARAM_INT);
                $req->execute();

            }

            protected function deleteComment($id)
            {
                $this->getBdd();

                $req = self::$_bdd->prepare('DELETE FROM commentaires WHERE id = :commentId');
                $req->bindParam(':commentId',  $id, \PDO::PARAM_INT);

                $req->execute();

            }
        
            protected function deleteUser($id)
            {

                $this->getBdd();

                $req = self::$_bdd->prepare('DELETE FROM administrateur WHERE id = :userId');
                $req->bindParam(':userId',  $id, \PDO::PARAM_INT);


                $req->execute();

            }


            protected function getAllUser()
            {

                $this->getBdd();

                $req = self::$_bdd->prepare('SELECT * FROM administrateur WHERE role =\'user\'');
                $req->execute();

                $allUser= array();
                while ($data =$req->fetchALL(\PDO::FETCH_OBJ)) {
                    foreach ($data as $row) {
                        array_push($allUser, $row);
                    }
                }
                    return $allUser;



                
            }

            public function registerUser($user)
            {
                $this->getBdd();
                $userNom = $user->getNom();
                $userPrenom = $user->getPrénom();
                $userEmail = $user->getEmail();
                $userMotDePasse = $user->getMotDePasse();
                 $req = self::$_bdd->prepare('INSERT INTO administrateur(  nom, prenom, email, motdePasse) VALUES(
                 :nom, :prenom, :email, :motdePasse)');
                 $req->bindParam(':nom', $userNom , \PDO::PARAM_STR);
                 $req->bindParam(':prenom',  $userPrenom, \PDO::PARAM_STR);
                 $req->bindParam(':email',   $userEmail, \PDO::PARAM_STR);
                 $req->bindParam(':motdePasse',   $userMotDePasse, \PDO::PARAM_STR);
              
                $req->execute();
                
            }

            public function registeradmin($administrateur)
            {
                $this->getBdd();
                $adminNom = $administrateur->GetNom();
                $adminPrenom = $administrateur->GetPrenom();
                $adminMotDePasse = $administrateur->GetMotDePasse();
                $adminAccroche = $administrateur->GetAccroche();
                $adminLienCv = $administrateur->GetlienCv();
                $adminEmail = $administrateur->GetEmail();
                $adminLienGitHub = $administrateur->GetlienGitHub();
                $adminLienLinkedin =  $administrateur->Getlienlinkedin();
                $adminLienTwitter = $administrateur->GetlienTwitter();
                $adminLienFacebook = $administrateur->GetlienFacebook();
                $adminRole = $administrateur->Getrole();



                 $req = self::$_bdd->prepare('INSERT INTO administrateur(  nom, prenom, email, motdePasse, accroche, lienCv, lienGithub, lienLinkedin, lienTwitter, lienFacebook, role ) VALUES(
                 :nom, :prenom, :email, :motdePasse, :accroche, :liencv, :liengithub, :lienlinkedin, :lientwitter, :lienfacebook, :roleAdmin)');
                 $req->bindParam(':nom',  $adminNom, \PDO::PARAM_STR);
                 $req->bindParam(':prenom',  $adminPrenom, \PDO::PARAM_STR);
                 $req->bindParam(':email',   $adminEmail, \PDO::PARAM_STR);
                 $req->bindParam(':motdePasse',  $adminMotDePasse, \PDO::PARAM_STR);
                 $req->bindParam(':accroche',   $adminAccroche, \PDO::PARAM_STR);
                 $req->bindParam(':liencv',  $adminLienCv, \PDO::PARAM_STR);
                 $req->bindParam(':liengithub',   $adminLienGitHub, \PDO::PARAM_STR);
                 $req->bindParam(':lienlinkedin',  $adminLienLinkedin, \PDO::PARAM_STR);
                 $req->bindParam(':lientwitter',   $adminLienTwitter, \PDO::PARAM_STR);
                 $req->bindParam(':lienfacebook',   $adminLienFacebook, \PDO::PARAM_STR);
                 $req->bindParam(':roleAdmin',   $adminRole, \PDO::PARAM_STR);

              
                $req->execute();
                
            }

            public function getAllCommentsForValidation($adminId){
        
            $this->getBdd();

            $req = self::$_bdd->prepare('SELECT commentaires.id, commentaires.userid,concat(administrateur.nom,\'  \', administrateur.prenom) as usernom, commentaires.comment, commentaires.date,  commentaires.BlogPostid, blog_Post.titre 
            FROM commentaires INNER JOIN administrateur on commentaires.userid=administrateur.id 
            inner JOIN blog_Post on commentaires.BlogPostid = blog_Post.id
            WHERE commentaires.comment_Statut= 0 AND blog_Post.adminid= :adminId');
            $req->bindParam(':adminId',   $adminId, \PDO::PARAM_INT);


            $req->execute();

            $var = array(); 
          while ($data =$req->fetchALL(\PDO::FETCH_OBJ)) {
              //var contiendra les données sous forme d'objet
             
              array_push($var,$data);
              
          }
          return $var;
        
            }

            public function setCommentAsValidated($commentId){
        
                $this->getBdd();
    
                $req = self::$_bdd->prepare('UPDATE commentaires SET comment_Statut = 1 WHERE commentaires.id = :commentId;');
                $req->bindParam(':commentId',   $commentId, \PDO::PARAM_INT);

    
                $req->execute();
    
                
              
            
                }

               


            

            

      
        }