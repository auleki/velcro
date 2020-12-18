<?php

namespace App\Services;

use App\Tool;
use App\Graph;
use App\Services\Client;
use App\Sheet;
use App\SheetColumnRow;
use App\SpreadSheet;
use App\Imports\GetSheet;
use Maatwebsite\Excel\Facades\Excel;
use App\ExcelSheet;

	
	class MetricValue
	{
        public static function getMetricValues($source, $col, $row, $type, $sheet) 
        {
            if($type == 'google') {
                $tool = Tool::where('name', $type)->first();
                $sheet = Sheet::find($source);
                $spreadsheet = SpreadSheet::find($sheet->spread_sheet_id);
                $sheet_column_row = SheetColumnRow::where('sheet_id', $sheet->id)->first();
                $alphabet = range('A', 'Z');
                $length = 26;
                // dd($sheet, $spreadsheet, $sheet_column_row);

                $client = Client::getClient($tool);
                $service = new \Google_Service_Sheets($client);
                // dd($service, $client);
                $new_obj = new \stdClass;
                // Get metric values
                // $range = $sheet->name . '!' . $sheet_column_row->metric_column . $row . ':' . $alphabet[$length-1] . $row ;
                $range = $sheet->name . '!' . $col . $row . ':' . $alphabet[$length-1] . $row ;
                // dd($range, $spreadsheet);

                $response = $service->spreadsheets_values->get($spreadsheet->spread_sheet_id, $range);
                $metric_values = $response->getValues();
                // dd($metric_values, $response);

                // Get dates
                $range = $sheet->name . '!' . $sheet_column_row->date_row . ':' . $sheet_column_row->date_row;
                $response = $service->spreadsheets_values->get($spreadsheet->spread_sheet_id, $range);
                $dates = $response->getValues();

                $data = [];
                // dd($metric_values);
                if(!$metric_values) return $data;
                for ($i=0; $i < count($metric_values[0]); $i++) {
                    if(!empty($dates[0][$i])) {
                        $obj = new \stdClass;
                        $val = $metric_values[0][$i];
                        $ndate = \DateTime::createFromFormat('y', explode(" ", $dates[0][$i])[1]);
                        //now to get the output
                        $date = $ndate->format('Y');
                        $obj->value = $val;
                        $obj->date = explode(" ", $dates[0][$i])[0] . ' ' . $date;

                        array_push($data, $obj);
                    }
                }
                
                return $data;
            } elseif ($type == 'excel') {
                //    dd($source, $company, $metrics, $type, $rows, $sheet);
                    $spread_sheet = ExcelSheet::find($source);

                    $path = explode('storage', $spread_sheet->link)[1];

                    $import = new GetSheet();
                    $ts = Excel::import($import, $path);
                    $sheet_names = $import->sheetNames;
                    $sheet_data = $import->sheetData;
                    // $data = [];

                    $key = array_search($sheet, $sheet_names);
                    $sheet_data = $sheet_data[$key];

                    $data = [];
                    foreach ($sheet_data as $sheet) {
                        foreach ($sheet as $key => $value) {
                            $data_obj = new \stdClass;
                            // dd($key, $kpi);
                            if($key == $row) {
                                $data_obj->value = $value;
                                $dateFormat = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($sheet['Date']);
                                $date = $dateFormat->format('M Y');
                                // dd($date);
                                $data_obj->date = $date;
                                array_push($data, $data_obj);
                            }
                        }
                    }

                    return $data;
            }
        }
    
        public static function selectDates($client, $range, $spreadsheetId) 
        {
            
            $service = new \Google_Service_Sheets($client);

            // Get dates
            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
            $dates = $response->getValues();
            // dd($response);

            $row_length = count($dates[0]);

            $all_dates = [];
            // dd($dates[0]);
            foreach ($dates[0] as $date) {
                if (!empty($date)) {
                    try {
                        $ndate = new \DateTime($date);
                    } catch (exception $e) {
                        return back()->withErrors(['Some selected columns contain invalid dates']);
                    }
                    array_push($all_dates, $date);
                }
            }
            
            return $all_dates;
        }

        public static function rowLength($client, $range, $spreadsheetId) {
            $service = new \Google_Service_Sheets($client);

            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
            $dates = $response->getValues();
            // dd($response);

            $row_length = count($dates[0]);

            return $row_length;
        }

        public static function selectNames($client, $range, $spreadsheetId, $sheet_column_row)
        {
            $service = new \Google_Service_Sheets($client);

            // Get metric names
            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
            $metrics = $response->getValues();

            $all_metrics = [];
            foreach ($metrics as $metric) {
                $data = new \stdClass;
                if (count($metric) > 0) {
                    $i = array_search($metric, $metrics);
                    // dd($i);
                    $data->column = $sheet_column_row->metric_column;
                    $data->index = $i + 1;
                    $data->name = $metric[0];
                    array_push($all_metrics, $data);
                }
            }

            return $all_metrics;
        }

          public static function sheets($client, $spreadsheetId) {
            $service = new \Google_Service_Sheets($client);

            try{
                $spreadSheet = $service->spreadsheets->get($spreadsheetId);
                $sheets = $spreadSheet->getSheets();
                $all_sheets = [];
                foreach($sheets as $sheet) {
                    // if($sheet->properties->sheetId == $gid){
                    //     $range = $sheet->properties->title;
                    //     break;
                    // }
                    $name = $sheet->properties->title;
                    $gid = $sheet->properties->sheetId;
                    $new_sheet = new \stdClass;
                    $new_sheet->name = $name;
                    $new_sheet->sheetId = $gid;
                    $new_sheet->spread_sheet_id = $spreadsheetId;
                    array_push($all_sheets, $new_sheet);
                }   
            }
            catch(exception $e){
                return back();
            }

            return $all_sheets;
        }
    }
?>
