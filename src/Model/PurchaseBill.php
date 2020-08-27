<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use Bigoen\Parasut\Constant\DataTypeConstant;
use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class PurchaseBill implements ObjectInterface
{
    use ObjectTrait;

    public ?int $id = null;
    public ?DateTimeInterface $createdAt = null;
    public ?DateTimeInterface $updatedAt = null;
    public ?string $description = null;
    public ?DateTimeInterface $issueDate = null;
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
    public ?float $remainingReimbursement = null;
    public ?float $remainingReimbursementInTrl = null;
    public ?int $daysOverdue = null;
    public ?int $daysTillDueDate = null;
    public ?bool $isDetailed = null;
    public ?int $eInvoicesCount = null;
    public ?float $invoiceDiscount = null;
    public ?string $invoiceDiscountType = null;
    public ?float $netTotalInTrl = null;
    public ?float $exchangeRate = null;
    public ?bool $shipmentIncluded = null;
    public ?string $photoUrl = null;
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
        $object->remainingReimbursement = (float) $attributes['remaining_reimbursement'];
        $object->remainingReimbursementInTrl = (float) $attributes['remaining_reimbursement_in_trl'];
        $object->isDetailed = $attributes['is_detailed'];
        $object->eInvoicesCount = (int) $attributes['e_invoices_count'];
        $object->daysOverdue = $attributes['days_overdue'];
        $object->daysTillDueDate = $attributes['days_till_due_date'];
        $object->invoiceDiscount = (float) $attributes['invoice_discount'];
        $object->invoiceDiscountType = $attributes['invoice_discount_type'];
        $object->netTotalInTrl = (float) $attributes['net_total_in_trl'];
        $object->exchangeRate = (float) $attributes['exchange_rate'];
        $object->shipmentIncluded = $attributes['shipment_included'];
        $object->sharingPreviewUrl = $attributes['sharing_preview_url'];
        $object->sharingPreviewPath = $attributes['sharing_preview_path'];
        // set photoUrl.
        $object->photoUrl = $attributes['photo']['url'] ?? null;
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
            'type' => DataTypeConstant::PURCHASE_BILLS,
            'attributes' => [
                'item_type' => $this->itemType,
                'description' => $this->description,
                'issue_date' => $this->issueDate instanceof DateTimeInterface ? $this->issueDate->format('Y-m-d') : null,
                'due_date' => $this->dueDate instanceof DateTimeInterface ? $this->dueDate->format('Y-m-d') : null,
                'invoice_no' => $this->invoiceNo,
                'currency' => $this->currency,
                'exchange_rate' => $this->exchangeRate,
                'withholding_rate' => $this->withholdingRate,
                'vat_withholding_rate' => $this->vatWithholdingRate,
                'invoice_discount_type' => $this->invoiceDiscountType,
                'invoice_discount' => $this->invoiceDiscount,
            ],
            'relationships' => RelationshipsConverter::toArray($this->relationships),
        ]);
    }

    public function toArrayBasic(): array
    {
        return self::clearToArray([
            'id' => $this->id,
            'type' => DataTypeConstant::PURCHASE_BILLS,
            'attributes' => [
                'item_type' => $this->itemType,
                'description' => $this->description,
                'issue_date' => $this->issueDate instanceof DateTimeInterface ? $this->issueDate->format('Y-m-d') : null,
                'due_date' => $this->dueDate instanceof DateTimeInterface ? $this->dueDate->format('Y-m-d') : null,
                'invoice_no' => $this->invoiceNo,
                'currency' => $this->currency,
                'exchange_rate' => $this->exchangeRate,
                'net_total' => $this->netTotal,
                'total_vat' => $this->totalVat,
            ],
            'relationships' => RelationshipsConverter::toArray($this->relationships),
        ]);
    }
}
