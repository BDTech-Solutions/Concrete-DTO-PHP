<?php

namespace BdtechSolutions\ConcreteDto\Contracts;

interface DTOFrom
{
  /**
   * Convert the given data into a DTO
   * @param mixed $data
   * @return mixed
   */
  public static function handle(mixed $data): mixed;
}
