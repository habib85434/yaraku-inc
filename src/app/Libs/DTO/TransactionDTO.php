<?php

namespace App\Libs\DTO;

class TransactionDTO extends DataTransferObject
{
    public $date;

    public $identification_number;

    public $user_type;

    public $operation_type;

    public $currency;

    public $amount;
}
