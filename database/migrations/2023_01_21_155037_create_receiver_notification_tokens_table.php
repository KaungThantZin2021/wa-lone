<?php

use Illuminate\Support\Facades\Schema;
use App\Models\ReceiverNotificationToken;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiverNotificationTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiver_notification_tokens', function (Blueprint $table) {
            $table->id();
            $table->uuid('receivable_id')->nullable();
            $table->string('receivable_type')->nullable();
            $table->text('token')->nullable();
            $table->string('service_provider')->nullable();
            $table->enum('platform', ReceiverNotificationToken::PLATFORM);
            $table->string('source_client')->nullable();
            $table->string('ip')->nullable();
            $table->timestamp('expire_at')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('receiver_notification_tokens');
    }
}
