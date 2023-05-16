<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('site_title');
            $table->string('favicon');
            $table->string('login_image');
            $table->timestamps();
        });

        // Setting::create([
        //     'site_title' => 'Demo Site',
        //     'logo' => 'img/logo.png',
        //     'login_image' => 'img/login-bg.jpg',
        //     'favicon' => 'img/favicon.ico',
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
