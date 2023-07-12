<?php

namespace app\Models\sales;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $ID
 * @property int      $VIF_04_B
 * @property string   $SalaryMonth
 * @property string   $Combo
 * @property string   $BitrixID
 * @property string   $TypeOfEmployment
 * @property string   $TSR
 * @property string   $DealCategory
 * @property string   $OptionSold
 * @property string   $IGOptionSold
 * @property string   $ReferenceNumber
 * @property string   $LeadID
 * @property string   $Venture
 * @property string   $LeadSource
 * @property string   $LeadSourceBatch
 * @property string   $OnceOffPayment
 * @property string   $InvoiceNotes
 * @property string   $Venue
 * @property string   $BatchReceived
 * @property string   $Pipeline
 * @property string   $InternalCampaignCode
 * @property string   $SalesTeam
 * @property string   $InvoiceCategory
 * @property string   $OriginalDateOfSale
 * @property string   $Bridging/Ultimate
 * @property string   $MODERN
 * @property string   $VIF_03
 * @property string   $THGSaleType
 * @property string   $DroneBought
 * @property string   $SubTotalDrones
 * @property string   $AdditionalProducts
 * @property string   $BumpUpProducts
 * @property string   $FinalInstallment
 * @property string   $PaymentMethod
 * @property string   $THGUpgradeSaleTier
 * @property string   $DateSubmitted
 * @property string   $NextCommDate
 * @property string   $Cancer
 * @property string   $FreeCover
 * @property string   $IDNumber
 * @property string   $DOB
 * @property string   $Boat Bought
 * @property string   $SubTotalBoat
 * @property string   $VIF_04
 * @property string   $SalesCost
 * @property string   $Sales Batch
 * @property string   $BOY_BUMPUP
 * @property string   $LeadCategory
 * @property string   $batchSent
 * @property string   $Mandate Status
 * @property string   $DCMandateRequired
 * @property string   $Batch Returned
 * @property Date     $SalesMonth
 * @property DateTime $LeadReceivedDate
 * @property DateTime $DealEndDate
 * @property float    $PremiumSold
 * @property float    $TotalTransactionValue
 * @property float    $NovaFinalInstallment
 * @property float    $PaymentTerm
 * @property float    $FULL
 * @property float    $KID
 * @property float    $TEEN
 * @property float    $VIF_01
 * @property float    $VIF_02
 * @property float    $M2F
 * @property float    $SubTotalAdditionalProducts
 * @property float    $SubTotalBumpup
 * @property float    $2nd Number
 * @property float    $3rd Number
 * @property float    $Account
 * @property float    $Income
 * @property float    $PIQ
 * @property float    $Email
 * @property float    $HomeLanguage
 * @property float    $Bank
 * @property float    $IDGiven
 * @property float    $DOBGiven
 */
class TblConfirmeddeals extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_confirmeddeals';

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
        'ID', 'SalaryMonth', 'SalesMonth', 'Combo', 'BitrixID', 'TypeOfEmployment', 'LeadReceivedDate', 'TSR', 'DealCategory', 'DealEndDate', 'OptionSold', 'IGOptionSold', 'PremiumSold', 'TotalTransactionValue', 'ReferenceNumber', 'LeadID', 'Venture', 'LeadSource', 'LeadSourceBatch', 'OnceOffPayment', 'InvoiceNotes', 'Venue', 'BatchReceived', 'Pipeline', 'InternalCampaignCode', 'SalesTeam', 'InvoiceCategory', 'NovaFinalInstallment', 'PaymentTerm', 'OriginalDateOfSale', 'Bridging/Ultimate', 'FULL', 'MODERN', 'KID', 'TEEN', 'VIF_01', 'VIF_02', 'VIF_03', 'M2F', 'THGSaleType', 'DroneBought', 'SubTotalDrones', 'AdditionalProducts', 'SubTotalAdditionalProducts', 'BumpUpProducts', 'SubTotalBumpup', 'FinalInstallment', 'PaymentMethod', 'THGUpgradeSaleTier', 'DateSubmitted', 'NextCommDate', '2nd Number', '3rd Number', 'Account', 'Income', 'PIQ', 'Email', 'Cancer', 'FreeCover', 'HomeLanguage', 'Bank', 'IDGiven', 'DOBGiven', 'IDNumber', 'DOB', 'Boat Bought', 'SubTotalBoat', 'VIF_04', 'SalesCost', 'Sales Batch', 'BOY_BUMPUP', 'LeadCategory', 'batchSent', 'Mandate Status', 'DCMandateRequired', 'VIF_04_B', 'Batch Returned'
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
        'ID' => 'int', 'SalaryMonth' => 'string', 'SalesMonth' => 'date', 'Combo' => 'string', 'BitrixID' => 'string', 'TypeOfEmployment' => 'string', 'LeadReceivedDate' => 'datetime', 'TSR' => 'string', 'DealCategory' => 'string', 'DealEndDate' => 'datetime', 'OptionSold' => 'string', 'IGOptionSold' => 'string', 'PremiumSold' => 'double', 'TotalTransactionValue' => 'double', 'ReferenceNumber' => 'string', 'LeadID' => 'string', 'Venture' => 'string', 'LeadSource' => 'string', 'LeadSourceBatch' => 'string', 'OnceOffPayment' => 'string', 'InvoiceNotes' => 'string', 'Venue' => 'string', 'BatchReceived' => 'string', 'Pipeline' => 'string', 'InternalCampaignCode' => 'string', 'SalesTeam' => 'string', 'InvoiceCategory' => 'string', 'NovaFinalInstallment' => 'double', 'PaymentTerm' => 'double', 'OriginalDateOfSale' => 'string', 'Bridging/Ultimate' => 'string', 'FULL' => 'double', 'MODERN' => 'string', 'KID' => 'double', 'TEEN' => 'double', 'VIF_01' => 'double', 'VIF_02' => 'double', 'VIF_03' => 'string', 'M2F' => 'double', 'THGSaleType' => 'string', 'DroneBought' => 'string', 'SubTotalDrones' => 'string', 'AdditionalProducts' => 'string', 'SubTotalAdditionalProducts' => 'double', 'BumpUpProducts' => 'string', 'SubTotalBumpup' => 'double', 'FinalInstallment' => 'string', 'PaymentMethod' => 'string', 'THGUpgradeSaleTier' => 'string', 'DateSubmitted' => 'string', 'NextCommDate' => 'string', '2nd Number' => 'double', '3rd Number' => 'double', 'Account' => 'double', 'Income' => 'double', 'PIQ' => 'double', 'Email' => 'double', 'Cancer' => 'string', 'FreeCover' => 'string', 'HomeLanguage' => 'double', 'Bank' => 'double', 'IDGiven' => 'double', 'DOBGiven' => 'double', 'IDNumber' => 'string', 'DOB' => 'string', 'Boat Bought' => 'string', 'SubTotalBoat' => 'string', 'VIF_04' => 'string', 'SalesCost' => 'string', 'Sales Batch' => 'string', 'BOY_BUMPUP' => 'string', 'LeadCategory' => 'string', 'batchSent' => 'string', 'Mandate Status' => 'string', 'DCMandateRequired' => 'string', 'VIF_04_B' => 'int', 'Batch Returned' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'SalesMonth', 'LeadReceivedDate', 'DealEndDate'
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
