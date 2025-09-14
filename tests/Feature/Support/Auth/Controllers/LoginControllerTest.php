<?php

declare(strict_types=1);

use App\Support\Manager\Controllers\LoginController;
use App\Support\Manager\Models\User;
use App\Support\Manager\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

describe('Feature test for LoginController', function () {
    it('should pass correct info to controller and receive response with token', function () {
        $email = fake()->safeEmail();
        $password = fake()->password(12);
        User::factory()->create([
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $controller = app()->make(LoginController::class);
        $request = new LoginRequest([
            'email' => $email,
            'password' => $password,
        ]);

        $response = $controller($request);

        $content = json_decode($response->content(), true);
        expect($response)
            ->toBeInstanceOf(JsonResponse::class)
            ->and($content)->toHaveKeys(['message', 'token']);
    });

    it('should pass correct info endpoint and receive response with token', function () {
        $email = fake()->safeEmail();
        $password = fake()->password(12);
        User::factory()->create([
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $this->postJson(route('login', [
            'email' => $email,
            'password' => $password,
        ]))->assertStatus(
            201,
        )->assertJsonStructure(['message', 'token']);
    });

    it('should pass incorrect info to controller and receive response for invalid user', function () {
        $email = fake()->safeEmail();
        User::factory()->create([
            'email' => $email,
            'password' => bcrypt(fake()->password(12)),
        ]);

        $controller = app()->make(LoginController::class);
        $request = new LoginRequest([
            'email' => $email,
            'password' => 'INVALID_INVALID',
        ]);

        $response = $controller($request);

        $content = json_decode($response->content(), true);
        expect($response)
            ->toBeInstanceOf(JsonResponse::class)
            ->and($content)->toHaveKeys(['message']);
    });

    it('should pass correct info endpoint and receive response with 422 code', function () {
        $email = fake()->safeEmail();
        User::factory()->create([
            'email' => $email,
            'password' => bcrypt(fake()->password(12)),
        ]);

        $this->postJson(route('login', [
            'email' => $email,
            'password' => 'INVALID_INVALID',
        ]))->assertStatus(
            422,
        )->assertJsonStructure(['message']);
    });
});
