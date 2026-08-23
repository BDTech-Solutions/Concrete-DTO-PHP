<?php

namespace BdtechSolutions\ConcreteDto\Contracts;

interface DTOTo
{
  /**
   * Convert the given DTO into a custom data type
   * @param mixed $dto
   * @return mixed
   */
  public static function handle(mixed $dto): mixed;
}
