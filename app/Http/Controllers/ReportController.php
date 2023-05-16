<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Parking;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('_token')) {
            $request->validate([
                'from_date' => 'bail|required|date',
                'to_date' => 'bail|required|date'
            ]);
        }

        $from = date($request->from_date);
        $to = date($request->to_date);
        $categories = Category::all();

        $parkings = Parking::query();

        if ($from != "")
            $parkings->where('created_at', '>=', $from);
        if ($to != "")
            $parkings->where('created_at', '<=', $to);
        if (count($request->all())) {
            if ($request->category_id != -1)
                $parkings->where('category_id', $request->category_id);
            if ($request->car_no != NULL)
                $parkings->where('vehicle_no', $request->car_no);
            if ($request->driver_name != NULL)
                $parkings->where('driver_name', $request->driver_name);
            if ($request->driver_mobile != NULL)
                $parkings->where('driver_mobile', $request->driver_mobile);
        }

        $parkings = $parkings->get();
        $request = $request->all();

        return view('content.reports.index', compact('categories', 'parkings', 'request'));
    }

    /**
     * Generate pdf file for filtered parking data.
     *
     * @return \Illuminate\Http\Response
     */

    public function pdf_report(Request $request)
    {
        $request = $request->data;

        $from = date($request['from_date']);
        $to = date($request['to_date']);

        $parkings = Parking::query();

        if ($from != "")
            $parkings->where('created_at', '>=', $from);
        if ($to != "")
            $parkings->where('created_at', '<=', $to);

        if (count($request)) {
            if ($request['category_id'] != -1)
                $parkings->where('category_id', $request['category_id']);
            if ($request['car_no'] != NULL)
                $parkings->where('car_no', $request['car_no']);
            if ($request['driver_name'] != NULL)
                $parkings->where('driver_name', $request['driver_name']);
            if ($request['driver_mobile'] != NULL)
                $parkings->where('driver_mobile', $request['driver_mobile']);
        }

        $parkings = $parkings->get();

        $filename = 'parking_report_' . date('Ymdhim');
        $mpdf = new \Mpdf\Mpdf();
        $html = view('content.reports.pdf_report', compact('parkings', 'request'));
        $mpdf->WriteHTML($html);
        $mpdf->SetHTMLFooter('
            <table width="100%" style="border:none;">
            <tr>
                <td style="border:none;" width="33%">{DATE j-m-Y H:i:s}</td>
                <td style="border:none;" width="33%" align="center">{PAGENO}/{nbpg}</td>
                <td  width="33%" style="text-align: right; border:none;">' . request()->user()->name . '</td>
            </tr>
        </table>');
        return $mpdf->Output($filename . '.pdf', 'I');
    }
}
