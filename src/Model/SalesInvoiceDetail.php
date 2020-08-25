<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class SalesInvoiceDetail implements ObjectInterface
{
    use ObjectTrait;

    public ?string $id = null;
    public ?float $quantity = null;
    public ?float $unitPrice = null;
    public ?float $vatRate = null;
    public ?string $discountType = null;
    public ?float $discountValue = null;
    public ?string $exciseDutyType = null;
    public ?float $exciseDutyValue = null;
    public ?float $communicationsTaxRate = null;
    public ?string $description = null;
    public ?array $relationships = null;

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
        $object->id = $data['id'];
        // attributes.
        $attributes = $data['attributes'];
        $object->quantity = $attributes['quantity'];
        $object->unitPrice = $attributes['unit_price'];
        $object->vatRate = $attributes['vat_rate'];
        $object->discountType = $attributes['discount_type'];
        $object->discountValue = $attributes['discount_value'];
        $object->exciseDutyType = $attributes['excise_duty_type'];
        $object->exciseDutyValue = $attributes['excise_duty_value'];
        $object->communicationsTaxRate = $attributes['communications_tax_rate'];
        $object->description = $attributes['description'];
        // set relationships.
        $object->relationships = $data['relationships'] ?? null;

        return $object;
    }

    public function toArray(): array
    {
        return self::clearToArray([
            'id' => $this->id,
            'type' => 'sales_invoice_details',
            'attributes' => [
                'quantity' => $this->quantity,
                'unit_price' => $this->unitPrice,
                'vat_rate' => $this->vatRate,
                'discount_type' => $this->discountType,
                'discount_value' => $this->discountValue,
                'excise_duty_type' => $this->exciseDutyType,
                'excise_duty_value' => $this->exciseDutyValue,
                'communications_tax_rate' => $this->communicationsTaxRate,
                'description' => $this->description,
                'relationships' => $this->relationships,
            ]
        ]);
    }
}
