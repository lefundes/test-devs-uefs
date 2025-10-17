<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    private UserService $userService;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->userRepository = new UserRepository(new User());
        $this->userService = new UserService($this->userRepository);
    }

    public function test_can_create_user(): void
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
        ];

        $user = $this->userService->createUser($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('john@example.com', $user->email);
        $this->assertTrue(password_verify('password123', $user->password));
    }

    public function test_can_get_user_by_id(): void
    {
        $user = User::factory()->create();

        $foundUser = $this->userService->getUserById($user->id);

        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($user->id, $foundUser->id);
    }

    public function test_can_update_user(): void
    {
        $user = User::factory()->create();

        $updateData = ['name' => 'Updated Name'];
        $result = $this->userService->updateUser($user->id, $updateData);

        $this->assertTrue($result);
        $this->assertEquals('Updated Name', $user->fresh()->name);
    }

    public function test_can_delete_user(): void
    {
        $user = User::factory()->create();

        $result = $this->userService->deleteUser($user->id);

        $this->assertTrue($result);
        $this->assertNull(User::find($user->id));
    }
}