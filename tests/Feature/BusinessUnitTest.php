<?php

namespace Tests\Feature;

use App\BusinessUnit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BusinessUnitTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function business_units_have_attributes()
    {
        $this->withoutExceptionHandling();

        $business = BusinessUnit::create([
            'name' => "Field Operations",
            'color' => "#0073ae",
        ]);

        $this->assertDatabaseHas('business_units', $business->toArray());

    }

    /**
     * @test
     */
    public function business_units_can_be_shown_on_a_page()
    {
        $this->withoutExceptionHandling();

        factory(BusinessUnit::class, 5)->create();

        $response = $this->get('/config');

        $response->assertViewIs('config.index');
        $response->assertViewHas('businessUnits');

    }

    /**
     * @test
     */
    public function business_units_can_be_created_from_post_request()
    {
        $this->withoutExceptionHandling();

        $unit = $this->raw(BusinessUnit::class);

        $response = $this->post('/businessunits', $unit);

        $this->assertDatabaseHas('business_units', $unit);
    }

    /**
     * @test
     */
    public function business_units_can_be_update_from_a_patch_request()
    {
        $this->withoutExceptionHandling();

        $unit = $this->create(BusinessUnit::class);

        $this->patch("/businessunits/{$unit->id}", [
            'name' => 'updated',
            'color' => '#ffffff',
        ]);

        $this->assertDatabaseHas('business_units', [
            'name' => 'updated',
            'color' => '#ffffff',
        ]);

    }

}
