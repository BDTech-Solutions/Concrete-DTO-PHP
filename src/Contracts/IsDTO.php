<?php

namespace BdtechSolutions\ConcreteDto\Contracts;

interface IsDTO
{
  public static function fromArray(array $data): static;

  public static function fromJSON(string $json): static;

  public static function from(DTOFrom|string $conversor, mixed $dataToConvert): static;

  public function toArray(): array;

  public function toJson(): string;

  public function to(DTOTo|string $conversor): mixed;

  public function cloneWith(array $fields): static;

  public function except(array $keys): array;

  public static function validate(array $data): void;
}
