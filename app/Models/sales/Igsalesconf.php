<?php

namespace app\Models\sales;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $SalesMonth
 * @property string $Combo
 * @property string $TypeOfEmployment
 * @property string $LeadReceivedDate
 * @property string $TSR
 * @property string $DealCategory
 * @property string $DealEndDate
 * @property string $OptionSold
 * @property string $IGOptionSold
 * @property string $PremiumSold
 * @property string $TotalTransactionValue
 * @property string $ReferenceNumber
 * @property string $Venture
 * @property string $LeadSource
 * @property string $LeadSourceBatch
 * @property string $OnceOffPayment
 * @property string $InvoiceNotes
 * @property string $Venue
 * @property string $BatchReceived
 * @property string $BatchSent
 * @property string $Pipeline
 * @property string $InvoiceCategory
 * @property string $Mandate Status
 * @property string $NovaFinalInstallment
 * @property string $SalesCost
 * @property string $debicheckrevenue
 * @property int    $LeadID
 * @property int    $InternalCampaignCode
 * @property int    $SalesTeam
 * @property int    $PaymentTerm
 * @property int    $Counter
 */
class Igsalesconf extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'igsalesconf';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = '';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'SalesMonth', 'Combo', 'TypeOfEmployment', 'LeadReceivedDate', 'TSR', 'DealCategory', 'DealEndDate', 'OptionSold', 'IGOptionSold', 'PremiumSold', 'TotalTransactionValue', 'ReferenceNumber', 'LeadID', 'Venture', 'LeadSource', 'LeadSourceBatch', 'OnceOffPayment', 'InvoiceNotes', 'Venue', 'BatchReceived', 'BatchSent', 'Pipeline', 'InternalCampaignCode', 'SalesTeam', 'InvoiceCategory', 'Mandate Status', 'NovaFinalInstallment', 'PaymentTerm', 'Counter', 'SalesCost', 'debicheckrevenue'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'SalesMonth' => 'string', 'Combo' => 'string', 'TypeOfEmployment' => 'string', 'LeadReceivedDate' => 'string', 'TSR' => 'string', 'DealCategory' => 'string', 'DealEndDate' => 'string', 'OptionSold' => 'string', 'IGOptionSold' => 'string', 'PremiumSold' => 'string', 'TotalTransactionValue' => 'string', 'ReferenceNumber' => 'string', 'LeadID' => 'int', 'Venture' => 'string', 'LeadSource' => 'string', 'LeadSourceBatch' => 'string', 'OnceOffPayment' => 'string', 'InvoiceNotes' => 'string', 'Venue' => 'string', 'BatchReceived' => 'string', 'BatchSent' => 'string', 'Pipeline' => 'string', 'InternalCampaignCode' => 'int', 'SalesTeam' => 'int', 'InvoiceCategory' => 'string', 'Mandate Status' => 'string', 'NovaFinalInstallment' => 'string', 'PaymentTerm' => 'int', 'Counter' => 'int', 'SalesCost' => 'string', 'debicheckrevenue' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...

    // Relations ...
}
