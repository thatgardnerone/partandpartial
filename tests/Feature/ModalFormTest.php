<?php

// e.g post updated

use App\Models\Post;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\assertDatabaseEmpty;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\withoutExceptionHandling;

it('loads the base page', function () {
    get(route('modal-form.index'))
        ->assertOk();
});

it('passes the post prop', function () {
    Post::factory()->create([
        'title' => 'Post Title',
        'body'  => 'Some body text',
    ]);

    get(route('modal-form.index'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('ModalForm')
            ->has('post', fn (Assert $post) => $post
                ->where('title', 'Post Title')
                ->where('body', 'Some body text')
                ->etc()
            )
        );
});

it('saves the post updates', function () {
    assertDatabaseEmpty('posts');

    $post = Post::factory()->create([
        'title' => 'Post Title',
        'body'  => 'Some body text',
    ]);

    post(route('modal-form.update', $post), [
        'title' => 'New Post Title',
        'body'  => 'New body text',
    ])->assertRedirect(route('modal-form.index'));

    assertDatabaseHas('posts', [
        'title' => 'New Post Title',
        'body'  => 'New body text',
    ]);
});

it('lazy loads the data component', function () {
    // get the route with a partial lazy load to emulate Inertia's router "only" method
});
