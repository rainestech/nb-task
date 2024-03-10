<?php

namespace App\Infrastructure\Delivery;

use App\Application\Services\Validation\UserRequestValidator;
use App\Infrastructure\Http\Requests\UserCreateRequest;
use App\Infrastructure\Http\Responses\UserCreatedResponse;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateUserController extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $commandBus,
        private readonly LoggerInterface $logger,
        private readonly ValidatorInterface $validator,
    )
    {
    }

    #[Route('/users', name: 'api_users', methods: ['POST'])]
    public function createUsers(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent());
        if (!$data) {
            return new JsonResponse(
                [
                    "message" => 'Empty Request Body',
                    "errors" => [
                        'body' => 'request body can not be empty'
                    ],
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        $userRequest = new UserCreateRequest(
            firstName: $data->firstName,
            lastName: $data->lastName,
            email: $data->email,
        );

        $requestValidator = new UserRequestValidator($this->validator);
        $error = $requestValidator->validate($userRequest);
        if ($error) {
            return $error->sendErrors();
        }

        try {
            $envelope = $this->commandBus->dispatch($userRequest->toCommand());
            $handledStamp = $envelope->last(HandledStamp::class);
            return (new UserCreatedResponse($handledStamp->getResult()))->respond();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return new JsonResponse([
                    'message' => $e->getMessage()
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
