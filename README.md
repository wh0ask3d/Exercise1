
# Exercise 1 - Simple CRUD

<hr>

#### If you want to import the steam games library by link, you need to remove ```$json = File::get("resources/json/steam-games.json");``` and uncomment
```
/* 
$json = http::get("https://raw.githubusercontent.com/Sadness-TJK/Changed-SteamGamesList-json/main/steam-games.json");
*/
```
#### in the Steam_gamesSeeder.php file.

<hr>

#### To perform an import from a .json file into a database, use the command - ```php artisan db:seed --class=SteamGamesSeeder```

#### This is what the database should look like after import

![](https://i.imgur.com/KviWGw5.png)

<hr>

## Project files

<br>

### Migration file - database/migrations/2022_07_08_210437_create_games_table.php


```php
return new class extends Migration
{

    public function up()
    {
        Schema::create('steamgames', function (Blueprint $table) {
            $table->id();
            $table->string('appid');
            $table->string('name');
            $table->string('playtime_forever');
            $table->string('img_icon_url');
            $table->string('img_logo_url');
            $table->boolean('has_community_visible_stats');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('steamgames');
    }
};

```

### Seeder file - database/seeders/SteamGamesSeeder.php

```php
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
```

### Model File - Models/steamgames.php

```php
class SteamGames extends Model
{
    use HasFactory;

    protected $fillable = [
        'appid', 'name', 'playtime_forever', 'img_icon_url', 'img_logo_url', 'has_community_visible_stats',
    ];

}
```
