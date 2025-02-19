<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->unsignedBigInteger('member_id')->after('id'); // Add column
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade'); // Add foreign key
        });
    }

    public function down()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropForeign(['member_id']); // Remove foreign key constraint
            $table->dropColumn('member_id'); // Remove column
        });
    }
};
