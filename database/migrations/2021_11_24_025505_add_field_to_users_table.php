<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_num')->after('email')->nullable();
            $table->string('gender')->after('email')->nullable();
            $table->string('user_level')->after('email')->default('USER');
            $table->string('born_date')->after('email')->nullable();
            $table->longText('address')->after('email')->nullable();
            $table->string('status')->after('email')->nullable();
            $table->string('last_studied')->after('email')->nullable();
            $table->string('emergency_num')->after('email')->nullable();
            $table->string('job')->after('email')->nullable();
            $table->string('agency')->after('email')->nullable();
            $table->longText('profile_photo')->after('email')->nullable();
            $table->longText('ktp_photo')->after('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone_num');
            $table->dropColumn('gender');
            $table->dropColumn('user_level');
            $table->dropColumn('born_date');
            $table->dropColumn('address');
            $table->dropColumn('status');
            $table->dropColumn('last_studied');
            $table->dropColumn('emergency_num');
            $table->dropColumn('job');
            $table->dropColumn('agency');
            $table->dropColumn('profile_photo');
            $table->dropColumn('ktp_photo');
        });
    }
}
