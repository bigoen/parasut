<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class ContactTransactionOutput
{
    use ObjectTrait;

    public ?int $contactId = null;
    public ?DateTimeInterface $createdAt = null;
    public ?DateTimeInterface $updatedAt = null;
    public ?string $transactionType = null;
    public ?string $transactionCategory = null;
    public ?DateTimeInterface $date = null;
    public ?float $amountInTrl = null;
    public ?float $debitAmount = null;
    public ?string $debitCurrency = null;
    public ?float $creditAmount = null;
    public ?string $creditCurrency = null;
    public ?string $description = null;
    public ?float $unmatchedDebitAmount = null;
    public ?float $unmatchedCreditAmount = null;
    public ?string $autoDescription = null;
    public ?float $unmatchedAmount = null;
    public ?bool $isReconciled = null;
    public ?string $bankSyncBankTransactionId = null;
    public ?DateTimeInterface $bankSyncDatetime = null;
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
        if (!isset($arr['data'])) {
            return null;
        }
        $data = $arr['data'];
        $object->contactId = (int) $data['id'];
        // attributes.
        $attributes = $data['attributes'];
        $object->createdAt = self::createDateTime($attributes['created_at']);
        $object->updatedAt = self::createDateTime($attributes['updated_at']);
        $object->transactionType = $attributes['transaction_type'];
        $object->transactionCategory = $attributes['transaction_category'];
        $object->date = self::createDateTime($attributes['date'], 'Y-m-d');
        $object->amountInTrl = (float) $attributes['amount_in_trl'];
        $object->debitAmount = (float) $attributes['debit_amount'];
        $object->debitCurrency = $attributes['debit_currency'];
        $object->creditAmount = (float) $attributes['credit_amount'];
        $object->creditCurrency = $attributes['credit_currency'];
        $object->description = $attributes['description'] ?? null;
        $object->unmatchedDebitAmount = (float) $attributes['unmatched_debit_amount'];
        $object->unmatchedCreditAmount = (float) $attributes['unmatched_credit_amount'];
        $object->autoDescription = $attributes['auto_description'];
        $object->unmatchedAmount = (float) $attributes['unmatched_amount'];
        $object->isReconciled = $attributes['is_reconciled'];
        $object->bankSyncBankTransactionId = $attributes['bank_sync_bank_transaction_id'];
        $object->bankSyncDatetime = self::createDateTime($attributes['bank_sync_datetime']);
        // set relationships.
        $object->relationships = $data['relationships'];
        $object->meta = $data['meta'];
        // set included.
        if (isset($arr['included'])) {
            $object = RelationshipsConverter::newFromObject($object, $arr);
        }

        return $object;
    }
}
