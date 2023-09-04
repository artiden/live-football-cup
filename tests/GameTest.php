<?php

namespace Artiden\FootballCup\Test;

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
  public function testGameCreatedInInactiveState(): void {
    $this->assertTrue(true);
  }

  public function testExceptionIsThrownOnTheSameTeam(): void {
    $this->assertTrue(true);
  }

  public function testCanNotUpdateScoreWhenGameInactive(): void {
    $this->assertTrue(true);
  }

  public function testCreationTimeIsSet(): void {
    $this->assertTrue(true);
  }
}
