<?php

use BdtechSolutions\ConcreteDto\DataTransferObject;

// Declare a class to test dto abstract class
class UserDTO extends DataTransferObject
{
  public function __construct(public readonly string $name) {}
}

beforeEach(function () {
  // Init class with user name
  $this->userData = new UserDTO(name: "Daniels 🤗");
});

it('can init a data transfer object', function () {
  // Verify instance type
  expect($this->userData)->toBeInstanceOf(DataTransferObject::class);
  // Verify name parameter
  expect($this->userData->name)->toBe($this->userData->name);
});

it('can convert DTO data to an array', function () {
  // convert to array
  $DTOasArray = $this->userData->toArray();
  // verify if is an array
  expect($DTOasArray)->toBeArray();
  // verify data integrity
  expect($DTOasArray['name'])->toBe('Daniels 🤗');
});
