<?php
class BlogController
{
    private $id;
    private $titre;
    private $contenu;
    private $img;

    public function __construct($bid, $btitre, $bcontenu, $bimg)
    {
        $this->id = $bid;
        $this->titre = $btitre;
        $this->contenu = $bcontenu;
        $this->img = $bimg;
    }

    public function setId($bid)
    {
        $this->id = $bid;
    }

    public function setTitre($btitre)
    {
        $this->titre = $btitre;
    }

    public function setContenu($bcontenu)
    {
        $this->contenu = $bcontenu;
    }

    public function setImg($bimg)
    {
        $this->img = $bimg;
    }

    public function afficherTitre()
    {
        echo $this->titre;
    }

    public function afficherContenu()
    {
        echo $this->contenu;
    }

    public function afficherImg()
    {
        echo $this->img;
    }

    public function afficherId()
    {
        echo $this->id;
    }
}
