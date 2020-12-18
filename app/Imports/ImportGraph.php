<?php

namespace App\Imports;

use App\Graph;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportGraph implements ToModel, WithValidation, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // return $row;
        // var_dump($row);
        return new Graph([

        //  'Date'  => $row['date'],
        'Date'  => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date']),
          'Revenue' => $row['revenue'],
          'CostOfGoodsSold'  => $row['cost_of_goods_sold'],
          'GrossProfit'  => $row['gross_profit'],
          'Payroll'  => $row['payroll'],
          'Contactors'  => $row['contactors'],
          'MarketingExpenses'  => $row['marketing_expenses'],
          'OfficeRentAndExpenses'  => $row['office_rent_and_expenses'],
          'WebServicesAndUtilities'  => $row['web_services_and_utilities'],
          'TravelAndEntertainment'  => $row['travel_and_entertainment'],
          'TotalExpenses'  => $row['total_expenses'],
          'NetIncome'  => $row['net_income'],
          'CashOnHand'  => $row['cash_on_hand'],
          'MonthsOfRunway'  => $row['months_of_runway'],
          'ProductKPI1'  => $row['product_kpi_1'],
          'ProductKPI2'  => $row['product_kpi_2'],
          'ProductKPI3'  => $row['product_kpi_3'],
          'MarketingKPI1'  => $row['marketing_kpi_1'],
          'MarketingKPI2'  => $row['marketing_kpi_2'],
          'MarketingKPI3'  => $row['marketing_kpi_3'],
          'SalesKPI1'  => $row['sales_kpi_1'],
          'SalesKPI2'  => $row['sales_kpi_2'],
          'SalesKPI3'  => $row['sales_kpi_3'],
          'CustomerSuccessKPI1'  => $row['customer_success_kpi_1'],
          'CustomerSuccessKPI2'  => $row['customer_success_kpi_2'],
          'CustomerSuccessKPI3'  => $row['customer_success_kpi_3'],
            'company_id' => \Auth::user()->id,
            'sheet_name' => 'Excel - ' . request()->file('file')->getClientOriginalName()

        ]);
    }

    public function rules(): array
    {
        return [

        ];
    }
}
