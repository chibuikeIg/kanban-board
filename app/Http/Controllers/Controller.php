<?php

namespace App\Http\Controllers;

use App\Models\AccessToken;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Spatie\DbDumper\Databases\MySql;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function exportDB()
    {
        MySql::create()
            ->setDumpBinaryPath('C:\xampp\mysql\bin')
            ->setDbName(env('DB_DATABASE'))
            ->setUserName(env('DB_USERNAME'))
            ->setPassword(env('DB_PASSWORD'))
            ->setHost(env('DB_HOST'))
            ->dumpToFile('storage/kanban_board.sql');
    }

    public function generateAccessToken()
    {
        $access_token = AccessToken::create([
            'token' => Str::random(100),
        ]);

        return response()->json(['token' => $access_token->token]);
    }
}
