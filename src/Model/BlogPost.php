<?php
namespace  Blog\Model;

class BlogPost
{
    private $_id;
    private $_dateModification;
    private $_chapo;
    private $_lienBlogPost;
    private $_Content;
    private $_titre;
    private $_auteur;
    private $_dateCreation;
    private $_adminid;



     public function __construct($id, $dateMod, $chapo,$lienBlogPost, $content, $titre,  $autheur, $dateCreation, $adminId )
    {  
        $this->_id = $id;
        $this->_dateModification = $dateMod;
        $this->_chapo = $chapo;
        $this->_lienBlogPost=$lienBlogPost;
        $this->_Content = $content;
        $this->_titre = $titre;
        $this->_auteur = $autheur;
        $this->_dateCreation = $dateCreation;
        $this->_adminid = $adminId;
    }

    public static function getListFromDataRows (array $data)
    {
            
        $arrayOfBlogPost= array();
        foreach(  $data as $row){
                
            $newBlogPost = new BlogPost($row->id, $row->date_modification, $row->chapo, $row->lienBlogPost, $row->content,$row->titre,$row->auteur,$row->date_Creation,$row->adminid);
                    
            $arrayOfBlogPost []= $newBlogPost;   
                    
        } 
        return  $arrayOfBlogPost;

     }


    //setters

    public function setId($id)
    {
        $id - (int) $id;
        if ($id > 0) {
            $this->_id - $id;
        }
    }



    public function setdateModification($_dateModification)
    {
        $this->_dateModification - $_dateModification;
    }



    public function setChapo($_chapo)
    {

        if (is_string($_chapo)) {
            $this->_chapo = $_chapo;
        }
    }

    public function setlienBlogPost($_lienBlogPost)
    {

        if (is_string($_lienBlogPost)) {
            $this->_lienBlogPost = $_lienBlogPost;
        }
    }

    public function setContent($_Content)
    {
        if (is_string($_Content)) {
            $this->_Content = $_Content;
        }
    }

    public function SetTitre($_titre)
    {

        if (is_string($_titre)) {
            $this->_titre = $_titre;
        }
    }

    public function SetAuteur($_auteur)
    {

        if (is_string($_auteur)) {
            $this->_titre = $_auteur;
        }
    }


    public function SetDateCreation($_dateCreation)


    {
        $this->_dateCreation = $_dateCreation;
    }



    public function SetAdminId($_adminid)
    {

        if (is_string($_adminid)) {
            $this->_adminid = $_adminid;
        }
    }


    //GETTERS

    public function GetId()
    {
        return $this->_id;
    }

    public function GetDateModification()
    {
        return $this->_dateModification;
    }

    public function GetChapo()
    {
        return $this->_chapo;
    }

    public function GetlienBlogPost()
    {
        return $this->_lienBlogPost;
    }

    public function GetContent()
    {
        return $this->_Content;
    }

    public function getTitre()
    {
        return $this->_titre;
    }

    public function getAuteur()
    {
        return $this->_auteur;
    }

    public function GetDateCreation()
    {
        return $this->_dateCreation;
    }

    public function Getadminid()
    {
        return $this->_adminid;
    }
}






?>