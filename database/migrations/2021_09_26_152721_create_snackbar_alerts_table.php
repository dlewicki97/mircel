<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnackbarAlertsTable extends Migration
{
    private $columns = ['error', 'delete_comment', 'add_comment', 'mail_error', 'attachments_error', 'recaptcha_error', 'login_require', 'reservation_to_accept', 'add_to_cart', 'shop_items_error', 'photo_error', 'edit_account_success', 'delete_from_cart_question', 'order_success', 'login_success', 'register_success', 'validate', 'non_activated_account', 'blocked_user', 'user_exist', 'mail_success', 'title', 'activated_account_success', 'user_does_not_exist', 'password_reminder_success', 'password_error', 'change_password_success', 'lucky_number'];

    public function up()
    {
        Schema::create('snackbar_alerts', function (Blueprint $table) {
            $table->id();
            foreach ($this->columns as $column)  $table->text($column)->nullable();
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
        Schema::dropIfExists('snackbar_alerts');
    }
}
