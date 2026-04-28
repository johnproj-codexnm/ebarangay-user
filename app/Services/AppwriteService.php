<?php

namespace App\Services;

use Appwrite\Client;
use Appwrite\Services\Databases;
use Appwrite\Services\Storage;

class AppwriteService
{

    public $databases;
    public $storage;

    public function __construct()
    {

        $client = new Client();

        $client
            ->setEndpoint(env('APPWRITE_ENDPOINT'))
            ->setProject(env('APPWRITE_PROJECT_ID'))
            ->setKey(env('APPWRITE_API_KEY'));

        $this->databases = new Databases($client);
        $this->storage = new Storage($client);

    }

    public function databaseId()
    {
        return env('APPWRITE_DATABASE_ID');
    }

}