<?php

namespace Artiden\FootballCup\Test;

use Artiden\FootballCup\HumanTeam;
use PHPUnit\Framework\TestCase;

class HumanTeamTest extends TestCase
{
  private string $teamName = 'Test';

  protected function setUp(): void {
    $this->team = new HumanTeam($this->teamName);

    parent::setUp();
  }

  protected function tearDown(): void {
    $this->team = null;

    parent::tearDown();
  }

  public function testExceptionIsThrownOnGameTeamNameIsEmpty(): void {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('The team name can not be empty');
    $gameTeam = new HumanTeam('');
  }

  public function testExceptionIsThrownOnDecreasingScore(): void {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('Can not decrease score');
    $this->team->setScore(-1);
  }

  public function testTeamStartsFromZeroScore(): void {
    $this->assertEquals(0, $this->team->getScore());
  }

  public function testCanUpdateScore(): void {
    $this->assertEquals(0, $this->team->getScore());
    $this->team->setScore(5);
    $this->assertEquals(5, $this->team->getScore());
  }
}
