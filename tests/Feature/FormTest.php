<?php

namespace Tests\Feature;

use App\Http\Livewire\Posthandler;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;


class FormTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_create_post()
    {
        $user = User::factory()->create();
        
        $this->actingAs($user);

        Livewire::test(Posthandler::class)
            ->set('title', 'This is a test post')
            ->set('postContent', 'This is a test content')
            ->call('submitPost');

        $this->assertTrue(Post::where('title','This is a test post')->exists());
    }

    function test_title_is_required()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(Posthandler::class)
            ->set('title', '')
            ->call('submitPost')
            ->assertHasErrors(['title' => 'required']);
    }
}
