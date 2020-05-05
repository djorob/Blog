<?php
namespace Blog\Controller;
require './vendor/autoload.php';

    use Blog\App\Controller;
    use Blog\App\View;
    use Blog\Model\BlogPostManager;
    use Blog\Model\CommentManager;
    use Blog\Model\UserManager;
    use Blog\Model\BlogPost;
    use Blog\Model\Comment;


    class Article extends Controller

    {
        private  $blogPostmanager;

        

    public function __construct()
    {
    parent::__construct();
    $this->blogPostmanager = new BlogPostManager(); 
    
    }
        


        
    public function listBlogPost($request)
        {
            
            
            $allBlogPost = $this->blogPostmanager->getAllBlogPost();
            $userName='';
            if (!empty($_SESSION['name'] )) {
                $userName = $_SESSION['name'];  
            }
            
            $param = array ("allBlogPost"  =>  $allBlogPost, "userName" => $userName);
            $viewToDisplay = new View(); 
            
            
           
            if (empty ($_SESSION['role']) ){
                
                $viewToDisplay->setTemplate('home');
                $viewToDisplay->render($param);
                return;
            } 
            
            if ($_SESSION['role'] == 'admin') {
                
                $viewToDisplay->setTemplate('BlogAdmin');
            }
    
            elseif ($_SESSION['role'] == 'user') {
                
                $viewToDisplay->setTemplate('BlogUser');
                
            }
            
            $viewToDisplay->render($param);
        }

        public function addblog($request)
        {
            if ($_SESSION['role'] == 'admin') {
                $this->render('insertBlog'); 
            }

            else {

                $this->render('home');
                
            }
            
        }

        public function addBlogPost($request) 
        {
            
        $adminId =  $_SESSION['adminId'] ;
        $newBlogPost = new BlogPost(0, "", $_POST['chapoBlogPost'], $_POST['LienBlogPost'],  $_POST['ContenuBlogPost'],$_POST['titreBlogPost'], $_POST['AuteurBlogPost'], date("y/m/d", time()), $adminId  );
            
        
        $blogPostManager = new BlogPostManager();
        $blogPostManager->addBlogPost($newBlogPost);
        $this->listBlogPost($request);

        }

        public function getBlog($request)
        {
            $id = $request->getParams()['id'];
        
            $blogPostManager = new BlogPostManager();
            $blogPost = $blogPostManager->getBlog($id);

            $commentManager = new commentManager();
            $commentaireDuBlogPost = $commentManager->getAllComment($blogPost->GetId()); 
            
            //View
            if ($_SESSION['role'] == 'admin') {
                $this->render('singleBlogPost',[
                    "blogPost" => $blogPost,
                    "commentaireDuBlogPost" => $commentaireDuBlogPost
                ]);
                return;
            }
            $this->render('userSingleBlogPost',[
                "blogPost" => $blogPost,
                "commentaireDuBlogPost" => $commentaireDuBlogPost
            ]);
        }

        public function ajouterCommentaire($request)
        {
            

            if (isset($_SESSION['role'])) {
                $userId=null;
            
                
                if (isset($_SESSION['userId'])) {
                    $userId = $_SESSION['userId'];
                }
                if(isset($_SESSION['adminId'])) {
                    $userId = $_SESSION['adminId'];
            
                }
                $comment = new Comment($userId,$_POST['contentComment'],date("Y/m/d"), $_POST['blogPostid']);

                
                $commentManager = new commentManager();
                $commentManager->insererCommentaire($comment);
                
                $viewToDisplay = new View();
                $viewToDisplay->redirect('blogid/id/' .  $_POST['blogPostid']);
                
                
                
                
                return;

            }




        }


            public function validationCommentaires(){
                
                $adminId = $_SESSION['adminId'];
                
                $commentnotvalidated = $this->blogPostmanager->getCommentsForValidation($adminId);
                
                
                $param = array ("commentnotvalidated"  =>  $commentnotvalidated);
                
                $this->render('ValiderCommentaires', $param);
                
                
                
            

            
        }


        public function commentaireValide($request){
                
            $commentId  = $request->getParams()['id'];
           
            
            $commentvalidated = $this->blogPostmanager->validerCommentaire($commentId);
            

            
            $view = new View();
           
            $view->redirect('ValiderCommentaires');
            
            
        

        
    }


        public function updateBlogPosts($request){
            
            $adminId = $_SESSION['adminId'];

            $id = $request->getParams()['id'];
                   
        
            
            
            $blogPostManager = new BlogPostManager();
            $blogPost = $blogPostManager->getBlog($id);

            
           

            $this->render('updateBlogPost',[
                "blogPost" => $blogPost
                
            ]);

            
                

        }

    

           

            


            public function updateToDb($request){

                $adminId = $_SESSION['adminId'];


                $titre=$_POST['titreBlogPost'];
                $chapo=$_POST['chapo'];
                $auteur=$_POST['Auteur'];
                $content=$_POST['Content'];
                $lienBlogPost=$_POST['lienBlogPost'];
                $blogPostId = $_POST['blogPostId'];

                $blog = new BlogPost($blogPostId, date("Y/m/d"), $chapo, $lienBlogPost, $content, $titre, $auteur, null, $adminId);
                $blogPostManager = new BlogPostManager();
                 $blogPost=$blogPostManager->updateBlogPosts($blog);

            $view = new View();
           
                $view->redirect('blog');
            
            

                


            }

    }







    ?>