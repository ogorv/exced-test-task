<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique('user_balances_user_id_uq');
            $table->decimal('balance')->default(0);
            $table->foreign('user_id', 'user_balances_user_id_fk')->references('id')->on('users');
            $table->engine = 'InnoDB';
        });

        Schema::create('user_balance_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount')->default(0);
            $table->enum('payment_type', ['deposit', 'withdraw']);
            $table->string('description')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('user_id', 'user_balance_history_user_id_fk')->references('id')->on('users');
            $table->index('user_id', 'user_balance_history_user_id_ix');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_balances', function(Blueprint $table) {
            $table->dropForeign('user_balances_user_id_fk');
        });
        Schema::dropIfExists('user_balances');

        Schema::table('user_balance_history', function(Blueprint $table) {
            $table->dropForeign('user_balance_history_user_id_fk');
        });
        Schema::dropIfExists('user_balance_history');
    }
};
