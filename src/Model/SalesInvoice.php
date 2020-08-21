<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class SalesInvoice implements ObjectInterface
{
    use ObjectTrait;

    const PAYMENT_STATUS_PAID = 'paid';
    const PAYMENT_STATUS_OVERDUE = 'overdue';
    const PAYMENT_STATUS_UNPAID = 'unpaid';
    const PAYMENT_STATUS_PARTIALLY_PAID = 'partially_paid';

    const ITEM_TYPE_INVOICE = 'invoice';
    const ITEM_TYPE_ESTIMATE = 'estimate';
    const ITEM_TYPE_CANCELLED = 'cancelled';
    const ITEM_TYPE_RECURRING_INVOICE = 'recurring_invoice';
    const ITEM_TYPE_RECURRING_ESTIMATE = 'recurring_estimate';
    const ITEM_TYPE_REFUND = 'refund';

    const CURRENCY_TRL = 'TRL';
    const CURRENCY_USD = 'USD';
    const CURRENCY_EUR = 'EUR';
    const CURRENCY_GBP = 'GBP';

    const INVOICE_DISCOUNT_TYPE_PERCENTAGE = 'percentage';
    const INVOICE_DISCOUNT_TYPE_AMOUNT = 'amount';

    public ?int $id = null;
    public ?DateTimeInterface $createdAt;
    public ?DateTimeInterface $updatedAt;
    public ?string $description;
    public ?DateTimeInterface $issueDate;
    public ?int $invoiceId;
    public ?string $invoiceSeries;
    public ?string $invoiceNo;
    public ?float $netTotal;
    public ?string $currency;
    public ?float $grossTotal;
    public ?float $withholdingRate;
    public ?float $withholding;
    public ?float $totalExciseDuty;
    public ?float $totalCommunicationsTax;
    public ?float $totalVat;
    public ?float $vatWithholdingRate;
    public ?float $vatWithholding;
    public ?float $totalDiscount;
    public ?float $totalInvoiceDiscount;
    public ?float $beforeTaxesTotal;
    public ?float $remaining;
    public ?float $totalPaid;
    public ?float $remainingInTrl;
    public ?DateTimeInterface $dueDate;
    public ?string $paymentStatus;
    public ?bool $archived;
    public ?string $itemType;
    public ?bool $isRecurredItem;
    public ?int $sharingsCount;
    public ?DateTimeInterface $printedAt;
    public ?int $daysOverdue;
    public ?int $daysTillDueDate;
    public ?string $city;
    public ?string $district;
    public ?string $taxOffice;
    public ?string $taxNumber;
    public ?float $invoiceDiscount;
    public ?string $invoiceDiscountType;
    public ?float $netTotalInTrl;
    public ?string $shipmentDocumentNo;
    public ?DateTimeInterface $shipmentDate;
    public ?string $shipmentAddress;
    public ?float $exchangeRate;
    public ?string $printNote;
    public ?string $printUrl;
    public ?string $billingAddress;
    public ?string $billingPhone;
    public ?string $billingFax;
    public ?string $contactType;
    public ?string $orderNo;
    public ?DateTimeInterface $orderDate;
    public ?bool $shipmentIncluded;
    public ?bool $isAbroad;
    public ?string $sharingPreviewUrl;
    public ?string $sharingPreviewPath;
    public ?array $relationships;
    public ?array $meta;

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

        return $object;
    }

    public function toArray(): array
    {
        return self::clearToArray([
            'id' => $this->id,
            'type' => 'sales_invoices',
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
            'relationships' => $this->relationships,
        ]);
    }
}
