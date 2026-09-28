<?php

namespace Tests\Feature;

use App\Domains\Invoice\Entities\Invoice\InvoiceEntity;
use App\Domains\Invoice\Exceptions\Invoice\InvalidPaymentAmountException;
use App\Domains\Invoice\Exceptions\Invoice\InvoiceNotPayableException;
use App\Domains\Invoice\Repositories\Contracts\Invoice\InvoiceRepositoryInterface;
use App\Domains\Invoice\Services\Invoice\InvoiceService;
use App\Domains\Payment\DTOs\Payment\PaymentDTO;
use App\Domains\Payment\Entities\Payment\PaymentEntity;
use App\Domains\Payment\Enums\PaymentMethodEnum;
use App\Domains\Payment\Repositories\Contracts\Payment\PaymentRepositoryInterface;
use App\Domains\Payment\Services\Paymob\PaymobService;
use App\Domains\Payment\UseCases\CreateCardPaymentUseCase\CreateCardPaymentUseCase;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\DataProvider;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class CreateCardPaymentUseCaseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_creates_card_payment_successfully(): void
    {
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        $paymentRepo = $this->createMock(
            PaymentRepositoryInterface::class
        );

        $invoiceRepo = $this->createMock(
            InvoiceRepositoryInterface::class
        );

        $invoiceService = $this->createMock(
            InvoiceService::class
        );

        $paymobService = $this->createMock(
            PaymobService::class
        );

        $dto = new PaymentDTO(
            PaymentMethodEnum::CARD,
            1000
        );


        $paymentEntity = $this->createMock(PaymentEntity::class);

        $invoiceEntity = $this->createMock(InvoiceEntity::class);
        $invoice = $this->createMock(Invoice::class);


        $invoiceRepo
            ->expects($this->once())
            ->method('findByEntity')
            ->with(10)
            ->willReturn($invoiceEntity);

        $invoiceRepo
            ->expects($this->once())
            ->method('find')
            ->with(10)
            ->willReturn($invoice);

        $invoiceService->expects($this->once())
            ->method('calculatePaymentImpact')
            ->with($invoice, $dto->amount);


        $paymobService->expects($this->once())
            ->method('createPaymentIntention')
            ->with($dto->amount, $this->isString())
            ->willReturn([
                'paymob_intention_id' => 'intention-123',
                'paymob_order_id' => 456,
                'client_secret' => 'secret-xyz',
            ]);

        $paymentRepo->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(PaymentEntity::class))
            ->willReturn($paymentEntity);

        // Act + Assert

        $useCase = new CreateCardPaymentUseCase(
            $paymentRepo,
            $invoiceRepo,
            $paymobService,
            $invoiceService
        );

        $result = $useCase->execute(10, $dto);

        $this->assertSame($paymentEntity, $result['payment']);
        $this->assertSame('secret-xyz', $result['client_secret']);
    }

    public function test_rejects_payment_when_invoice_is_not_payable(): void
    {
        $paymentRepo = $this->createMock(
            PaymentRepositoryInterface::class
        );

        $invoiceRepo = $this->createMock(
            InvoiceRepositoryInterface::class
        );

        $invoiceService = $this->createMock(
            InvoiceService::class
        );

        $paymobService = $this->createMock(
            PaymobService::class
        );

        $dto = new PaymentDTO(
            PaymentMethodEnum::CARD,
            1000
        );


        $invoiceRepo->expects($this->once())
            ->method('findByEntity')
            ->with(10)
            ->willReturn(null);


        $useCase = new CreateCardPaymentUseCase(
            $paymentRepo,
            $invoiceRepo,
            $paymobService,
            $invoiceService
        );

        $this->expectException(InvoiceNotPayableException::class);

        $useCase->execute(10, $dto);
    }

    public static function invalidPaymentAmountsProvider(): array
    {
        return [
            [0],
            [-1],
            [-500]
        ];
    }
    #[DataProvider('invalidPaymentAmountsProvider')]
    public function test_rejects_invalid_payment_amount(float $paymentAmount): void
    {
        $paymentRepo = $this->createMock(
            PaymentRepositoryInterface::class
        );

        $invoiceRepo = $this->createMock(
            InvoiceRepositoryInterface::class
        );

        $invoiceService = $this->createMock(
            InvoiceService::class
        );

        $paymobService = $this->createMock(
            PaymobService::class
        );

        $invoiceEntity = $this->createMock(InvoiceEntity::class);
        $invoice = $this->createMock(Invoice::class);



        $dto = new PaymentDTO(
            PaymentMethodEnum::CARD,
            $paymentAmount
        );

        $invoiceRepo->expects($this->once())
            ->method('findByEntity')
            ->with(10)
            ->willReturn($invoiceEntity);

        $invoiceRepo->expects($this->once())
            ->method('find')
            ->with(10)
            ->willReturn($invoice);

        $invoiceService->expects($this->once())
            ->method('calculatePaymentImpact')
            ->with($invoice, $dto->amount)
            ->willThrowException(new InvalidPaymentAmountException());

        $paymobService->expects($this->never())
            ->method('createPaymentIntention');

        $useCase = new CreateCardPaymentUseCase(
            $paymentRepo,
            $invoiceRepo,
            $paymobService,
            $invoiceService
        );

        $this->expectException(InvalidPaymentAmountException::class);

        $useCase->execute(10, $dto);
    }
}
