<?php

namespace App\Models\Calls;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallImports extends Model
{
    use HasFactory;
    // protected $fillable = ['startTime','groupName','UserID','fromNumber','dialedNumber','answered','answerTie','ReleaseTime'];
    protected $guarded =[];

    public function importToDB()
    {
     
        $path = resource_path('pending-files/*.csv');

        $g = glob($path);

        foreach (array_slice($g, 0, 1) as $file)
        {
            $data = array_map('str_getcsv', file($file),[';']);

            foreach($data as $key=>$row)
            {

            if($row[5] == 'Yes') {
                $callData = CallImports::create([
                    'startTime' => $row[0],
                    'groupName'=> $row[1],
                    'userID'=> $row[2],
                    'fromNumber' =>$row[3],
                    'dialedNumber' => $row[4],
                    'answered' => $row[5],
                    'answerTime' => $row[6],
                    'releaseTime' => $row[7],
                    'terminationCause' => $row[8],
                    'trackingID' => $row[9],
                    'callID' => $row[10],
                    'groupNumber' => $row[11]]);
            } else {
                $callData = CallImports::create([
                    'startTime' => $row[0],
                    'groupName'=> $row[1],
                    'userID'=> $row[2],
                    'fromNumber' =>$row[3],
                    'dialedNumber' => $row[4],
                    'answered' => $row[5],
                    // 'answerTime' => $row[6],
                    'releaseTime' => $row[7],
                    'terminationCause' => $row[8],
                    'trackingID' => $row[9],
                    'callID' => $row[10],
                    'groupNumber' => $row[11]]);
            }


            }
            unlink($file);   
        }
    }
}
