<?php

namespace  Blog\Model;





class CommentManager  extends Model
{
  

    public function getAllComment($blogid) {
        return $this->getAllComments( 'Blog\Model\\Comment', $blogid);
    }
 
    public function insererCommentaire($comment)
    {

        $this->insertComment($comment);
        
    }

    public function InvalidComment($id){


        $this->deleteComment($id);
    }

}






?>