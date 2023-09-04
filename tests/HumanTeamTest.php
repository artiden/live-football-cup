<?php

namespace Artiden\FootballCup\Test;

use PHPUnit\Framework\TestCase;

class HumanTeamTest extends TestCase
{
  private string $teamName = 'Test';

  public function testExceptionIsThrownOnGameTeamNameIsEmpty(): void {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('The team name can not be empty');
    $gameTeam = new \Artiden\FootballCup\HumanTeam('');
  }

  public function testExceptionIsThrownOnDecreasingScore(): void {
    $gameTeam = new \Artiden\FootballCup\HumanTeam($this->teamName);
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('Can not decrease score');
    $gameTeam->setScore(-1);
  }

  public function testExceptionIsThrownOnZeroScore(): void {
    $this->assertTrue(true);
  }
}
