<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class ContactDebitTransactionInput
{
    use ObjectTrait;

    public ?int $contactId = null;
    public ?string $description = null;
    public ?int $accountId = null;
    public ?DateTimeInterface $date = null;
    public ?float $amount = null;
    public ?float $exchangeRate = null;
    public ?array $payableIds = null;

    public function toArray(): array
    {
        return self::clearToArray([
            'id' => $this->contactId,
            'type' => 'transactions',
            'attributes' => [
                'description' => $this->description,
                'account_id' => $this->accountId,
                'date' => $this->date instanceof DateTimeInterface ? $this->date->format('Y-m-d') : null,
                'amount' => $this->amount,
                'exchange_rate' => $this->exchangeRate,
                'payable_ids' => $this->payableIds,
            ],
        ]);
    }
}
