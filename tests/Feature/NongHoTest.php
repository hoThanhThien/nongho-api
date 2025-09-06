<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\NongHo;

class NongHoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_nongho()
    {
        NongHo::factory()->count(3)->create();

        $response = $this->getJson('/api/nonghos');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    /** @test */
    public function it_can_create_a_nongho()
    {
        $data = [
            'ten' => 'Nguyen Van A',
            'dia_chi' => '123 Đường A, Quận B',
        ];

        $response = $this->postJson('/api/nonghos', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('nong_hos', $data);
    }

    /** @test */
    public function it_can_show_a_nongho()
    {
        $nongho = NongHo::factory()->create();

        $response = $this->getJson('/api/nonghos/' . $nongho->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $nongho->id,
                     'ten' => $nongho->ten,
                     'dia_chi' => $nongho->dia_chi,
                 ]);
    }

    /** @test */
    public function it_can_update_a_nongho()
    {
        $nongho = NongHo::factory()->create();

        $updateData = [
            'ten' => 'Le Thi B',
            'dia_chi' => '456 Đường B, Quận C',
        ];

        $response = $this->putJson('/api/nonghos/' . $nongho->id, $updateData);

        $response->assertStatus(200)
                 ->assertJsonFragment($updateData);

        $this->assertDatabaseHas('nong_hos', $updateData);
    }

    /** @test */
    public function it_can_delete_a_nongho()
    {
        $nongho = NongHo::factory()->create();

        $response = $this->deleteJson('/api/nonghos/' . $nongho->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('nong_hos', ['id' => $nongho->id]);
    }
}
