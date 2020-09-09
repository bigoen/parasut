<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use Bigoen\Contracts\Parasut\Constant\DataTypeConstant;
use DateTime;
use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class Account implements ObjectInterface
{
    use ObjectTrait;

    public ?int $id = null;
    public ?DateTimeInterface $createdAt = null;
    public ?DateTimeInterface $updatedAt = null;
    public ?string $name = null;
    public ?string $currency = null;
    public ?string $usedFor = null;
    public ?DateTimeInterface $lastUsedAt = null;
    public ?string $accountType = null;
    public ?string $iban = null;
    public ?float $balance = null;
    public ?string $bankName = null;
    public ?string $bankBranch = null;
    public ?string $bankAccountNo = null;
    public ?bool $archived = null;
    public ?DateTimeInterface $lastAdjustmentDate = null;
    public ?string $associateEmail = null;
    public ?string $bankIntegrationType = null;
    public ?string $bankIdentifier = null;
    public ?string $bankIntegrationStatus = null;
    public ?int $overdraftLimit = null;
    public ?float $bankSyncInitialNetBalance = null;
    public ?DateTimeInterface $bankSyncInitialNetBalanceAt = null;
    public ?array $relationships = null;
    public ?array $meta = null;

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
        $object->name = $attributes['name'];
        $object->currency = $attributes['currency'];
        $object->usedFor = $attributes['used_for'];
        $object->lastUsedAt = self::createDateTime($attributes['last_used_at']);
        $object->accountType = $attributes['account_type'];
        $object->iban = $attributes['iban'];
        $object->balance = (float) $attributes['balance'];
        $object->bankName = $attributes['bank_name'];
        $object->bankBranch = $attributes['bank_branch'];
        $object->bankAccountNo = $attributes['bank_account_no'];
        $object->archived = $attributes['archived'];
        $object->lastAdjustmentDate = self::createDateTime($attributes['last_adjustment_date'], 'Y-m-d');
        $object->associateEmail = $attributes['associate_email'];
        $object->bankIntegrationType = $attributes['bank_integration_type'];
        $object->bankIdentifier = $attributes['bank_identifier'];
        $object->bankIntegrationStatus = $attributes['bank_integration_status'];
        $object->overdraftLimit = $attributes['overdraft_limit'];
        if (isset($attributes['bank_sync_initial_net_balance'], $attributes['bank_sync_initial_net_balance_at'])) {
            $object->bankSyncInitialNetBalance = (float) $attributes['bank_sync_initial_net_balance'];
            $object->bankSyncInitialNetBalanceAt = self::createDateTime(
                $attributes['bank_sync_initial_net_balance_at'], DateTime::RFC3339_EXTENDED
            );
        }

        return $object;
    }

    public function toArray(): array
    {
        return self::clearToArray([
            'id' => $this->id,
            'type' => DataTypeConstant::ACCOUNTS,
            'attributes' => [
                'name' => $this->name,
                'currency' => $this->currency,
                'account_type' => $this->accountType,
                'bank_name' => $this->bankName,
                'bank_branch' => $this->bankBranch,
                'bank_account_no' => $this->bankAccountNo,
                'iban' => $this->iban,
                'archived' => $this->archived,
            ],
        ]);
    }
}
