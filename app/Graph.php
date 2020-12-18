<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Graph extends Model
{
  protected $table = 'graphs';
  public $timestamps = true;


  protected $fillable = [
  'Date', 'Revenue', 'CostOfGoodsSold', 'GrossProfit', 'Payroll', 'Contactors',
  'MarketingExpenses', 'OfficeRentAndExpenses', 'WebServicesAndUtilities',
  'TravelAndEntertainment', 'TotalExpenses', 'NetIncome', 'CashOnHand',
  'MonthsOfRunway', 'ProductKPI1', 'ProductKPI2', 'ProductKPI3',
  'MarketingKPI1', 'MarketingKPI2', 'MarketingKPI3', 'SalesKPI1',
  'SalesKPI2', 'SalesKPI3', 'CustomerSuccessKPI1', 'CustomerSuccessKPI2', 'CustomerSuccessKPI3',
  'company_id', 'sheet_name'
  ];
}
