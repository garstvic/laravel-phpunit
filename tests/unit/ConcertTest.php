<?php

use App\Concert;
use Carbon\Carbon;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConcertTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     
    use DatabaseMigrations;
     
    /** @test */
    public function can_get_formatted_date()
    {
        // Create a concert with a know date
        $concert = factory(Concert::class)->create([
            'date' => Carbon::parse('2017-12-01 8:00pm'),
        ]);
        
        // Retrieve the formatted date
        $date = $concert->formatted_date;
        
        // Verify the date is formatted as expected
        $this->assertEquals('December 1, 2017', $date);
    }
}