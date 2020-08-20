<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use DateTime;
use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class Contact
{
    public int $id;
    public DateTimeInterface $createdAt;
    public DateTimeInterface $updatedAt;
    public string $contactType;
    public ?string $name = null;
    public ?string $email = null;
    public ?string $shortName = null;
    public float $balance;
    public float $trlBalance;
    public float $usdBalance;
    public float $eurBalance;
    public float $gbpBalance;
    public ?string $taxNumber = null;
    public ?string $taxOffice = null;
    public bool $archived;
    public string $accountType;
    public ?string $city = null;
    public ?string $district = null;
    public ?string $address = null;
    public ?string $phone = null;
    public ?string $fax = null;
    public bool $isAbroad;
    public ?int $termDays = null;
    public array $invoicingPreferences = [];
    public ?int $sharingsCount = null;
    public array $ibans = [];
    public ?string $exchangeRateType = null;
    public ?string $iban = null;
    public ?string $sharingPreviewUrl = null;
    public ?string $sharingPreviewPath = null;
    public ?string $paymentReminderPreviewUrl = null;
    public array $relationships;
    public array $meta;

    public static function new(array $arr): self
    {
        $object = (new self());
        $object->id = (int) $arr['id'];
        // attributes.
        $attributes = $arr['attributes'];
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
        $object->sharingsCount = $arr['sharings_count'] ?? null;
        $object->ibans = $arr['ibans'] ?? [];
        $object->exchangeRateType = $arr['exchange_rate_type'] ?? null;
        $object->iban = $arr['iban'] ?? null;
        $object->sharingPreviewUrl = $arr['sharing_preview_url'] ?? null;
        $object->sharingPreviewPath = $arr['sharing_preview_path'] ?? null;
        $object->paymentReminderPreviewUrl = $arr['payment_reminder_preview_url'] ?? null;
        // set relationships.
        $object->relationships = $arr['relationships'];
        $object->meta = $arr['meta'];

        return $object;
    }

    public static function createDateTime(string $dateTime): DateTimeInterface
    {
        return DateTime::createFromFormat(DateTime::RFC3339_EXTENDED, $dateTime);
    }
}
