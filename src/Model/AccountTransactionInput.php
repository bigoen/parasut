<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use Bigoen\Parasut\Constant\DataTypeConstant;
use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class AccountTransactionInput
{
    use ObjectTrait;

    public ?int $id = null;
    public ?DateTimeInterface $date = null;
    public ?float $amount = null;
    public ?string $description = null;

    public function toArray(): array
    {
        return self::clearToArray([
            'data' => [
                'id' => $this->id,
                'type' => DataTypeConstant::TRANSACTIONS,
                'attributes' => [
                    'date' => $this->date->format('Y-m-d'),
                    'amount' => $this->amount,
                    'description' => $this->description,
                ],
            ],
        ]);
    }
}
