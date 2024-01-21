<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\UserAuthService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateUser()
    {
        $userAuthService = new UserAuthService();
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $user = $userAuthService->createUser($userData);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com'
        ]);

        $this->assertTrue(Hash::check('password', $user->password));
    }

    public function testLoginUserWithValidCredentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $userAuthService = new UserAuthService();

        $token = $userAuthService->loginUser([
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $this->assertNotNull($token);
    }

    public function testLoginUserWithInvalidCredentials()
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $userAuthService = new UserAuthService();

        $token = $userAuthService->loginUser([
            'email' => 'test@example.com',
            'password' => 'wrongpassword'
        ]);

        $this->assertNull($token);
    }
    
    public function testLogoutUser()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $userAuthService = new UserAuthService();
        $userAuthService->logoutUser($user);

        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'name' => 'TestToken'
        ]);
    }
}
