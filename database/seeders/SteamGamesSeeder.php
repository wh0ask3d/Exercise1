<?php

namespace Database\Seeders;

use App\Models\steamgame;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SteamGamesSeeder extends Seeder
{
    public function run()
    {
        steamgame::truncate();
        /*
        $json = http::get("https://raw.githubusercontent.com/Sadness-TJK/Changed-SteamGamesList-json/main/steam-games.json");
        */
        $json = File::get("resources/json/steam-games.json");
        $Steam_Games_json = json_decode($json);

        foreach ($Steam_Games_json as $value) {
            steamgame::create([
                "appid" => $value->appid,
                "name" => $value->name,
                "playtime_forever" => $value->playtime_forever,
                "img_icon_url" => $value->img_icon_url,
                "img_logo_url" => $value->img_logo_url,
                "has_community_visible_stats" => $value->has_community_visible_stats??null,
            ]);
        }
    }
}
