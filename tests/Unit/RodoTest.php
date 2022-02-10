<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Services\MailService;

class RodoTest extends TestCase
{
    public function testIsRodoSetCorrectly(): void {
        $this->assertEquals(MailService::setRodo(['rodo1' => true, 'rodo2' => true]), ['rodo1' => 'Zaakceptowane', 'rodo2' => 'Zaakceptowane']);
        $this->assertEquals(MailService::setRodo(['rodo1' => true, 'rodo2' => true, 'rodo3' => true]), ['rodo1' => 'Zaakceptowane', 'rodo2' => 'Zaakceptowane', 'rodo3' => true]);
        $this->assertEquals(MailService::setRodo(['rodo1' => false, 'rodo2' => false]), ['rodo1' => 'Niezaakceptowane', 'rodo2' => 'Niezaakceptowane']);
        $this->assertEquals(MailService::setRodo(['rodo1' => false, 'rodo2' => false]), ['rodo1' => 'Niezaakceptowane', 'rodo2' => 'Niezaakceptowane']);
        $this->assertEquals(MailService::setRodo(['rodo1' => true, 'rodo2' => false]), ['rodo1' => 'Zaakceptowane', 'rodo2' => 'Niezaakceptowane']);
        $this->assertEquals(MailService::setRodo(['rodo1' => false, 'rodo2' => true]), ['rodo1' => 'Niezaakceptowane', 'rodo2' => 'Zaakceptowane']);
    }
}
