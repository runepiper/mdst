<?php
declare(strict_types=1);

namespace Tests\Unit;

use \DateTime;
use PHPUnit\Framework\TestCase;
use RP\MDSTService;

class MDSTServiceTest extends TestCase
{
    /** @test */
    public function generates_correct_dates_array(): void
    {
        $dates = MDSTService::generateDates();

        $this->assertIsArray($dates);
        $this->assertCount(100, $dates);
        $this->assertIsObject($dates[0]);
        $this->assertInstanceOf(DateTime::class, $dates[0]);
        $this->assertSame('07.02.2016', $dates[0]->format('d.m.Y'));
    }

    /** @test */
    public function generates_correct_ical_output(): void
    {
        $feed = MDSTService::render();

        $this->assertIsString($feed);
    }
}
