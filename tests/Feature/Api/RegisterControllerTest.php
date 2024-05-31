<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testRegisterUser(): void
    {
        $this->createPersonalClient();

        $password = Hash::make('test');
        $inputs = [
            'name' => 'Leidi',
            'email' => 'leidi@test.com',
            'password' => $password,
            'c_password' => $password,
        ];

        $response = $this->post('/api/register', $inputs);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'data' => [
                        'token',
                        'name',
                    ],
                    'message',
                ]);
    }

    protected function createPersonalClient()
    {
        Passport::$hashesClientSecrets = false;

        $this->artisan(
            'passport:client',
            ['--name' => config('app.name'), '--personal' => null]
        );

        // use the query builder instead of the model, to retrieve the client secret
        return DB::table('oauth_clients')
            ->where('personal_access_client','=',true)
            ->first();
    }
}
