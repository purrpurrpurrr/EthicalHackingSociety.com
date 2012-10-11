<?php

class Install_Database {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table){
			$table->increments('id');
			$table->string('email');
			$table->string('password');
			$table->string('student_id')->nullable();
			$table->string('name')->nullable();
			$table->boolean('paid')->default(false);
			$table->timestamps();
		});
		Schema::create('groups', function($table){
			$table->increments('id');
			$table->string('name');
			// First thing that came to mind, we may want to implement groups and privileges differently!
			$table->boolean('m_suggest');
			$table->boolean('m_approve');
			$table->boolean('m_remove');
			$table->boolean('m_edit');
			$table->boolean('m_hide');
			$table->boolean('m_show');
			$table->boolean('m_vote');
			$table->timestamps();
		});
		Schema::create('avatars', function($table){
			$table->increments('id');
			$table->string('file');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->timestamps();
		});
		Schema::create('articles', function($table){
			$table->increments('id');
			$table->string('title');
			$table->text('body');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->timestamps();
		});
		Schema::create('meetings', function($table){
			$table->increments('id');
			$table->string('title');
			$table->text('body');
			$table->timestamp('when')->nullable();
			$table->string('room')->nullable();
			$table->timestamps();
		});
		Schema::create('tags', function($table){
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});
		Schema::create('comments', function($table){
			$table->increments('id');
			$table->text('body');
			$table->integer('meeting_id')->unsigned()->nullable();
			$table->integer('article_id')->unsigned()->nullable();
			$table->foreign('meeting_id')->references('id')->on('meetings');
			$table->foreign('article_id')->references('id')->on('articles');
			$table->timestamps();
		});
		Schema::create('resources', function($table){
			$table->increments('id');
			$table->string('file');
			$table->string('comment')->nullable();
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->timestamps();
		});
		Schema::create('group_user', function($table){
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('group_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('group_id')->references('id')->on('groups');
			$table->timestamps();
		});
		Schema::create('article_tag', function($table){
			$table->increments('id');
			$table->integer('article_id')->unsigned();
			$table->integer('tag_id')->unsigned();
			$table->foreign('article_id')->references('id')->on('articles');
			$table->foreign('tag_id')->references('id')->on('tags');
			$table->timestamps();
		});
		Schema::create('meeting_tag', function($table){
			$table->increments('id');
			$table->integer('meeting_id')->unsigned();
			$table->integer('tag_id')->unsigned();
			$table->foreign('meeting_id')->references('id')->on('meetings');
			$table->foreign('tag_id')->references('id')->on('tags');
			$table->timestamps();
		});
		Schema::create('meeting_member', function($table){
			$table->increments('id');
			$table->integer('meeting_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->foreign('meeting_id')->references('id')->on('meetings');
			$table->foreign('user_id')->references('id')->on('users');
			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::query('delete from meeting_member');
		DB::query('delete from meeting_tag');
		DB::query('delete from article_tag');
		DB::query('delete from group_user');
		DB::query('delete from resources');
		DB::query('delete from comments');
		DB::query('delete from tags');
		DB::query('delete from meetings');
		DB::query('delete from articles');
		DB::query('delete from avatars');
		DB::query('delete from users');
		Schema::drop('meeting_member');
		Schema::drop('meeting_tag');
		Schema::drop('article_tag');
		Schema::drop('group_user');
		Schema::drop('resources');
		Schema::drop('comments');
		Schema::drop('tags');
		Schema::drop('meetings');
		Schema::drop('articles');
		Schema::drop('avatars');
		Schema::drop('users');
	}

}