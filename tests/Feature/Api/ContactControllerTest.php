<?php

namespace Tests\Feature\Api;

use App\Models\Api\Contact;
use App\Models\User;
use Database\Factories\Api\ContactFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetContactEndpoint()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['contacts']
        );

        $contact = Contact::factory()->create();
        $response = $this->get('/api/contacts/' . $contact->id);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    "success",
                    "data" => [
                        "id",
                        "user_id",
                        "name",
                        "email",
                        "estimates_gender",
                        "probability_gender",
                        "estimates_age",
                        "estimates_nationality",
                        "probability_nationality",
                        "mail_smtp_check",
                        "mail_role",
                        "mail_disposable",
                        "mail_free",
                        "created_at",
                        "updated_at"
                    ],
                    "message",
                ]);
    }

    public function testStoreApiContacts()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['contacts']
        );

        $header = 'name,email';
        $row1 = 'john doe,john.doe@gmail.com';
        $row2 = 'jane doe,jane.doe@gmail.com';

        $content = implode("\n", [$header, $row1, $row2]);

        $inputs = [
            'csv' =>
            UploadedFile::fake()->createWithContent(
                'users.csv',
                $content
            )
        ];

        $response = $this->post('/api/contacts', $inputs);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    "success",
                    "data" => [
                        [
                            "id",
                            "user_id",
                            "name",
                            "email",
                            "estimates_gender",
                            "probability_gender",
                            "estimates_age",
                            "estimates_nationality",
                            "probability_nationality",
                            "mail_smtp_check",
                            "mail_role",
                            "mail_disposable",
                            "mail_free",
                            "created_at",
                            "updated_at"
                        ]
                    ],
                    "message",
                ]);
    }

    public function testStoreApiContactsWithoutCsv()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['contacts']
        );

        $response = $this->post('/api/contacts');

        $response->assertStatus(404)
                ->assertJsonStructure([
                    "success",
                    "message",
                ]);
    }
    public function testDeleteApiContact()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['contacts']
        );

        $contact = Contact::factory()->create();

        $id = $contact->id;

        $response = $this->delete('/api/contacts/' . $id);
        $response->assertStatus(200);
    }
}
