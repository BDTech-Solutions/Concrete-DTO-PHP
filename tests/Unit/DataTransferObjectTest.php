<?php

use BdtechSolutions\ConcreteDto\DataTransferObject;

class UserDTO extends DataTransferObject
{
  public function __construct(public readonly string $name) {}
}

it('can init a data transfer object', function () {
  // init class with user name
  $userData = new UserDTO(name: "Daniels 🤗");
  // verify instance type
  expect($userData)->toBeInstanceOf(DataTransferObject::class);
  // verify name parameter
  expect($userData->name)->toBe($userData->name);
});
