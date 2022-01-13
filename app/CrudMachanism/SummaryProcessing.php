<?php 
namespace App\CrudMachanism;

use App\Models\StockSummary;

class SummaryProcessing
{
  

    public function __construct($model, $relation)
    {
       
    }

    public static function summaryData($model, $relation, $slug)
    {
        $summaryData = $model::with($relation)->get();

        $relational = $relation;

        foreach ($summaryData as $key => $summary) {
            $summaryData[$key]['stock_in']        = $summary->$relational->sum('stock_in');
            $summaryData[$key]['stock_out']       = $summary->$relational->sum('stock_out');
            $summaryData[$key]['sub_total']       = (int)$summary->$relational->sum('stock_in') - (int)$summary->$relational->sum('stock_out');
            $summaryData[$key]['total_stock_in']  = StockSummary::where('slug', $slug)->first()->stock_in;
            $summaryData[$key]['total_stock_out'] = StockSummary::where('slug', $slug)->first()->stock_out;
            $summaryData[$key]['total_stock']     = StockSummary::where('slug', $slug)->first()->total;

        }

        return $summaryData;
    }

    public static function dataProcessing($model, $slug)
    {
        $processData = $model::get();

        foreach ($processData as $key => $data) {

            $processData[$key]['total'] = StockSummary::where('slug', $slug)->first()->total;
            
        }

        return $processData;
    }
}