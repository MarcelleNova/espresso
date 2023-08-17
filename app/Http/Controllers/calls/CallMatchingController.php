<?php

namespace App\Http\Controllers\calls;

use Exception;
use Illuminate\Http\Request;
use App\Models\calls\tempWonDeals;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\calls\tempModifiedLeads;
use App\Models\calls\tempViewed;
use App\Models\calls\tempWonCheck;

class CallMatchingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('calls.callmatching.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) 
    {
        set_time_limit(0);
        ini_set('memory_limit', '2048M');
        //Query Bitrix for Won Deals and store
        // $this->getWonDeals($request);

        //Query Bitrix for Modified Leads and store
        // $this->getModifiedLeads($request);

        //Query Bitrix for Viewed and store
        // $this->getViewed($request);

        //Query Bitrix for Viewed and store
        $this->getWonCheck($request);

        return back()
        ->with('success','Daily Call Analysis completed successfully.');


    }

    public function getWonDeals(Request $request)
    {
        $query_string = " SELECT
            b_crm_deal.ID,
            b_crm_deal.DATE_CREATE,
            b_crm_deal.DATE_MODIFY,
            concat(MOD_USER.NAME, ' ', MOD_USER.LAST_NAME) AS 'ModifiedBy',
            concat(ASN_USER.NAME, ' ', ASN_USER.LAST_NAME) AS 'ResponsiblePerson',
            b_crm_deal_category.NAME AS 'Pipeline',
            DD_PC.VALUE AS 'PipelineCategory',
            DD_VENTURE.VALUE AS 'Venture',
            DD_VENUE.VALUE AS 'Venue',
            b_crm_status.NAME AS 'DealStage',
            Concat(
                if(LOCATE('query', b_uts_crm_deal.UF_CRM_5D64C4C197AB2) > 0, 'Solved Query ', ''),
                if(LOCATE('cancel', b_uts_crm_deal.UF_CRM_5D64C4C197AB2) > 0, 'Conserved Sale', '')
            ) AS 'History',
            b_crm_deal.CLOSEDATE AS 'EndDate',
            b_uts_crm_deal.UF_CRM_1559994687 AS 'BatchNumber',
            b_uts_crm_deal.UF_CRM_1559995456 AS 'LeadReceivedDate',
            b_uts_crm_deal.UF_CRM_1559995470 AS 'AllocationDate',
            b_uts_crm_deal.UF_CRM_1559995636 AS 'ReferenceNumber',
            b_uts_crm_deal.UF_CRM_1559995922 AS 'NewMembershipFee',
            b_uts_crm_deal.UF_CRM_1559996044 AS 'Firstname',
            b_uts_crm_deal.UF_CRM_1559996052 AS 'Surname',
            DD_LANG.VALUE AS 'Language',
            b_uts_crm_deal.UF_CRM_1559996248 AS 'DateOfBirth',
            b_uts_crm_deal.UF_CRM_1559996323 AS 'WorkTel',
            b_uts_crm_deal.UF_CRM_1559996337 AS 'HomeTel',
            b_uts_crm_deal.UF_CRM_1559996351 AS 'CellTel',
            b_uts_crm_deal.UF_CRM_1559996359 AS 'OtherTel',
            b_uts_crm_deal.UF_CRM_1559996874 AS 'AccHolderTel'
        FROM
            b_crm_deal
            INNER JOIN b_uts_crm_deal ON b_crm_deal.ID = b_uts_crm_deal.VALUE_ID
            LEFT JOIN b_user ASN_USER ON ASN_USER.ID = b_crm_deal.ASSIGNED_BY_ID
            LEFT JOIN b_user MOD_USER ON MOD_USER.ID = b_crm_deal.MODIFY_BY_ID
            LEFT JOIN b_crm_deal_category ON b_crm_deal.CATEGORY_ID = b_crm_deal_category.ID
            LEFT JOIN b_crm_status ON b_crm_status.STATUS_ID = b_crm_deal.STAGE_ID
            LEFT JOIN b_user_field_enum DD_VENUE ON DD_VENUE.ID = b_uts_crm_deal.UF_CRM_1562069876
            LEFT JOIN b_user_field_enum DD_VENTURE ON DD_VENTURE.ID = b_uts_crm_deal.UF_CRM_1562067632
            LEFT JOIN b_user_field_enum DD_LANG ON DD_LANG.ID = b_uts_crm_deal.UF_CRM_1559996078
            LEFT JOIN b_user_field_enum DD_ACC_OWNER ON DD_ACC_OWNER.ID = b_uts_crm_deal.UF_CRM_1559996803
            LEFT JOIN b_user_field_enum DD_PC ON DD_PC.ID = b_uts_crm_deal.UF_CRM_1562743391
        WHERE
            CAST(b_crm_deal.CLOSEDATE AS date) = '$request->date'
            AND (b_crm_status.NAME = 'Sale' OR b_crm_status.NAME = 'No Sale' OR b_crm_status.NAME like '%Permission%')
        ORDER BY
            b_crm_deal_category.NAME";

        $data = DB::connection('mysql_bitrix')->select($query_string);
        // Write to the temp file
        $this->storeWonDeals($data);
      
    }

    
    public function storeWonDeals($data)
    {
        //Clear Old Data
        DB::table('temp_won_deals')->delete();

        try{

            foreach ($data as $d)
            {
                $deals = tempWonDeals::create(); 
                $deals->bxID = $d->ID;
                $deals->bxDateCreate = $d->DATE_CREATE;
                $deals->bxDateModify = $d->DATE_MODIFY;
                $deals->bxModifiedBy = $d->ModifiedBy;
                $deals->bxResponsiblePerson = $d->ResponsiblePerson;
                $deals->bxPipeline = $d->Pipeline;
                $deals->bxPipelineCategory = $d->PipelineCategory;
                $deals->bxVenture = $d->Venture;
                $deals->bxVenue = $d->Venue;
                $deals->bxDealStage = $d->DealStage;
                $deals->bxHistory = $d->History;
                $deals->bxEndDate = $d->EndDate;
                $deals->bxBatchNumber = $d->BatchNumber;
                $deals->bxLeadReceivedDate = $d->LeadReceivedDate;
                $deals->bxAllocationDate = $d->AllocationDate;
                $deals->bxReferenceNumber = $d->ReferenceNumber;
                $deals->bxNewMembershipFee = number_format((float)str_replace($d->NewMembershipFee,'|ZAR',''),2);
                $deals->bxFirstname = $d->Firstname;
                $deals->bxSurname = $d->Surname;
                $deals->bxLanguage = $d->Language;
                $deals->bxDateOfBirth = $d->DateOfBirth;
                $deals->bxWorkTel = $d->WorkTel;
                $deals->bxHomeTel = $d->HomeTel;
                $deals->bxCellTel = $d->CellTel;
                $deals->bxOtherTel = $d->OtherTel;
                $deals->bxAccHolderTel= $d->AccHolderTel;
                $deals->save();
            }
        
        } catch(Exception $e)
        
        {
            Log::debug($e);
        }
     
    }

    public function getModifiedLeads(Request $request)
    {

        $query_string = "SELECT b_crm_deal.ID,
        b_crm_deal.DATE_CREATE,
        b_crm_deal.DATE_MODIFY,
        concat(MOD_USER.NAME, ' ', MOD_USER.LAST_NAME) AS 'ModifiedBy',
        concat(ASN_USER.NAME, ' ', ASN_USER.LAST_NAME) AS 'ResponsiblePerson',
        b_crm_deal_category.NAME AS 'Pipeline',
        DD_PC.VALUE AS 'PipelineCategory',
        DD_VENTURE.VALUE AS 'Venture',
        DD_VENUE.VALUE AS 'Venue',
        b_crm_status.NAME AS 'DealStage',
        Concat(
            if(LOCATE('query', b_uts_crm_deal.UF_CRM_5D64C4C197AB2) > 0, 'Solved Query ', ''),
            if(LOCATE('cancel', b_uts_crm_deal.UF_CRM_5D64C4C197AB2) > 0, 'Conserved Sale', '')
        ) AS 'History',
        b_crm_deal.CLOSEDATE AS 'EndDate',
        b_uts_crm_deal.UF_CRM_1559994687 AS 'BatchNumber',
        b_uts_crm_deal.UF_CRM_1559995456 AS 'LeadReceivedDate',
        b_uts_crm_deal.UF_CRM_1559995470 AS 'AllocationDate',
        b_uts_crm_deal.UF_CRM_1559995636 AS 'ReferenceNumber',
        b_uts_crm_deal.UF_CRM_1559995922 AS 'NewMembershipFee',
        b_uts_crm_deal.UF_CRM_1559996044 AS 'Firstname',
        b_uts_crm_deal.UF_CRM_1559996052 AS 'Surname',
        DD_LANG.VALUE AS 'Language',
        b_uts_crm_deal.UF_CRM_1559996248 AS 'DateOfBirth',
        DD_DCMandateRequirements.VALUE AS 'DCMandateRequirements',
        b_uts_crm_deal.UF_CRM_1559996323 AS 'WorkTel',
        b_uts_crm_deal.UF_CRM_1559996337 AS 'HomeTel',
        b_uts_crm_deal.UF_CRM_1559996351 AS 'CellTel',
        b_uts_crm_deal.UF_CRM_1559996359 AS 'OtherTel',
        b_uts_crm_deal.UF_CRM_1559996874 AS 'AccHolderTel'
        FROM
            b_crm_deal
            INNER JOIN b_uts_crm_deal ON b_crm_deal.ID = b_uts_crm_deal.VALUE_ID
            LEFT JOIN b_user ASN_USER ON ASN_USER.ID = b_crm_deal.ASSIGNED_BY_ID
            LEFT JOIN b_user MOD_USER ON MOD_USER.ID = b_crm_deal.MODIFY_BY_ID
            LEFT JOIN b_crm_deal_category ON b_crm_deal.CATEGORY_ID = b_crm_deal_category.ID
            LEFT JOIN b_crm_status ON b_crm_status.STATUS_ID = b_crm_deal.STAGE_ID
            LEFT JOIN b_user_field_enum DD_VENUE ON DD_VENUE.ID = b_uts_crm_deal.UF_CRM_1562069876
            LEFT JOIN b_user_field_enum DD_VENTURE ON DD_VENTURE.ID = b_uts_crm_deal.UF_CRM_1562067632
            LEFT JOIN b_user_field_enum DD_LANG ON DD_LANG.ID = b_uts_crm_deal.UF_CRM_1559996078
            LEFT JOIN b_user_field_enum DD_ACC_OWNER ON DD_ACC_OWNER.ID = b_uts_crm_deal.UF_CRM_1559996803
            LEFT JOIN b_user_field_enum DD_PC ON DD_PC.ID = b_uts_crm_deal.UF_CRM_1562743391
            LEFT JOIN b_user_field_enum DD_DCMandateRequirements ON DD_DCMandateRequirements.ID = b_uts_crm_deal.UF_CRM_1563823047
        WHERE
            b_uts_crm_deal.UF_CRM_5D64C4C197AB2 LIKE '%2023/07/17%'";      
            
        $dataLeads = DB::connection('mysql_bitrix')->select($query_string);
        // dd(count($dataLeads));
        $this->storeModifiedLeads($dataLeads);
      
    }

    public function storeModifiedLeads($dataLeads)
    {
       //Clear Old Data
       DB::table('temp_modified_leads')->delete();

       try{

           foreach ($dataLeads as $d)
           {
               $deals = tempModifiedLeads::create(); 
               $deals->bxID = $d->ID;
               $deals->bxDateCreate = $d->DATE_CREATE;
               $deals->bxDateModify = $d->DATE_MODIFY;
               $deals->bxModifiedBy = $d->ModifiedBy;
               $deals->bxResponsiblePerson = $d->ResponsiblePerson;
               $deals->bxPipeline = $d->Pipeline;
               $deals->bxPipelineCategory = $d->PipelineCategory;
               $deals->bxVenture = $d->Venture;
               $deals->bxVenue = $d->Venue;
               $deals->bxDealStage = $d->DealStage;
               $deals->bxHistory = $d->History;
               $deals->bxEndDate = $d->EndDate;
               $deals->bxBatchNumber = $d->BatchNumber;
               $deals->bxLeadReceivedDate = $d->LeadReceivedDate;
               $deals->bxAllocationDate = $d->AllocationDate;
               $deals->bxReferenceNumber = $d->ReferenceNumber;
               $deals->bxNewMembershipFee = number_format((float)str_replace($d->NewMembershipFee,'|ZAR',''),2);
               $deals->bxFirstname = $d->Firstname;
               $deals->bxSurname = $d->Surname;
               $deals->bxLanguage = $d->Language;
               $deals->bxDateOfBirth = $d->DateOfBirth;
               $deals->bxDCMandateRequirements = $d->DCMandateRequirements;
               $deals->bxWorkTel = $d->WorkTel;
               $deals->bxHomeTel = $d->HomeTel;
               $deals->bxCellTel = $d->CellTel;
               $deals->bxOtherTel = $d->OtherTel;
               $deals->bxAccHolderTel= $d->AccHolderTel;
               $deals->save();
           }
            
        } catch(Exception $e)
        
        {
            Log::debug($e);
        }
     
           
    }
    
    public function getViewed(Request $request)
    {

        $query_string = "SELECT
            b_crm_event.DATE_CREATE,
            concat(ASN_USER.NAME, ' ', ASN_USER.LAST_NAME) AS 'ResponsiblePerson',
            b_crm_event_relations.ENTITY_ID,
            b_crm_deal_category.NAME AS 'Pipeline',
            DD_PC.VALUE AS 'PipelineCategory',
            b_uts_crm_deal.UF_CRM_1565618513 AS 'DealCategory',
            DD_VENTURE.VALUE AS 'Venture',
            DD_VENUE.VALUE AS 'Venue',
            b_crm_status.NAME AS 'DealStage',
            b_uts_crm_deal.UF_CRM_1559995636 AS 'ReferenceNumber',
            b_uts_crm_deal.UF_CRM_1559996323 AS 'WorkTel',
            b_uts_crm_deal.UF_CRM_1559996337 AS 'HomeTel',
            b_uts_crm_deal.UF_CRM_1559996351 AS 'CellTel',
            b_uts_crm_deal.UF_CRM_1559996359 AS 'OtherTel'
        FROM
            b_crm_event
            LEFT JOIN b_crm_event_relations ON b_crm_event.ID = b_crm_event_relations.EVENT_ID
            LEFT JOIN b_user ASN_USER ON ASN_USER.ID = b_crm_event.CREATED_BY_ID
            LEFT JOIN b_crm_deal ON b_crm_deal.ID = b_crm_event_relations.ENTITY_ID
            LEFT JOIN b_uts_crm_deal ON b_crm_event_relations.ENTITY_ID = b_uts_crm_deal.VALUE_ID
            LEFT JOIN b_crm_deal_category ON b_crm_deal.CATEGORY_ID = b_crm_deal_category.ID
            LEFT JOIN b_user_field_enum DD_VENTURE ON DD_VENTURE.ID = b_uts_crm_deal.UF_CRM_1562067632
            LEFT JOIN b_user_field_enum DD_VENUE ON DD_VENUE.ID = b_uts_crm_deal.UF_CRM_1562069876
            LEFT JOIN b_user_field_enum DD_DC ON DD_DC.ID = b_uts_crm_deal.UF_CRM_1565618513
            LEFT JOIN b_crm_status ON b_crm_status.STATUS_ID = b_crm_deal.STAGE_ID
            LEFT JOIN b_user_field_enum DD_PC ON DD_PC.ID = b_uts_crm_deal.UF_CRM_1562743391
        WHERE
            CAST(b_crm_event.DATE_CREATE AS date) = '$request->date'
            AND b_crm_event.EVENT_NAME = 'View'
            AND (ASN_USER.LAST_NAME <> 'User' OR ASN_USER.LAST_NAME <> 'Nerd')";      
            
        $dataViews = DB::connection('mysql_bitrix')->select($query_string);
        //  dd($dataViews);
        // dd(count($dataViews));
        $this->storeViewed($dataViews);
      
    }

    public function storeViewed($dataViews)
    {
       //Clear Old Data
       DB::table('temp_vieweds')->delete();

       try{

           foreach ($dataViews as $d)
           {
               $viewed = tempViewed::create(); 
               $viewed->bxDateCreate = $d->DATE_CREATE;
               $viewed->bxResponsiblePerson = $d->ResponsiblePerson;
               $viewed->bxEntityID = $d->ENTITY_ID;
               $viewed->bxPipeline = $d->Pipeline;
               $viewed->bxPipelineCategory = $d->PipelineCategory;
               $viewed->bxDealCategory = $d->DealCategory;
               $viewed->bxVenture = $d->Venture;
               $viewed->bxVenue = $d->Venue;
               $viewed->bxDealStage = $d->DealStage;
               $viewed->bxReferenceNumber = $d->ReferenceNumber;
               $viewed->bxWorkTel = $d->WorkTel;
               $viewed->bxHomeTel = $d->HomeTel;
               $viewed->bxCellTel = $d->CellTel;
               $viewed->bxOtherTel = $d->OtherTel;
               $viewed->save();
           }
            
        } catch(Exception $e)
        
        {
            Log::debug($e);
        }
     
           
    }
    
    public function getWonCheck(Request $request)
    {
        $query_string = "SELECT
            b_crm_deal.ID,
            b_crm_deal.DATE_CREATE,
            b_crm_deal.DATE_MODIFY,
            concat(MOD_USER.NAME, ' ', MOD_USER.LAST_NAME) AS 'ModifiedBy',
            concat(ASN_USER.NAME, ' ', ASN_USER.LAST_NAME) AS 'ResponsiblePerson',
            b_crm_deal_category.NAME AS 'Pipeline',
            DD_PC.VALUE AS 'PipelineCat',
            DD_VENTURE.VALUE AS 'Venture',
            DD_VENUE.VALUE AS 'Venue',
            b_crm_status.NAME AS 'DealStage',
            b_uts_crm_deal.UF_CRM_1559995324 AS 'FinalSaleType',
            Concat(
                if(LOCATE('query', b_uts_crm_deal.UF_CRM_5D64C4C197AB2) > 0, 'Solved Query ', ''),
                if(LOCATE('cancel', b_uts_crm_deal.UF_CRM_5D64C4C197AB2) > 0, 'Conserved Sale', '')
            ) AS 'History',
            b_crm_deal.CLOSEDATE AS 'EndDate',
            b_uts_crm_deal.UF_CRM_1559994687 AS 'BatchNumber',
            b_uts_crm_deal.UF_CRM_1559995456 AS 'LeadReceivedDate',
            b_uts_crm_deal.UF_CRM_1559995470 AS 'AllocationDate',
            b_uts_crm_deal.UF_CRM_1559995636 AS 'ReferenceNumber',
            b_uts_crm_deal.UF_CRM_1559995922 AS 'NewMembershipFee',
            b_uts_crm_deal.UF_CRM_1559996044 AS 'Firstname',
            b_uts_crm_deal.UF_CRM_1559996052 AS 'Surname',
            DD_LANG.VALUE AS 'Language',
            DD_FinalMandate.VALUE AS 'FinalMandateStatus',
            b_uts_crm_deal.UF_CRM_1559996248 AS 'DateOfBirth',
            b_uts_crm_deal.UF_CRM_1559996323 AS 'WorkTel',
            b_uts_crm_deal.UF_CRM_1559996337 AS 'HomeTel',
            b_uts_crm_deal.UF_CRM_1559996351 AS 'CellTel',
            b_uts_crm_deal.UF_CRM_1559996359 AS 'OtherTel',
            b_uts_crm_deal.UF_CRM_1559996874 AS 'AccHolderTel'
        FROM
            b_crm_deal
            INNER JOIN b_uts_crm_deal ON b_crm_deal.ID = b_uts_crm_deal.VALUE_ID
            LEFT JOIN b_user ASN_USER ON ASN_USER.ID = b_crm_deal.ASSIGNED_BY_ID
            LEFT JOIN b_user MOD_USER ON MOD_USER.ID = b_crm_deal.MODIFY_BY_ID
            LEFT JOIN b_crm_deal_category ON b_crm_deal.CATEGORY_ID = b_crm_deal_category.ID
            LEFT JOIN b_crm_status ON b_crm_status.STATUS_ID = b_crm_deal.STAGE_ID
            LEFT JOIN b_user_field_enum DD_VENUE ON DD_VENUE.ID = b_uts_crm_deal.UF_CRM_1562069876
            LEFT JOIN b_user_field_enum DD_VENTURE ON DD_VENTURE.ID = b_uts_crm_deal.UF_CRM_1562067632
            LEFT JOIN b_user_field_enum DD_PC ON DD_PC.ID = b_uts_crm_deal.UF_CRM_1562743391
            LEFT JOIN b_user_field_enum DD_LANG ON DD_LANG.ID = b_uts_crm_deal.UF_CRM_1559996078
            LEFT JOIN b_user_field_enum DD_FinalMandate ON DD_FinalMandate.ID = b_uts_crm_deal.UF_CRM_1562743007
        WHERE
            CAST(b_crm_deal.CLOSEDATE AS date) = '$request->date'
            AND (b_crm_status.NAME = 'Sale' OR b_crm_status.NAME = 'No Sale' OR b_crm_status.NAME LIKE '%Permission%')
        ORDER BY
            b_crm_deal_category.NAME Limit 20";      
            
        $dataWon = DB::connection('mysql_bitrix')->select($query_string);
        //  dd($dataWon);
        // dd(count($dataViews));
        $this->storeWonCheck($dataWon);
      
    }

    public function storeWonCheck($dataWon)
    {
       //Clear Old Data
       DB::table('temp_won_checks')->delete();

       try{

           foreach ($dataWon as $d)
           {
               $won = tempWonCheck::create(); 
               $won->bxID = $d->ID;
               $won->bxDateCreate = $d->DATE_CREATE;
               $won->bxDateModify = $d->DATE_MODIFY;
               $won->bxModifiedBy = $d->ModifiedBy;
               $won->bxResponsiblePerson = $d->ResponsiblePerson;
               $won->bxPipeline = $d->Pipeline;
               $won->bxPipelineCategory = $d->PipelineCat;
               $won->bxVenture = $d->Venture;
               $won->bxVenue = $d->Venue;
               $won->bxDealStage = $d->DealStage;
               $won->bxFinalSaleType = $d->FinalSaleType;
               $won->bxHistory = $d->History;
               $won->bxEndDate = $d->EndDate;
               $won->bxBatchNumber = $d->BatchNumber;
               $won->bxLeadReceivedDate = $d->LeadReceivedDate;
               $won->bxAllocationDate = $d->AllocationDate;
               $won->bxReferenceNumber = $d->ReferenceNumber;
               $won->bxNewMembershipFee = number_format((float)str_replace($d->NewMembershipFee,'|ZAR',''),2);
               $won->bxFirstname = $d->Firstname;
               $won->bxSurname = $d->Surname;
               $won->bxLanguage = $d->Language;
               $won->bxFinalMandateStatus = $d->FinalMandateStatus;
               $won->bxDateOfBirth = $d->DateOfBirth;
               $won->bxWorkTel = $d->WorkTel;
               $won->bxHomeTel = $d->HomeTel;
               $won->bxCellTel = $d->CellTel;
               $won->bxOtherTel = $d->OtherTel;
               $won->bxAccHolderTel= $d->AccHolderTel;
    
               $won->save();
           }
            
        } catch(Exception $e)
        
        {
            Log::debug($e);
        }
    
    }

    /**
     * Display the specified resource.
     */
    public function range()
    {
        return view('calls.reports.index');
    }
    
    public function report()
    {
        dd('Do report');
        return view('calls.reports.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
