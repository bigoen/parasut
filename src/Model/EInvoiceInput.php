<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class EInvoiceInput
{
    use ObjectTrait;

    public ?string $id = null;
    public ?string $vatWithholdingCode = null;
    public ?string $vatExemptionReasonCode = null;
    public ?string $vatExemptionReason = null;
    public ?string $note;
    public ?array $exciseDutyCodes = null;
    public ?string $scenario = null;
    public ?string $to = null;
    public ?array $relationships = null;

    public function toArray(): array
    {
        return self::clearToArray([
            'id' => $this->id,
            'type' => 'e_invoices',
            'attributes' => [
                'vat_withholding_code' => $this->vatWithholdingCode,
                'vat_exemption_reason_code' => $this->vatExemptionReasonCode,
                'vat_exemption_reason' => $this->vatExemptionReason,
                'note' => $this->note,
                'excise_duty_codes' => $this->exciseDutyCodes,
                'scenario' => $this->scenario,
                'to' => $this->to,
            ],
            'relationships' => $this->relationships,
        ]);
    }
}
