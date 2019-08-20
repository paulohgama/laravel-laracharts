<?php

namespace App\Http\Controllers;

use App\Oportunidade;
use App\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OportunidadeController extends Controller
{
    public function geral(Request $request)
    {
        $geral = \Lava::DataTable();
        $oportunidades = Oportunidade::select(DB::raw("ds_status as '0', count(ds_status) as '1'"));
        if($request->data_inicial != null)
        {
            $data_inicial = explode('/',$request->data_inicial)[2]."-".explode('/',$request->data_inicial)[1]."-".explode('/',$request->data_inicial)[0];
            $oportunidades->where('dt_oportunidade', '>=', $data_inicial);
        }
        if($request->data_final != null)
        {
            $data_final = explode('/',$request->data_final)[2]."-".explode('/',$request->data_final)[1]."-".explode('/',$request->data_final)[0];
            $oportunidades->where('dt_oportunidade', '<=', $data_final);
        }
        $oportunidades->groupBy('ds_status');
        $geral->addStringColumn('Status')
            ->addNumberColumn('Quantidades')
            ->addRows($oportunidades->get()->toArray());

        \Lava::PieChart('Geral', $geral, [
            'title' => 'Oportunidades por Status',
            'is3D' => true,
            'height' => '100%',
        ]);

        return view('operatrix.geral')->with(['data_inicial' => $request->data_inicial, 'data_final' => $request->data_final]);
    }

    public function performance(Request $request)
    {
        $performance = \Lava::DataTable();
        $anos = Oportunidade::select(DB::raw('YEAR(dt_oportunidade) as ano'))->distinct()->get();
        $status = Oportunidade::select('ds_status')->distinct()->get();
        $oportunidades = Oportunidade::select(DB::raw("MONTH(dt_oportunidade) as '0', count(MONTH(dt_oportunidade)) as '1'"));
        if($request->ano)
        {
            $oportunidades->where(DB::raw('YEAR(dt_oportunidade)'), $request->ano);
        }
        if($request->status)
        {
            $oportunidades->where('ds_status', $request->status);
        }
        $oportunidades = $oportunidades->groupBy(DB::raw('MONTH(dt_oportunidade)'))->get()->toArray();
        $meses = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
        $oportunidades = array_map(function($o) use ($meses) {
            $o[0] = $meses[$o[0]-1];
            return $o;
        }, $oportunidades);
        $performance->addStringColumn('Mês')
            ->addNumberColumn($request->status ? $request->status :'Quantidades')
            ->addRows($oportunidades);

        \Lava::LineChart('Performance_Linha', $performance, [
            'title' => 'Performance de Oportunidades',
            'series' => [
                [ 'color' => 'red' ]
            ],
        ]);

        \Lava::AreaChart('Performance_Area', $performance, [
            'title' => 'Performance de Oportunidades',
            'series' => [
                [ 'color' => 'red' ]
            ],
        ]);

        return view('operatrix.performance')->with(array(
            'anos' => $anos,
            'status' => $status,
            'ano_request' => $request->ano,
            'status_request' => $request->status
        ));
    }

    public function vendas(Request $request)
    {
        $vendedores = \Lava::DataTable();
        $vendas = Venda::select(DB::raw("nm_vendedor as '0', count(nm_vendedor) as '1'"))->where('ic_status', $request->status)->groupBy('nm_vendedor')->orderBy(DB::raw("count(nm_vendedor)"), 'asc')->get()->toArray();
        $vendedores->addStringColumn('Vendedor')
            ->addNumberColumn('Vendas')
            ->addRows($vendas);
        \Lava::ColumnChart('Vendas', $vendedores, [
            'title' =>  $request->status ? 'Vendas por Vendedores' : 'Cancelamento por Vendedores',
            'titleTextStyle' => [
                'color' => '#eb6b2c',
                'fontSize' => 14,
            ],
        ]);
        return view('operatrix.vendas');
    }
}
