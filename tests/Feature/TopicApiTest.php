<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Topic;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopicApiTest extends TestCase
{
    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    public function testStoreTopic()
    {
        $data = ['category_id'=>1,'body'=>'test body','title'=>'test title'];
        $token = \Auth::guard('api')->fromUser($this->user);
        $response = $this->withHeaders(['Authorization'=>'Bearer '.$token])->json('POST','/api/topics',$data);

        $assertData = [
            'category_id'=>1,
            'user_id'=>$this->user->id,
            'title'=>'test title',
            'body'=>clean('test body','user_topic_body')
        ];

        $response->assertStatus(201)->assertJsonFragment($assertData)];
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
}
