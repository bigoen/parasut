<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use Bigoen\Parasut\Constant\DataTypeConstant;
use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class SalesInvoice implements ObjectInterface
{
    use ObjectTrait;

    public ?int $id = null;
    public ?DateTimeInterface $createdAt = null;
    public ?DateTimeInterface $updatedAt = null;
    public ?string $description = null;
    public ?DateTimeInterface $issueDate = null;
    public ?int $invoiceId = null;
    public ?string $invoiceSeries = null;
    public ?string $invoiceNo = null;
    public ?float $netTotal = null;
    public ?string $currency = null;
    public ?float $grossTotal = null;
    public ?float $withholdingRate = null;
    public ?float $withholding = null;
    public ?float $totalExciseDuty = null;
    public ?float $totalCommunicationsTax = null;
    public ?float $totalVat = null;
    public ?float $vatWithholdingRate = null;
    public ?float $vatWithholding = null;
    public ?float $totalDiscount = null;
    public ?float $totalInvoiceDiscount = null;
    public ?float $beforeTaxesTotal = null;
    public ?float $remaining = null;
    public ?float $totalPaid = null;
    public ?float $remainingInTrl = null;
    public ?DateTimeInterface $dueDate = null;
    public ?string $paymentStatus = null;
    public ?bool $archived = null;
    public ?string $itemType = null;
    public ?bool $isRecurredItem = null;
    public ?int $sharingsCount = null;
    public ?DateTimeInterface $printedAt = null;
    public ?int $daysOverdue = null;
    public ?int $daysTillDueDate = null;
    public ?string $city = null;
    public ?string $district = null;
    public ?string $taxOffice = null;
    public ?string $taxNumber = null;
    public ?float $invoiceDiscount = null;
    public ?string $invoiceDiscountType = null;
    public ?float $netTotalInTrl = null;
    public ?string $shipmentDocumentNo = null;
    public ?DateTimeInterface $shipmentDate = null;
    public ?string $shipmentAddress = null;
    public ?float $exchangeRate = null;
    public ?string $printNote = null;
    public ?string $printUrl = null;
    public ?string $billingAddress = null;
    public ?string $billingPhone = null;
    public ?string $billingFax = null;
    public ?string $contactType = null;
    public ?string $orderNo = null;
    public ?DateTimeInterface $orderDate = null;
    public ?bool $shipmentIncluded = null;
    public ?bool $isAbroad = null;
    public ?string $sharingPreviewUrl = null;
    public ?string $sharingPreviewPath = null;
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
        $object->description = $attributes['description'];
        $object->issueDate = self::createDateTime($attributes['issue_date'], 'Y-m-d');
        $object->invoiceId = (int) $attributes['invoice_id'];
        $object->invoiceSeries = $attributes['invoice_series'];
        $object->invoiceNo = $attributes['invoice_no'];
        $object->netTotal = (float) $attributes['net_total'];
        $object->currency = $attributes['currency'];
        $object->grossTotal = (float) $attributes['gross_total'];
        $object->withholdingRate = (float) $attributes['withholding_rate'];
        $object->withholding = (float) $attributes['withholding'];
        $object->totalExciseDuty = (float) $attributes['total_excise_duty'];
        $object->totalCommunicationsTax = (float) $attributes['total_communications_tax'];
        $object->totalVat = (float) $attributes['total_vat'];
        $object->vatWithholdingRate = (float) $attributes['vat_withholding_rate'];
        $object->vatWithholding = (float) $attributes['vat_withholding'];
        $object->totalDiscount = (float) $attributes['total_discount'];
        $object->totalInvoiceDiscount = (float) $attributes['total_invoice_discount'];
        $object->beforeTaxesTotal = (float) $attributes['before_taxes_total'];
        $object->remaining = (float) $attributes['remaining'];
        $object->totalPaid = (float) $attributes['total_paid'];
        $object->remainingInTrl = (float) $attributes['remaining_in_trl'];
        $object->dueDate = self::createDateTime($attributes['due_date'], 'Y-m-d');
        $object->paymentStatus = $attributes['payment_status'];
        $object->archived = $attributes['archived'];
        $object->itemType = $attributes['item_type'];
        $object->isRecurredItem = $attributes['is_recurred_item'];
        $object->sharingsCount = $attributes['sharings_count'];
        $object->printedAt = self::createDateTime($attributes['printed_at'], 'Y-m-d');
        $object->daysOverdue = $attributes['days_overdue'];
        $object->daysTillDueDate = $attributes['days_till_due_date'];
        $object->city = $attributes['city'];
        $object->district = $attributes['district'];
        $object->taxOffice = $attributes['tax_office'];
        $object->taxNumber = $attributes['tax_number'];
        $object->invoiceDiscount = (float) $attributes['invoice_discount'];
        $object->invoiceDiscountType = $attributes['invoice_discount_type'];
        $object->netTotalInTrl = (float) $attributes['net_total_in_trl'];
        $object->shipmentDocumentNo = $attributes['shipment_document_no'];
        $object->shipmentDate = self::createDateTime($attributes['shipment_date'], 'Y-m-d');
        $object->shipmentAddress = $attributes['shipment_address'];
        $object->exchangeRate = (float) $attributes['exchange_rate'];
        $object->printNote = $attributes['print_note'];
        $object->printUrl = $attributes['print_url'];
        $object->billingAddress = $attributes['billing_address'];
        $object->billingPhone = $attributes['billing_phone'];
        $object->billingFax = $attributes['billing_fax'];
        $object->contactType = $attributes['contact_type'];
        $object->orderNo = $attributes['order_no'];
        $object->orderDate = self::createDateTime($attributes['order_date'], 'Y-m-d');
        $object->shipmentIncluded = $attributes['shipment_included'];
        $object->isAbroad = $attributes['is_abroad'];
        $object->sharingPreviewUrl = $attributes['sharing_preview_url'];
        $object->sharingPreviewPath = $attributes['sharing_preview_path'];
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
            'type' => DataTypeConstant::SALES_INVOICES,
            'attributes' => [
                'item_type' => $this->itemType,
                'description' => $this->description,
                'issue_date' => $this->issueDate instanceof DateTimeInterface ? $this->issueDate->format('Y-m-d') : null,
                'due_date' => $this->dueDate instanceof DateTimeInterface ? $this->dueDate->format('Y-m-d') : null,
                'invoice_series' => $this->invoiceSeries,
                'invoice_id' => $this->invoiceId,
                'currency' => $this->currency,
                'exchange_rate' => $this->exchangeRate,
                'withholding_rate' => $this->withholdingRate,
                'vat_withholding_rate' => $this->vatWithholdingRate,
                'invoice_discount_type' => $this->invoiceDiscountType,
                'invoice_discount' => $this->invoiceDiscount,
                'billing_address' => $this->billingAddress,
                'billing_phone' => $this->billingPhone,
                'billing_fax' => $this->billingFax,
                'tax_office' => $this->taxOffice,
                'tax_number' => $this->taxNumber,
                'city' => $this->city,
                'district' => $this->district,
                'is_abroad' => $this->isAbroad,
                'order_no' => $this->orderNo,
                'order_date' => $this->orderDate instanceof DateTimeInterface ? $this->orderDate->format('Y-m-d') : null,
                'shipment_address' => $this->shipmentAddress,
                'shipment_included' => $this->shipmentIncluded,
            ],
            'relationships' => RelationshipsConverter::toArray($this->relationships),
        ]);
    }
}
