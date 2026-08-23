<?php

use BdtechSolutions\ConcreteDto\Contracts\DTOFrom;
use BdtechSolutions\ConcreteDto\Contracts\DTOTo;
use BdtechSolutions\ConcreteDto\DataTransferObject;

// Declare a class to test dto abstract class
class UserDTO extends DataTransferObject
{
  public function __construct(public readonly string $name) {}
}

// Declare a conversor to test the "from" creation method
class UserFromRequestConversor implements DTOFrom
{
  public static function handle(mixed $data): mixed
  {
    return UserDTO::fromArray(['name' => $data['full_name']]);
  }
}

// Declare a conversor to test the "to" export method
class UserToPayloadConversor implements DTOTo
{
  public static function handle(mixed $dto): mixed
  {
    return ['converted_name' => $dto->name];
  }
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

it('can convert DTO data to array', function () {
  // convert to array
  $DTOasArray = $this->userData->toArray();
  // verify if is an array
  expect($DTOasArray)->toBeArray();
  // verify data integrity
  expect($DTOasArray['name'])->toBe('Daniels 🤗');
});

it('can convert DTO data to json', function () {
  $DTOasJson = $this->userData->toJson();
  expect($DTOasJson)->toBe('{"name":"Daniels \ud83e\udd17"}');
  var_dump($DTOasJson);
});

it('can init a data transfer object from array', function () {
  // build DTO from array
  $userFromArray = UserDTO::fromArray(['name' => 'Daniels 🤗']);
  // verify instance type
  expect($userFromArray)->toBeInstanceOf(UserDTO::class);
  // verify data integrity
  expect($userFromArray->name)->toBe('Daniels 🤗');
});

it('can init a data transfer object from json', function () {
  // build DTO from json
  $userFromJson = UserDTO::fromJSON('{"name":"Daniels 🤗"}');
  // verify instance type
  expect($userFromJson)->toBeInstanceOf(UserDTO::class);
  // verify data integrity
  expect($userFromJson->name)->toBe('Daniels 🤗');
});

it('can init a data transfer object from a custom conversor', function () {
  // build DTO through a custom "from" conversor
  $userFromConversor = UserDTO::from(UserFromRequestConversor::class, ['full_name' => 'Daniels 🤗']);
  // verify instance type
  expect($userFromConversor)->toBeInstanceOf(UserDTO::class);
  // verify data integrity
  expect($userFromConversor->name)->toBe('Daniels 🤗');
});

it('can convert DTO data to a custom type', function () {
  // convert DTO through a custom "to" conversor
  $converted = $this->userData->to(UserToPayloadConversor::class);
  // verify data integrity
  expect($converted)->toBe(['converted_name' => 'Daniels 🤗']);
});

it('can clone a DTO with updated values', function () {
  // clone DTO overriding the name
  $clonedUser = $this->userData->cloneWith(['name' => 'New Name']);
  // verify instance type
  expect($clonedUser)->toBeInstanceOf(UserDTO::class);
  // verify the clone has the updated value
  expect($clonedUser->name)->toBe('New Name');
  // verify the original DTO was not mutated
  expect($this->userData->name)->toBe('Daniels 🤗');
});

it('can get DTO data excluding specific keys', function () {
  // exclude the "name" key from the array representation
  $filtered = $this->userData->except(['name']);
  // verify the excluded key is not present
  expect($filtered)->not->toHaveKey('name');
});
