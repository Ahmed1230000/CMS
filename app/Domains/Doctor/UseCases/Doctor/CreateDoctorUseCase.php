<?php

namespace App\Domains\Doctor\UseCases\Doctor;

use App\Common\ValueObjectSystem\EmailVO;
use App\Common\ValueObjectSystem\PasswordVO;
use App\Domains\Doctor\DTOs\Doctor\DoctorDTO;
use App\Domains\Doctor\Entities\Doctor\DoctorEntity;
use App\Domains\Doctor\Repositories\Contracts\Doctor\DoctorRepositoryInterface;
use App\Domains\Identity\DTOs\Register\RegisterDTO;
use App\Domains\Identity\UseCases\RegisterUseCase\RegisterUseCase;
use Illuminate\Support\Facades\DB;

class CreateDoctorUseCase
{
    public function __construct(
        protected DoctorRepositoryInterface $repository,
        protected RegisterUseCase $registerUseCase
    ) {}

    public function execute(DoctorDTO $dto): DoctorEntity
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

            $doctorEntity = DoctorEntity::create(
                user_id: $user->id,
                department_id: $dto->department_id,
                license_number: $dto->license_number,
                specialization: $dto->specialization,
                phone: $dto->phone,
                email: $dto->personal_email,
                bio: $dto->bio,
                is_active: $dto->is_active,
                created_by: auth()->id(),
            );

            return $this->repository->create($doctorEntity);
        });
    }
}
