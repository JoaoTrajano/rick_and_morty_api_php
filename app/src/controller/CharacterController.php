// controllers/CharacterController.php

<?php

require_once 'app/src/models/CharacterModel.php';

class CharacterController {
    protected $characterModel;

    public function __construct() {
        $this->characterModel = new CharacterModel();
    }

    public function getAllCharacters() {
        $characters = $this->characterModel->getAllCharacters();
        $response = [
            'statusCode' => 200,
            'metadata' => $characters["info"],
            'value' => $characters["results"]
        ];
        echo json_encode($response);
    }

    public function getCharacterById($id) {
        $character = $this->characterModel->getCharacterById($id);
        if ($character) {
            $response = [
                'statusCode' => 200,
                'metadata' => $character["info"],
                'value' => $character["results"]
            ];
        } else {
            $response = [
                'statusCode' => 404,
                'metadata' => 'Character not found',
                'value' => null
            ];
        }
        echo json_encode($response);
    }

    public function getCharacterByName($name) {
        $characters = $this->characterModel->fetchCharactersByName($name);
        if ($characters) {
            $response = [
                'statusCode' => 200,
                'metadata' => $characters["info"],
                'value' => $characters["results"]
            ];
        } else {
            $response = [
                'statusCode' => 404,
                'metadata' => 'Character not found',
                'value' => null
            ];
        }
        echo json_encode($response);
    }

    public function getCharactersByStatus($status) {
        $characters = $this->characterModel->fetchCharactersByStatus($status);
        if ($characters) {
            $response = [
                'statusCode' => 200,
                'metadata' => $characters["info"],
                'value' => $characters["results"]
            ];
        } else {
            $response = [
                'statusCode' => 404,
                'metadata' => 'No characters found with the specified status',
                'value' => null
            ];
        }
        echo json_encode($response);
    }
}
