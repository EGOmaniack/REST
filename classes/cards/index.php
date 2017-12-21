<?php

class Cards {
    private $cards;
    private $DBcards;
    private $jsonCards;
    private $newCard;
    private $settings;

    public function __construct ($settings) {
        $this->settings = $settings;
        $this->DBcards = file_get_contents( "http://{$_SERVER['SERVER_NAME']}/pkbi/REST/v1/jsondb/cards.json");
        $this->DBcards = json_decode($this->DBcards, true);
    }
    public function getCards () {
        foreach ($this->DBcards as $card) {
            if(!$this->settings->production ||
                    $card['flowName'] !== "TestFlow" &&
                    $card['canIUse'] !== false ) {
                $this->newCard = [];
                $this->newCard['title'] = $card['title'];
                $this->newCard['pic'] = $card['pic'];
                $this->newCard['subTitle'] = $card['subTitle'];
                $this->newCard['inDeveloping'] = $card['inDeveloping'];
                $this->newCard['canIUse'] = $card['canIUse'];
                $this->newCard['shortDescription'] = $card['shortDescription'];
                $this->newCard['wayname'] = $card['wayName'];
        
                $this->cards[] = $this->newCard;
                unset($this->newCard);
            }
        };

        
//        $this->jsonCards = json_encode( $this->cards, JSON_UNESCAPED_UNICODE );
        return $this->cards;
    }
    public function getFullInfo($wayName) {
        
        foreach ($this->DBcards as $card) {
            if($card['wayName'] == $wayName){

                header("Access-Control-Allow-Origin: *");
                return $card;
            }
        }
            header("HTTP/1.0 406 Not Acceptable");
            die('Параметр wayName не найден');
    }
}

