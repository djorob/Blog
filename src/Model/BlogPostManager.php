<?php 
namespace  Blog\Model;
    



    

    class BlogPostManager extends Model
    {
        
        public function getAllBlogPost()
        {
            return $this->getAll('blog_Post', 'Blog\Model\\BlogPost');
        }

        public function AddBlogPost($blogPostObjet)
        {
            
            return $this->AddBlogPostDB($blogPostObjet);
        }

        public function deleteBlogPost($id)
        {
            
            return $this->deleteBlogPost($id);
        }

        public function updateBlogPosts($blogPost)
        {
            
            return $this->updateBlog_post($blogPost);
        }

        public function validerLogin($email, $password)
        {
            return $this->validerUserNameAndPassword($email, $password);
        }

        public function getBlog($id)
        {
            return $this->getBlogPost($id);
        }

        public function getCommentsForValidation($adminId) 
        {
            return $this->getAllCommentsForValidation($adminId); 
        }

        public function validerCommentaire($commentid) 
        {
            return $this->setCommentAsValidated($commentid);
        }
    }



    ?>