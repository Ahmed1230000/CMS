<?php

use App\Domains\Identity\UseCases\LogoutUseCase\LogoutUseCase;
use Livewire\Component;

new class extends Component
{
    protected LogoutUseCase $logoutUseCase;

    public function boot(LogoutUseCase $logoutUseCase): void
    {
        $this->logoutUseCase = $logoutUseCase;
    }

    public function logout(): void
    {
        $this->logoutUseCase->execute();

        $this->redirectRoute('login');
    }
};
?>

<button
    wire:click="logout"
    class="rounded-lg bg-red-600 px-4 py-2 text-white">

    Logout

</button>