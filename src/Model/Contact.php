<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class Contact implements ObjectInterface
{
    use ObjectTrait;

    public ?int $id = null;
    public ?DateTimeInterface $createdAt = null;
    public ?DateTimeInterface $updatedAt = null;
    public ?string $contactType = null;
    public ?string $name = null;
    public ?string $email = null;
    public ?string $shortName = null;
    public ?float $balance = null;
    public ?float $trlBalance = null;
    public ?float $usdBalance = null;
    public ?float $eurBalance = null;
    public ?float $gbpBalance = null;
    public ?string $taxNumber = null;
    public ?string $taxOffice = null;
    public ?bool $archived = null;
    public ?string $accountType = null;
    public ?string $city = null;
    public ?string $district = null;
    public ?string $address = null;
    public ?string $phone = null;
    public ?string $fax = null;
    public ?bool $isAbroad = null;
    public ?int $termDays = null;
    public ?array $invoicingPreferences = null;
    public ?int $sharingsCount = null;
    public ?array $ibans = null;
    public ?string $exchangeRateType = null;
    public ?string $iban = null;
    public ?string $sharingPreviewUrl = null;
    public ?string $sharingPreviewPath = null;
    public ?string $paymentReminderPreviewUrl = null;
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
        $object->contactType = $attributes['contact_type'];
        $object->name = $attributes['name'];
        $object->email = $attributes['email'];
        $object->shortName = $attributes['short_name'];
        $object->balance = (float) $attributes['balance'];
        $object->trlBalance = (float) $attributes['trl_balance'];
        $object->usdBalance = (float) $attributes['usd_balance'];
        $object->eurBalance = (float) $attributes['eur_balance'];
        $object->gbpBalance = (float) $attributes['gbp_balance'];
        $object->taxNumber = $attributes['tax_number'];
        $object->taxOffice = $attributes['tax_office'];
        $object->archived = $attributes['archived'];
        $object->accountType = $attributes['account_type'];
        $object->city = $attributes['city'];
        $object->district = $attributes['district'];
        $object->address = $attributes['address'];
        $object->phone = $attributes['phone'];
        $object->fax = $attributes['fax'];
        $object->isAbroad = $attributes['is_abroad'];
        $object->termDays = $attributes['term_days'];
        $object->invoicingPreferences = $attributes['invoicing_preferences'];
        // other values.
        $object->sharingsCount = $data['sharings_count'] ?? null;
        $object->ibans = $data['ibans'] ?? [];
        $object->exchangeRateType = $data['exchange_rate_type'] ?? null;
        $object->iban = $data['iban'] ?? null;
        $object->sharingPreviewUrl = $data['sharing_preview_url'] ?? null;
        $object->sharingPreviewPath = $data['sharing_preview_path'] ?? null;
        $object->paymentReminderPreviewUrl = $data['payment_reminder_preview_url'] ?? null;
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
            'type' => 'contacts',
            'attributes' => [
                'contact_type' => $this->contactType,
                'name' => $this->name,
                'email' => $this->email,
                'short_name' => $this->shortName,
                'tax_number' => $this->taxNumber,
                'tax_office' => $this->taxOffice,
                'archived' => $this->archived,
                'account_type' => $this->accountType,
                'city' => $this->city,
                'district' => $this->district,
                'address' => $this->address,
                'phone' => $this->phone,
                'fax' => $this->fax,
                'iban' => $this->iban,
                'is_abroad' => $this->isAbroad,
            ],
            'relationships' => $this->relationships,
        ]);
    }
}
