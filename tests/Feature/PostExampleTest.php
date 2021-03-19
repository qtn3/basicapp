<?php

namespace Tests\Feature;

use App\Models\Post;
//use http\Client\Curl\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PostExampleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $post = Post::factory()->create();
        //Create 10 more posts
        $post1 = Post::factory()->count(20)->create();

        $post->title = 'Post Test';
        $post->save();

        //Create 10 more users
        $makeTenUsers = User::factory()->count(10)->create();
        $user = User::find(1);
        $user->name = 'Quang Nguyen';
        $user->save();

        /*
        //Mass Updates
        User::where('email_verified_at', '2021-02-28 23:50:21')
            ->update(['email'=>'qtn3@njit.edu']);
        */

        //Examining Attribute Changes
        $this->assertEquals(false,$post->isDirty());
        $this->assertEquals(false,$post->isDirty('title'));

        $this->assertEquals(true, $user->isClean());
        $this->assertEquals(true,$user->isClean('name'));

        //modify data using array
        $user = User::where ("id", 1)->first();
        $new_user_data = array("name"=>"Quang Nguyen","email"=>"qtn3@njit.edu");
        $user->fill($new_user_data);
        $user->save();

        $post = Post::where("user_id",2)->first();
        $new_post = array("title"=>"modify title name");
        $post->fill($new_post);
        $post->save();
    }
}
