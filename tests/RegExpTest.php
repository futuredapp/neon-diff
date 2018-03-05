<?php

use NeonDiff\NeonDiff;
use PHPUnit\Framework\TestCase;

class RegExpTest extends TestCase
{
  private $neonDiff;

  /**
   * @throws \NeonDiff\NeonDiffException
   */
  public function setUp()
  {
    $this->neonDiff = new NeonDiff;
    $this->neonDiff->setTemplateFile(__DIR__ . '/fixtures/regexp/template.neon');
    $this->neonDiff->setNeonFile(__DIR__ . '/fixtures/regexp/file.neon');
  }

  public function test()
  {
    $this->assertNull($this->neonDiff->diff());
  }
}