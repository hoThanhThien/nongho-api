<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\CayTrong;
use App\Models\ThuaDat;
use App\Models\NongHo;

class CayTrongTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_caytrong()
    {
        // Tạo dữ liệu test
        $nongho = NongHo::factory()->create();
        $thuadat = ThuaDat::factory()->create(['nongho_id' => $nongho->id]);
        CayTrong::factory()->count(3)->create(['thuadat_id' => $thuadat->id]);

        $response = $this->getJson('/api/caytrong');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    /** @test */
    public function it_can_create_a_caytrong()
    {
        $nongho = NongHo::factory()->create();
        $thuadat = ThuaDat::factory()->create(['nongho_id' => $nongho->id]);

        $data = [
            'ten_cay' => 'Lúa',
            'giong' => 'IR64',
            'thuadat_id' => $thuadat->id,
        ];

        $response = $this->postJson('/api/caytrong', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('cay_trongs', $data);
    }

    /** @test */
    public function it_can_show_a_caytrong()
    {
        $nongho = NongHo::factory()->create();
        $thuadat = ThuaDat::factory()->create(['nongho_id' => $nongho->id]);
        $caytrong = CayTrong::factory()->create(['thuadat_id' => $thuadat->id]);

        $response = $this->getJson("/api/caytrong/{$caytrong->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $caytrong->id,
                     'ten_cay' => $caytrong->ten_cay,
                     'giong' => $caytrong->giong,
                 ]);
    }

    /** @test */
    public function it_can_update_a_caytrong()
    {
        $nongho = NongHo::factory()->create();
        $thuadat = ThuaDat::factory()->create(['nongho_id' => $nongho->id]);
        $caytrong = CayTrong::factory()->create(['thuadat_id' => $thuadat->id]);

        $updatedData = [
            'giong' => 'OM380',
        ];

        $response = $this->patchJson("/api/caytrong/{$caytrong->id}", $updatedData);

        $response->assertStatus(200)
                 ->assertJsonFragment($updatedData);

        $this->assertDatabaseHas('cay_trongs', [
            'id' => $caytrong->id,
            'giong' => 'OM380',
        ]);
    }

    /** @test */
    public function it_can_delete_a_caytrong()
    {
        $nongho = NongHo::factory()->create();
        $thuadat = ThuaDat::factory()->create(['nongho_id' => $nongho->id]);
        $caytrong = CayTrong::factory()->create(['thuadat_id' => $thuadat->id]);

        $response = $this->deleteJson("/api/caytrong/{$caytrong->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('cay_trongs', [
            'id' => $caytrong->id,
        ]);
    }

    /** @test */
    public function it_validates_required_fields_when_creating_caytrong()
    {
        $response = $this->postJson('/api/caytrong', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['giong', 'thuadat_id']);
    }

    /** @test */
    public function it_validates_thuadat_exists_when_creating_caytrong()
    {
        $data = [
            'ten_cay' => 'Lúa',
            'giong' => 'IR64',
            'thuadat_id' => 999, // ID không tồn tại
        ];

        $response = $this->postJson('/api/caytrong', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['thuadat_id']);
    }

    /** @test */
    public function it_returns_404_when_caytrong_not_found()
    {
        $response = $this->getJson('/api/caytrong/999');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_includes_thuadat_relation_when_listing_caytrong()
    {
        $nongho = NongHo::factory()->create();
        $thuadat = ThuaDat::factory()->create(['nongho_id' => $nongho->id]);
        $caytrong = CayTrong::factory()->create(['thuadat_id' => $thuadat->id]);

        $response = $this->getJson('/api/caytrong');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'id',
                         'ten_cay',
                         'giong',
                         'thuadat_id',
                         'thua_dat' => [
                             'id',
                             'ten_thua',
                         ],
                         'created_at',
                         'updated_at',
                     ]
                 ]);
    }
}
