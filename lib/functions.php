<?php
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * @return void
 */
function createTableTags(): void
{
    if (!Capsule::Schema()->hasTable('mod_tags')) {
        Capsule::schema()
            ->create(
                'mod_tags',
                function ($table) {
                    /** @var \Illuminate\Database\Schema\Blueprint $table */
                    $table->increments('id');
                    $table->string('tag');
                    $table->dateTime('created_at');
                }
            );
    }
}

/**
 * @return void
 */
function createTableTicketManager(): void
{
    if (!Capsule::Schema()->hasTable('mod_ticketManager')) {
        Capsule::schema()
            ->create(
                'mod_ticketManager',
                function ($table) {
                    /** @var \Illuminate\Database\Schema\Blueprint $table */
                    $table->increments('id');
                    $table->integer('ticket_id');
                    $table->string('status', 64);
                    $table->dateTime('created_at');
                }
            );
    }
}
