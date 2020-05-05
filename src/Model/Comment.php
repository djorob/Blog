<?php
namespace  Blog\Model;

        class Comment

        {
                private $_id;
                private $_userid;
                private $_comment;
                private $_date;
                private $_comment_Statut;

                private $_auteur;
                private $_BlogPostid;




                public function __construct( $userid, $comment,$date, $BlogPostid)
                {  
                
                    $this->_userid = $userid;
                    $this->_comment = $comment;
                    $this->_date = $date;    
                    $this->_BlogPostid = $BlogPostid;
                    
                }

                public static function getListFromDataRows (array $data)
                {
                
                    $arrayOfComment= array();
                    foreach(  $data as $row){
                        $comment = new Comment( $row->userid, $row->comment , $row->date ,$row->BlogPostid);
                        //$arrayOfBlogPost[$counter] = $newBlogPost; 
                        $comment->setId($row->id);
                        $comment->setComment_Statut($row->comment_Statut);
                        $comment->SetAuteur($row->nom.' ' .$row->prenom);

                        $arrayOfComment []= $comment ;  
                        
                    } 
                
                    return  $arrayOfComment;

                }


                //setters

                public function setId($id)
                {
                    $id - (int) $id;
                    if ($id > 0 ) { 
                        $this->_id = $id;
                    }

                }



                public function setUserId($userid)
                { 
                        $this->_userid = $userid;
                }

                public function setDate($date)
                { 
                        $this->_date = $date;
                }


                public function setComment($comment)
                {
                    
                    //if (is_string($comment)) { 
                        $this->_comment = $comment;
                //}

                }

                public function setComment_Statut($comment_Statut)
                {
                    
                    //if (is_string($comment_Statut)) { 
                        $this->_comment_Statut = $comment_Statut;
                //}

                }






                public function SetAuteur($_auteur)
                {
                    
                    if (is_string($_auteur)) { 
                        $this->_auteur = $_auteur;
                }

                }






                public function SetBlogPostid($_BlogPostid)
                {
                    
                    if (is_string($_BlogPostid)) { 
                        $this->_BlogPostid = $_BlogPostid;
                }

                }


                //GETTERS

                public function GetId(){
                    return $this->_id;
                }

                public function GetUserId(){
                    return $this->_userid;
                }

                public function GetComment(){
                    return $this->_comment;
                }

                public function Getcomment_Statut(){
                    return $this->_comment_Statut;
                }


                public function GetDate(){
                    return $this->_date;
                }



                public function GetAuteur(){
                    return $this->_auteur;
                }

                public function GetBlogPostid(){
                    return $this->_BlogPostid;
                }


        }






    ?>