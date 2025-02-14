<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use mysqli;

class TempController extends Controller
{
public function deleteDb()
{
    $command = '/Applications/XAMPP/xamppfiles/bin/mysql -u root -e "DROP DATABASE clinics;"';
    exec($command);
}
}

