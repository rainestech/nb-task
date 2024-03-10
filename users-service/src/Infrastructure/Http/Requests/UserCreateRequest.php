<?php

namespace App\Infrastructure\Http\Requests;

use App\Domain\Entity\UserEntity;
use App\Infrastructure\Domain\Commands\Users\CreateUserCommand;
use Symfony\Component\Validator\Constraints as Assert;

class UserCreateRequest implements UserRequestInterface
{
    public function __construct(
        ?string $firstName,
        ?string $lastName,
        ?string $email
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    #[
        Assert\NotBlank(
            message: 'First name is required'
        ),
        Assert\Length(
            min: 2,
            max: 100,
            minMessage: 'First name minimum length is 2',
            maxMessage: 'First name maximum length is 32'
        )
    ]
    protected string $firstName;

    #[
        Assert\NotBlank(
            message: 'Last name is required'
        ),
        Assert\Length(
            min: 2,
            max: 100,
            minMessage: 'Last name minimum length is 2',
            maxMessage: 'Last name maximum length is 32',
        )
    ]
    protected string $lastName;

    #[
        Assert\NotBlank(
            message: 'Email is required'
        ),
        Assert\Email(
            message: 'Email is not valid'
        ),
        Assert\Length(
            max: 100,
            maxMessage: 'Email maximum length is 100',
        )
    ]
    protected string $email;

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function toCommand()
    {
        return new CreateUserCommand(
            id: null,
            firstName: $this->firstName,
            lastName: $this->lastName,
            email: $this->email
        );
    }

}
