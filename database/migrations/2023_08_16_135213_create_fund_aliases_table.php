<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fund_aliases', function(Blueprint $table) {
            $table->increments('id');
            $table->string('alias');

            $table->integer('fund_id')->unsigned()->index();
            $table->foreign('fund_id')->references('id')->on('funds')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fund_aliases');
	}
};
