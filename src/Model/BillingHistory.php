<?php

namespace App\Model;

use App\Attribute\FileModel;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[FileModel(filename: "Payment_And_Billing/BillingHistory.csv")]
class BillingHistory extends Model
{
    #[SerializedName("Gross Sale Amt")]
    public float $amount = 0;

    public function setAmount(string $amount): void
    {
        $this->amount = $amount;
    }
}
