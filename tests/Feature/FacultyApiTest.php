<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Faculty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class FacultyApiTest extends TestCase
{
    use refreshDatabase;

    /**
     * test creating a new faculty.
     * Using assertJasonPath(found in laravel 12 documentation) to see if json contains a specific value at a deep path
     */

    public function testCreatingFaculty(): void
    {
        $response = $this->postJson('/api/v1/faculties', [
            'name' => 'Test Faculyy',
            'description' => 'Test Faculty',
            'status' => 'active',
        ]);
        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Test Faculyy');
    }

    /**
     * test for retrieving the list of all the faculties.
     * I create some and then check if they appear in /api/v1/faculties
     */
    public function testGettingAllFaculties(): void
    {
        Faculty::create([
            'name' => 'gigivar',
            'description' => 'faculty description',
            'status' => 'active',
        ]);
        Faculty::create([
            'name' => 'giigiivar',
            'description' => 'gigi faculty description',
            'status' => 'inactive',
        ]);

        $response = $this->getJson('/api/v1/faculties');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'name' => 'gigivar',
            'description' => 'faculty description',
            'status' => 'active',
        ]);

        $response->assertJsonFragment([
            'name' => 'giigiivar',
            'description' => 'gigi faculty description',
            'status' => 'inactive',
        ]);
    }

    /**
    * same but for single faculty.
     */
    public function testRetrievingASingleFaculty(): void
    {
        $faculty = Faculty::create([
            'name' => 'enggggggggg',
            'description' => 'Engineering faculty',
            'status' => 'active',
        ]);

        $response = $this->getJson('/api/v1/faculties/' . $faculty->id);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $faculty->id,
                    'name' => 'enggggggggg',
                    'description' => 'Engineering faculty',
                    'status' => 'active',
                ],
            ]);
    }

    /**
     * Test updating an existing faculty.
     */
    public function testUpdatingAFaculty(): void
    {
        $faculty = Faculty::create([
            'name' => 'updatetest',
            'description' => 'updatetest faculty',
            'status' => 'active',
        ]);

        $response = $this->putJson('/api/v1/faculties/' . $faculty->id, [
            'name' => 'Business and Economics',
            'description' => 'Updated description',
            'status' => 'inactive',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Business and Economics')
            ->assertJsonPath('data.status', 'inactive');
    }

    /**
     * Test deleting a faculty.
     */
    public function testDeletingAFaculty(): void
    {
        $faculty = Faculty::create([
            'name' => 'testfordeletion',
            'description' => 'testfordeletion faculty',
            'status' => 'active',
        ]);

        $response = $this->deleteJson('/api/v1/faculties/' . $faculty->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('faculties', ['id' => $faculty->id]);
    }

    public function test_database_connection_check()
    {
        $dbName = DB::connection()->getDatabaseName();

        echo "\n=================================";
        echo "\nCurrent Database: " . $dbName;
        echo "\n=================================\n";



        $this->assertEquals('testing_db', $dbName);
    }
}
