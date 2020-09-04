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

    public function getDatas($uri, $where = NULL)
    {
        if ($where === NULL) {
            $response = $this->_client->request('GET', $uri, [
                'query' => [
                    'token' => 'Da0sxRC4'
                ]
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } else {
            $where += ['token' => 'Da0sxRC4'];
            $response = $this->_client->request('GET', $uri, [
                'query' => $where
            ]);
            return json_decode($response->getBody()->getContents(), true);
        }
    }

    public function insertData($uri, $data)
    {
        $data += [
            'token' => 'Da0sxRC4'
        ];
        $response = $this->_client->request('POST', $uri, [
            'form_params' => $data
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function deleteData($uri, $data)
    {
        $data += [
            'token' => 'Da0sxRC4'
        ];
        $response = $this->_client->request('DELETE', $uri, [
            'form_params' => $data
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function updateData($uri, $data)
    {
        $data += [
            'token' => 'Da0sxRC4'
        ];
        $response = $this->_client->request('PUT', $uri, [
            'form_params' => $data
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}