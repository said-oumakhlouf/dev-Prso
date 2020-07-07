<?php 
namespace App\Models;

class Post
{
    private $reference;
    private $title;
    private $price;

    public function getReference(){return $this->reference;}
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    public function getTitle(){return $this->title;}
    public function setTitle($title){$this->title = $title;}

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

    }

    /**
     * @param [int] $percent
     */
    public function increasePrice($percent)
    {
        $this->price = $this->price * (1 + $percent /100);
    }

    public function decreasePrice($percent)
    {
        $this->price = $this->price * (1 - $percent /100);
    }
}