<?php
use GuzzleHttp\Client;
defined('BASEPATH') or exit('No direct script allowed');

class Utama_model extends CI_Model {

    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => base_url('api/')
        ]);
    }

    public function getDatas($uri, $where = NULL, $id = NULL)
    {
        if ($where === NULL && $id === NULL) {
            $response = $this->_client->request('GET', $uri, [
                'query' => [
                    'token' => 'Da0sxRC4'
                ]
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } else {
            $response = $this->_client->request('GET', $uri, [
                'query' => [
                    'token' => 'Da0sxRC4',
                    $where => $id
                ]
            ]);
            return json_decode($response->getBody()->getContents(), true);
        }
    }

    public function insertData($uri)
    {
        $data = [
            'token' => 'Da0sxRC4',
            'menu' => $this->input->post('menu', TRUE)
        ];
        $response = $this->_client->request('POST', $uri, [
            'form_params' => $data
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function deleteData($uri)
    {
        $data = [
            'token' => 'Da0sxRC4',
            'id' => $this->uri->segment(3)
        ];
        $response = $this->_client->request('DELETE', $uri, [
            'form_params' => $data
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}