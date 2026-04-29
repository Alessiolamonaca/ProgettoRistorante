<?php

namespace Tests\Feature;

use Tests\TestCase;

class PagePresentationTest extends TestCase
{
    public function test_home_page_renders_the_editorial_feature_blocks(): void
    {
        $response = $this->get('/it');

        $response->assertOk();
        $response->assertSee(trans('pages.home.info_kicker', [], 'it'));
        $response->assertSee(trans('pages.home.book_detail', [], 'it'));
        $response->assertSee('home-feature-shot-stack', false);
    }

    public function test_restaurant_page_renders_the_enhanced_fact_cards(): void
    {
        $response = $this->get('/it/ristorante');

        $response->assertOk();
        $response->assertSee(trans('pages.restaurant.room_kicker', [], 'it'));
        $response->assertSee(trans('pages.restaurant.facts_hospitality_label', [], 'it'));
        $response->assertSee('restaurant-fact-text', false);
        $response->assertSee('data-collapse-on-scroll', false);
    }

    public function test_contacts_page_renders_booking_guidance(): void
    {
        $response = $this->get('/it/contatti');

        $response->assertOk();
        $response->assertSee(trans('pages.contacts.services_title', [], 'it'));
        $response->assertSee(trans('pages.contacts.form_tips_title', [], 'it'));
        $response->assertSee('contact-card-actions', false);
        $response->assertSee('data-collapse-on-scroll', false);
    }
}
