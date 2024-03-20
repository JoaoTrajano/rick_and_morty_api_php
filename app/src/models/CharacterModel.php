<?php

class CharacterModel {
    public function getAllCharacters() {
        $url = "https://rickandmortyapi.com/api/character/";
        return $this->makeRequest($url);
    }

    public function getCharacterById($id) {
        var_dump($id);
        $url = "https://rickandmortyapi.com/api/character/$id";
        return $this->makeRequest($url);
    }


    public function fetchCharactersByName($name)
    {
        $url = "https://rickandmortyapi.com/api/character/?name=$name" ;
        return $this->makeRequest($url);
    }

    public function fetchCharactersByStatus($status)
    {
        
        $url = "https://rickandmortyapi.com/api/character/?status=$status";
        return $this->makeRequest($url);
    }

    private function makeRequest($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}


