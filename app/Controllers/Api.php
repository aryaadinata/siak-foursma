<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\UserModel;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\TahunModel;
use App\Models\PtkModel;
use App\Libraries\Hash;

class Api extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function siswa()
    {
    }
}
