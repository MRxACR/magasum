<?php

namespace App\Custom\Class;

use App\Models\Article;




class ArticleCustom
{
    private $stock  = 0;
    private $prix_stock  = 0;

    private $entree = 0;
    private $entree_prix  = 0;

    private $sortie  = 0;
    private $sortie_prix  = 0;


    private Article $article;

    public function __construct(Article $article)
    {

        $this->article = $article;
        $this->entrees();
        $this->sorties();
        $this->stock();

        //dd($this->en_alert());
        
    }

    public function est_dispo($quantite = 0)
    {
        if($quantite == 0) return $this->stock > $quantite;
        else return $this->stock >= $quantite;
    }

    public function entrees()
    {
        $receptions = $this->article->receptions;
        $prix_total = 0;
        foreach ($receptions as $reception) {
            $this->entree +=  $reception->pivot->quantity;
            $prix_total +=  $receptions->last()->pivot->prix*$reception->pivot->quantity;
        }
        if ($this->entree != 0) 
        $this->entree_prix = $prix_total / $this->entree;
        else $this->entree_prix = 0;
    }

    public function sorties()
    {
        $sorties = $this->article->sorties;
        foreach ($sorties as $sorties) {
            $this->sortie +=  $sorties->pivot->quantity;
            $this->sortie_prix +=  $sorties->pivot->prix*$sorties->pivot->quantity;
        }
    }

    public function stock()
    {
        $this->stock = $this->entree - $this->sortie;
    }

    public function quantite_disp()
    {
        return $this->stock;
    }

    public function prix_stock()
    {
        return $this->entree_prix;
    }

    public function etat()
    {
        return $this->quantite_disp()/$this->article->qte_init * 100;
    }

    public function en_alert()
    {
        return $this->quantite_disp() < $this->article->qte_alt;
    }

    public function en_repture()
    {
        return $this->quantite_disp() <= 0;
    }





}