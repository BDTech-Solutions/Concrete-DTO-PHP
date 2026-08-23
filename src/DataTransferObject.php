<?php

namespace BdtechSolutions\ConcreteDto;

abstract class DataTransferObject
{
  /**
   * Returns the data of DTO as array
   * @return array
   */
  public function toArray(): array
  {
    return get_object_vars($this);
  }
}
