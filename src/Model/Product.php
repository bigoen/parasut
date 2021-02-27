<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use Bigoen\Contracts\Parasut\Constant\DataTypeConstant;
use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class Product implements ObjectInterface
{
    use ObjectTrait;

    public ?int $id = null;
    public ?DateTimeInterface $createdAt = null;
    public ?DateTimeInterface $updatedAt = null;
    public ?string $code = null;
    public ?string $name = null;
    public ?float $vatRate = null;
    public ?string $salesExciseDutyType = null;
    public ?string $salesExciseDutyCode = null;
    public ?float $salesExciseDuty = null;
    public ?string $purchaseExciseDutyType = null;
    public ?float $purchaseExciseDuty = null;
    public ?float $communicationsTaxRate = null;
    public ?string $unitSelection = null;
    public ?string $unit = null;
    public ?bool $archived = null;
    public ?int $salesInvoiceDetailsCount = null;
    public ?int $purchaseInvoiceDetailsCount = null;
    public ?float $listPrice = null;
    public ?float $listPriceInTrl = null;
    public ?string $currency = null;
    public ?float $buyingPrice = null;
    public ?float $buyingPriceInTrl = null;
    public ?string $buyingCurrency = null;
    public ?bool $inventoryTracking = null;
    public ?float $stockCount = null;
    public ?float $initialStockCount = null;
    public ?float $criticalStockCount = null;
    public ?string $barcode = null;
    public ?bool $hasStockMovements = null;
    public ?array $photo = null;
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
        $object->code = $attributes['code'];
        $object->name = $attributes['name'];
        $object->vatRate = (float) $attributes['vat_rate'];
        $object->salesExciseDutyType = $attributes['sales_excise_duty_type'];
        $object->salesExciseDutyCode = $attributes['sales_excise_duty_code'];
        $object->salesExciseDuty = (float) $attributes['sales_excise_duty'];
        $object->purchaseExciseDutyType = $attributes['purchase_excise_duty_type'];
        $object->purchaseExciseDuty = (float) $attributes['purchase_excise_duty'];
        $object->communicationsTaxRate = (float) $attributes['communications_tax_rate'];
        $object->unit = $attributes['unit'];
        $object->archived = $attributes['archived'];
        $object->salesInvoiceDetailsCount = $attributes['sales_invoice_details_count'];
        $object->purchaseInvoiceDetailsCount = $attributes['purchase_invoice_details_count'];
        $object->listPrice = (float) $attributes['list_price'];
        $object->listPriceInTrl = (float) $attributes['list_price_in_trl'];
        $object->currency = $attributes['currency'];
        $object->buyingPrice = (float) $attributes['buying_price'];
        $object->buyingPriceInTrl = (float) $attributes['buying_price_in_trl'];
        $object->buyingCurrency = $attributes['buying_currency'];
        $object->inventoryTracking = $attributes['inventory_tracking'];
        $object->stockCount = (float) $attributes['stock_count'];
        $object->initialStockCount = (float) $attributes['initial_stock_count'];
        $object->criticalStockCount = (float) $attributes['critical_stock_count'];
        $object->barcode = $attributes['barcode'];
        $object->hasStockMovements = $attributes['has_stock_movements'];
        $object->photo = $attributes['photo'];
        // set relationships.
        $object->relationships = $data['relationships'];
        $object->meta = $data['meta'];
        // set included.
        if (isset($arr['included'])) {
            $object = RelationshipsConverter::newFromObject($object, $arr);
        }

        return $object;
    }

    public function toArray(): array
    {
        return self::clearToArray([
            'id' => $this->id,
            'type' => DataTypeConstant::PRODUCTS,
            'attributes' => [
                'code' => $this->code,
                'name' => $this->name,
                'vat_rate' => $this->vatRate,
                'sales_excise_duty' => $this->salesExciseDuty,
                'sales_excise_duty_type' => $this->salesExciseDutyType,
                'purchase_excise_duty' => $this->purchaseExciseDuty,
                'purchase_excise_duty_type' => $this->purchaseExciseDutyType,
                'unit' => $this->unit,
                'communications_tax_rate' => $this->communicationsTaxRate,
                'archived' => $this->archived,
                'list_price' => $this->listPrice,
                'currency' => $this->currency,
                'buying_price' => $this->buyingPrice,
                'buying_currency' => $this->buyingCurrency,
                'inventory_tracking' => $this->inventoryTracking,
                'initial_stock_count' => $this->initialStockCount,
            ],
            'relationships' => RelationshipsConverter::toArray($this->relationships),
        ]);
    }
}
