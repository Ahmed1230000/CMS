<?php

use Livewire\Component;
use App\Domains\User\UseCases\User\DeleteUserUseCase;
use Livewire\Attributes\Layout;

new #[Layout('layouts.dashboard')] class extends Component
{
    public int $userId;

    protected DeleteUserUseCase $deleteUserUseCase;

    public function boot(DeleteUserUseCase $deleteUserUseCase): void
    {
        $this->deleteUserUseCase = $deleteUserUseCase;
    }

    public function delete(): void
    {
        $this->deleteUserUseCase->execute($this->userId);

        $this->dispatch(
            'notify',
            type: 'success',
            message: 'User deleted successfully.'
        );

        $this->dispatch('user-deleted');
    }
};
?>

<div>

    <button
        wire:click="delete"
        wire:confirm="Are you sure you want to delete this user?"
        class="rounded-lg bg-red-600 px-4 py-2 text-sm text-white transition hover:bg-red-700">

        Delete

    </button>

</div>