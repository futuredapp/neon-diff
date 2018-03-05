<?php

use NeonDiff\NeonDiff;
use PHPUnit\Framework\TestCase;

class BooleanTest extends TestCase
{
  private $neonDiff;

  /**
   * @throws \NeonDiff\NeonDiffException
   */
  public function setUp()
  {
    $this->neonDiff = new NeonDiff;
    $this->neonDiff->setTemplateFile(__DIR__ . '/fixtures/boolean/template.neon');
    $this->neonDiff->setNeonFile(__DIR__ . '/fixtures/boolean/file.neon');
  }

  public function test()
  {
    $this->assertNull($this->neonDiff->diff());
  }
}