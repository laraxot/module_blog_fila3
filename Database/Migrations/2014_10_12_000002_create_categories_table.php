<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateLiveuserUsersTable.
 */
class CreateCategoriesTable extends XotBaseMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table) : void {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->longText('description')->nullable();
                $table->boolean('is_visible')->default(false);
                $table->string('seo_title', 60)->nullable();
                $table->string('seo_description', 160)->nullable();
                $table->timestamps();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table) : void {
                // if (! $this->hasColumn('current_team_id')) {
                //    $table->foreignId('current_team_id')->nullable();
                // }
                // if (! $this->hasColumn('profile_photo_path')) {
                //    $table->string('profile_photo_path', 2048)->nullable();
                // }
            }
        );
    }
}
