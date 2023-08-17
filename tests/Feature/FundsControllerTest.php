<?php

namespace Tests\Feature;

use App\Events\FundDuplicateWarning;
use App\Listeners\FundDuplicateWarningListener;
use App\Models\Fund;
use App\Models\FundManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class FundsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        Fund::factory()->count(3)->create();
        $response = $this->get('/api/funds');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [],
                'links' => [],
            ])
            ->assertJsonCount(3, 'data');
    }

    public function testSearchByName()
    {
        Fund::factory()->count(3)->create(['name' => 'any']);
        Fund::factory()->count(1)->create(['name' => 'test']);
        $fund = Fund::factory()->create();
        $response = $this->get('/api/funds?search=name:' . $fund->name);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'manager_id',
                    ]
                ],
                'links' => [],
            ])
            ->assertJsonCount(1, 'data');
    }

    public function testSearchByStartYear()
    {
        Fund::factory()->count(3)->create(['start_year' => 2020]);
        Fund::factory()->count(1)->create(['start_year' => 2023]);
        $response = $this->get('/api/funds?search=start_year:2023');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'manager_id',
                    ]
                ],
                'links' => [],
            ])
            ->assertJsonCount(1, 'data');
    }

    public function testSearchByManagerName()
    {
        $manager = FundManager::factory()->create(['name' => 'any']);
        Fund::factory()->count(3)->create(['manager_id' => $manager->id]);
        $fund = Fund::factory()->create();
        $response = $this->get('/api/funds?search=manager.name:' . $fund->manager->name);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'manager_id',
                    ]
                ],
                'links' => [],
            ])->assertJsonCount(1, 'data');
    }

    public function testSearchByManagerId()
    {
        $manager = FundManager::factory()->create();
        Fund::factory()->count(3)->create(['manager_id' => $manager->id]);
        $fund = Fund::factory()->create();
        $response = $this->get('/api/funds?search=manager.id:' . $fund->manager->id);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'manager_id',
                    ]
                ],
                'links' => [],
            ])->assertJsonCount(1, 'data');
    }

    public function testStore()
    {
        Event::fake();
        $data = Fund::factory()->make()->toArray();
        $this->assertDatabaseMissing('funds', $data);
        $response = $this->postJson('/api/funds', $data);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'manager_id',
            ]);
        $this->assertDatabaseHas('funds', $data);
        Event::assertDispatched(FundDuplicateWarning::class, 0);
    }

    public function testIfDuplicatedWarningIfDispatched()
    {
        Event::fake([FundDuplicateWarning::class]);
        $fundManager = FundManager::factory()->create();
        $fund = Fund::factory()->create(['manager_id' => $fundManager->id]);
        $data = [
            'name' => $fund->name,
            'manager_id' => $fundManager->id,
            'start_year' => $fund->start_year,
        ];
        $this->assertDatabaseCount('funds', 1);
        $response = $this->postJson('/api/funds', $data);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'manager_id',
            ]);
        $this->assertDatabaseHas('funds', $data);
        $this->assertDatabaseCount('funds', 2);
        Event::assertDispatched(FundDuplicateWarning::class, 1);
        Event::assertListening(
            FundDuplicateWarning::class,
            FundDuplicateWarningListener::class
        );
    }

    public function testShow()
    {
        $fund = Fund::factory()->create();
        $response = $this->get('/api/funds/' . $fund->id);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'manager_id',
                'companies',
                'aliases'
            ]);
    }

    public function testUpdate()
    {
        $fund = Fund::factory()->create();
        $data = [
            'name' => 'override name'
        ];
        $this->assertDatabaseHas('funds', ['name' => $fund->name]);
        $response = $this->putJson('/api/funds/' . $fund->id, $data);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
            ]);
        $this->assertDatabaseMissing('funds', ['name' => $fund->name]);
        $this->assertDatabaseHas('funds', $data);
    }

    public function testDestroy()
    {
        $fund = Fund::factory()->create();
        $this->assertDatabaseHas('funds', ['id' => $fund->id]);
        $response = $this->delete('/api/funds/' . $fund->id);
        $response->assertStatus(204);
        $this->assertDatabaseMissing('funds', ['id' => $fund->id]);
    }
}
