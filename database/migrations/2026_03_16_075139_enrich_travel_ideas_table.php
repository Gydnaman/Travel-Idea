<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnrichTravelIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travel_ideas', function (Blueprint $table) {
            $table->text('description')->nullable()->after('title');
            $table->decimal('budget', 10, 2)->nullable()->after('destination');
            $table->string('image_url')->nullable()->after('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travel_ideas', function (Blueprint $table) {
            $table->dropColumn(['description', 'budget', 'image_url']);
        });
    }
}
