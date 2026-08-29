<?php

namespace App\Domains\Employee\UseCases\Employee;

use App\Common\ValueObjectSystem\EmailVO;
use App\Common\ValueObjectSystem\PasswordVO;
use App\Domains\Employee\DTOs\Employee\EmployeeDTO;
use App\Domains\Employee\Entities\Employee\EmployeeEntity;
use App\Domains\Employee\Repositories\Contracts\Employee\EmployeeRepositoryInterface;
use App\Domains\Identity\DTOs\Register\RegisterDTO;
use App\Domains\Identity\UseCases\RegisterUseCase\RegisterUseCase;
use Illuminate\Support\Facades\DB;

class CreateEmployeeUseCase
{
    public function __construct(
        protected EmployeeRepositoryInterface $repository,
        protected RegisterUseCase $registerUseCase
    ) {}

    public function execute(EmployeeDTO $dto): EmployeeEntity
    {
        return DB::transaction(function () use ($dto) {

            $email = EmailVO::from($dto->email);

            $password = PasswordVO::from($dto->password);

            $user = $this->registerUseCase->execute(
                new RegisterDTO(
                    $dto->name,
                    $email,
                    $password
                )
            );

            $employeeEntity = EmployeeEntity::create(
                user_id: $user->id,
                employee_number: $dto->employee_number,
                name: $dto->name,
                phone: $dto->phone,
                email: $dto->personal_email,
                gender: $dto->gender,
                date_of_birth: $dto->date_of_birth,
                national_id: $dto->national_id,
                address: $dto->address,
                hire_date: $dto->hire_date,
                job_title: $dto->job_title,
                is_active: $dto->is_active,
                created_by: auth()->id(),
            );

            return $this->repository->create($employeeEntity);
        });
    }
}
