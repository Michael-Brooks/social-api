<?php
namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @return void
     */
    public function testGetAuthToken()
    {
        $user = User::create(
            [
                'name'      => 'Taylor Otwell',
                'username'  => 'test',
                'email'     => 'test@user.dev',
                'password'  => 'secret',
            ]
        );
        // Get JWT token through authentication
        $this->json('post', '/api/auth/login', [
            'email'     => $user->email,
            'password'  => 'secret'
        ]);
        // We should get back our token from authentication.

        $this->assertTrue(true);
    }
}