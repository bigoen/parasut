<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use Bigoen\Contracts\Parasut\Constant\DataTypeConstant;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class EArchiveInput
{
    use ObjectTrait;

    public ?string $id = null;
    public ?string $vatWithholdingCode = null;
    public ?string $vatExemptionReasonCode = null;
    public ?string $vatExemptionReason = null;
    public ?string $note;
    public ?array $exciseDutyCodes = null;
    public ?array $internetSale = null;
    public ?array $shipment = null;
    public ?array $relationships = null;

    public function toArray(): array
    {
        return self::clearToArray([
            'id' => $this->id,
            'type' => DataTypeConstant::E_ARCHIVES,
            'attributes' => [
                'vat_withholding_code' => $this->vatWithholdingCode,
                'vat_exemption_reason_code' => $this->vatExemptionReasonCode,
                'vat_exemption_reason' => $this->vatExemptionReason,
                'note' => $this->note,
                'excise_duty_codes' => $this->exciseDutyCodes,
                'internet_sale' => $this->internetSale,
                'shipment' => $this->shipment,
            ],
            'relationships' => RelationshipsConverter::toArray($this->relationships),
        ]);
    }
}
