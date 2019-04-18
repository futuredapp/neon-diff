<?php

namespace NeonDiff;

use Nette\Neon\Neon;

class NeonDiff
{
  /**
   * @var array
   */
  private $template;

  /**
   * @var array
   */
  private $neon;

  /**
   * @throws NeonDiffException
   */
  public function diff(): void
  {
    $this->diffArray(null, $this->template, $this->neon);
  }

  /**
   * @throws NeonDiffException
   */
  private function diffArray($templateKey, $templateValue, $neonValue): void
  {
    if (is_array($templateValue)) {
      foreach ($templateValue as $k => $v) {
        if (!array_key_exists($k, $neonValue)) {
          throw new NeonDiffException(sprintf('Key `%s` is missing in neon file!' . PHP_EOL, $k));
        }
        $this->diffArray($k, $v, $neonValue[$k]);
      }
    } elseif (is_string($templateValue)) {
      if (substr($templateValue, 0, 1) === '~') { // It's regular
        if (!preg_match($templateValue, $neonValue)) {
          throw new NeonDiffException(sprintf('Key `%s` does not match regular `%s` (%s)!' . PHP_EOL, $templateKey,
            $templateValue, $neonValue));
        }
      } elseif ($templateValue !== $neonValue) {
        throw new NeonDiffException(sprintf('Key `%s` has invalid value (`%s` != `%s`)!' . PHP_EOL, $templateKey,
          $templateValue, $neonValue));
      }
    } elseif (is_bool($templateValue)) {
      if ($templateValue !== $neonValue) {
        throw new NeonDiffException(sprintf('Key `%s` has invalid value (`%s` != `%s`)!' . PHP_EOL, $templateKey,
          $templateValue, $neonValue));
      }
    }
  }

  /**
   * @throws NeonDiffException
   */
  public function setNeonFile(string $neonFile): void
  {
    if (!($this->neon = Neon::decode(file_get_contents($neonFile)))) {
      throw new NeonDiffException(sprintf('Invalid Neon file!' . PHP_EOL));
    }
  }

  /**
   * @throws NeonDiffException
   */
  public function setTemplateFile(string $templateFile): void
  {
    if (!($this->template = Neon::decode(file_get_contents($templateFile)))) {
      throw new NeonDiffException(sprintf('Invalid template file!' . PHP_EOL));
    }
  }
}
