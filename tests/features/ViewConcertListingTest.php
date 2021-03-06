<?php

use App\Concert;
use Carbon\Carbon;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewConcertListingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    
    use DatabaseMigrations;
     
    /** @test */
    public function user_can_view_a_published_concert_listing()
    {
        $concert = factory(Concert::class, 'published')->create([
            'title' => 'The Road Chord',
            'subtitle' => 'with Animosity and Lethargy',
            'date' => Carbon::parse('December 13, 2017 8:00pm'),
            'ticket_price' => 3250,
            'venue' => 'The Mosh Pit',
            'venue_address' => '123 Example Lane',
            'city' => 'Laraville',
            'state' => 'ON',
            'zip' => '17916',
            'additional_information' => 'For tickets, call (555) 555-5555.',
        ]);
        
        $this->visit('/concerts/'.$concert->id);
        
        $this->see('The Road Chord');
        $this->see('with Animosity and Lethargy');
        $this->see('December 13, 2017');
        $this->see('8:00pm');
        $this->see('32.50');
        $this->see('The Mosh Pit');
        $this->see('123 Example Lane');
        $this->see('Laraville, ON 17916');
        $this->see('For tickets, call (555) 555-5555.');
    }
    
    /** @test */
    public function user_cannot_view_unpublished_concert_listings()
    {
        $concert = factory(Concert::class, 'unpublished')->create();
        
        $this->get('/concerts/'.$concert->id);
        
        $this->assertResponseStatus(404);
    }
}
