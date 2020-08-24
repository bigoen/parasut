<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class PurchaseBillPayment implements ObjectInterface
{
    use ObjectTrait;

    public ?int $id = null;
    public ?int $purchaseBillId = null;
    public ?int $accountId = null;
    public ?DateTimeInterface $createdAt = null;
    public ?DateTimeInterface $updatedAt = null;
    public ?DateTimeInterface $date = null;
    public ?DateTimeInterface $dueDate = null;
    public ?float $amount = null;
    public ?float $exchangeRate = null;
    public ?float $matchedAmount = null;
    public ?float $amountInTrl = null;
    public ?string $currency = null;
    public ?string $paidInCurrency = null;
    public ?string $notes = null;
    public ?array $relationships = null;
    public ?array $meta = null;
    public ?array $included = null;

    public static function new(array $arr): ?self
    {
        $object = new self();
        if (isset($arr['errors'])) {
            $object->errors = $arr['errors'];

            return $object;
        }
        if (!isset($arr['data']) && !isset($arr['id'])) {
            return null;
        } elseif (isset($arr['id'])) {
            $data = $arr;
        } else {
            $data = $arr['data'];
        }
        $object->id = (int) $data['id'];
        // attributes.
        $attributes = $data['attributes'];
        $object->createdAt = self::createDateTime($attributes['created_at']);
        $object->updatedAt = self::createDateTime($attributes['updated_at']);
        $object->date = self::createDateTime($attributes['date'], 'Y-m-d');
        $object->dueDate = self::createDateTime($attributes['due_date'], 'Y-m-d');
        $object->amount = (float) $attributes['amount'];
        $object->matchedAmount = (float) $attributes['matched_amount'];
        $object->amountInTrl = (float) $attributes['amount_in_trl'];
        $object->currency = $attributes['currency'];
        $object->paidInCurrency = $attributes['paid_in_currency'];
        $object->notes = $attributes['notes'];
        // set relationships.
        $object->relationships = $data['relationships'];
        $object->meta = $data['meta'];
        // set included.
        $object->included = $arr['included'] ?? null;

        return $object;
    }

    public function toArray(): array
    {
        return self::clearToArray([
            'id' => $this->id,
            'type' => 'payments',
            'attributes' => [
                'description' => $this->notes,
                'account_id' => $this->accountId,
                'date' => $this->date->format('Y-m-d'),
                'amount' => $this->amount,
                'exchange_rate' => $this->exchangeRate,
            ],
        ]);
    }
}
