<?php

namespace App\Domains\Invoice\Exceptions\Invoice;

use App\Common\Exceptions\SystemException;

class PaymentAmountExceedsRemainingException extends SystemException {}
