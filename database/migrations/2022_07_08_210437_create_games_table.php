<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->boolean('has_community_visible_stats')->nullable();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('steamgames');
    }
};
