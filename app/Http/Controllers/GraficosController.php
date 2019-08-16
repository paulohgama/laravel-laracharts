<?php

namespace App\Http\Controllers;

use App\Area;
use App\Barra;
use App\Calendario;
use App\Coluna;
use App\Combo;
use App\Donut;
use App\Gauge;
use App\Geo;
use App\Linha;
use App\Pizza;
use Khill\Lavacharts\DataTables\Formats\DateFormat;

class GraficosController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function graficoArea()
    {
        $population = \Lava::DataTable();
        $areas = Area::select('year as 0', 'quantity as 1')->get()->toArray();
        $population->addDateColumn('Ano', new DateFormat(array('pattern' => 'yyyy')))
            ->addNumberColumn('Número de pessoas')
            ->addRows($areas);
        \Lava::AreaChart('Populacao', $population, [
            'title' => 'Tamanho da População',
            'legend' => [
                'position' => 'in',
            ],
        ]);
        return view('graficos.area');
    }

    public function graficoBarra()
    {
        $votes = \Lava::DataTable();
        $barras = Barra::select('food as 0', 'likes as 1', 'unlikes as 2')->get()->toArray();
        $votes->addStringColumn('Food Poll')
            ->addNumberColumn('Likes')
            ->addNumberColumn('Unklikes')
            ->addRows($barras);

        \Lava::BarChart('Votes', $votes);

        return view('graficos.barra');
    }

    public function graficoCalendario()
    {
        $sales = \Lava::DataTable();
        $calendarios = Calendario::select('date as 0', 'solds as 1')->get()->toArray();
        $sales->addDateColumn('Date', new DateFormat(array('formatType' => 'short', 'pattern' => 'dd/MM/yyyy', 'timeZone' => '-3')))
            ->addNumberColumn('Orders')
            ->addRows($calendarios);


        \Lava::CalendarChart('Sales', $sales, [
            'title' => 'Cars Sold',
            'unusedMonthOutlineColor' => [
                'stroke' => '#ECECEC',
                'strokeOpacity' => 0.75,
                'strokeWidth' => 1,
            ],
            'dayOfWeekLabel' => [
                'color' => '#4f5b0d',
                'fontSize' => 16,
                'italic' => true,
            ],
            'noDataPattern' => [
                'color' => '#DDD',
                'backgroundColor' => '#11FFFF',
            ],
            'colorAxis' => [
                'values' => [0, 100],
                'colors' => ['white', 'black'],
            ],
        ]);
        return view('graficos.calendario');
    }

    public function graficoColuna()
    {
        $finances = \Lava::DataTable();
        $colunas = Coluna::select('year as 0', 'sales as 1', 'expensive as 2')->get()->toArray();
        $finances->addDateColumn('Year', new DateFormat(array('pattern' => 'yyyy')))
            ->addNumberColumn('Sales')
            ->addNumberColumn('Expenses')
            ->addRows($colunas);

        \Lava::ColumnChart('Finances', $finances, [
            'title' => 'Company Performance',
            'titleTextStyle' => [
                'color' => '#eb6b2c',
                'fontSize' => 14,
            ],
        ]);
        return view('graficos.coluna');
    }

    public function graficoCombo()
    {
        $finances = \Lava::DataTable();
        $combos = Combo::select('year as 0', 'sales as 1', 'expensive as 2', 'net_worth as 3')->get()->toArray();
        $finances->addDateColumn('Year')
            ->addNumberColumn('Sales')
            ->addNumberColumn('Expenses')
            ->addNumberColumn('Net Worth')
            ->addRows($combos);

        \Lava::ComboChart('Finances', $finances, [
            'title' => 'Company Performance',
            'titleTextStyle' => [
                'color' => 'rgb(123, 65, 89)',
                'fontSize' => 16,
            ],
            'legend' => [
                'position' => 'in',
            ],
            'seriesType' => 'bars',
            'series' => [
                2 => ['type' => 'line'],
            ],
        ]);

        return view('graficos.combo');
    }
    public function graficoDonut()
    {
        $reasons = \Lava::DataTable();
        $donuts = Donut::select('type as 0', 'votes as 1')->get()->toArray();
        $reasons->addStringColumn('Reasons')
            ->addNumberColumn('Percent')
            ->addRows($donuts);

        \Lava::DonutChart('IMDB', $reasons, [
            'title' => 'Reasons I visit IMDB',
        ]);
        return view('graficos.donut');
    }

    public function graficoGauge()
    {
        $temps = \Lava::DataTable();
        $gauges = Gauge::select('type as 0', 'desempenho as 1')->get()->toArray();
        $temps->addStringColumn('Type')
            ->addNumberColumn('Value')
            ->addRows($gauges);

        \Lava::GaugeChart('Temps', $temps, [
            'width' => 400,
            'greenFrom' => 0,
            'greenTo' => 69,
            'yellowFrom' => 70,
            'yellowTo' => 89,
            'redFrom' => 90,
            'redTo' => 100,
            'majorTicks' => [
                'Safe',
                'Critical',
            ],
        ]);

        return view('graficos.gauge');
    }
    public function graficoGeo()
    {
        $popularity = \Lava::DataTable();
        $geos = Geo::select('country as 0', 'popularity as 1')->get()->toArray();
        $popularity->addStringColumn('Country')
                ->addNumberColumn('Popularity')
                ->addRows($geos);

        \Lava::GeoChart('Popularity', $popularity);
        return view('graficos.geo');

    }
    public function graficoPizza()
    {
        $reasons = \Lava::DataTable();
        $pizzas = Pizza::select('type as 0', 'votes as 1')->get()->toArray();
        $reasons->addStringColumn('Reasons')
            ->addNumberColumn('Percent')
            ->addRows($pizzas);

        \Lava::PieChart('IMDB', $reasons, [
            'title' => 'Reasons I visit IMDB',
            'is3D' => true,
        ]);

        return view('graficos.pizza');

    }
    public function graficoLinha()
    {
        $temperatures = \Lava::DataTable();
        $linhas = Linha::select('date as 0', 'min as 1', 'med as 2', 'max as 3')->get()->toArray();
        $temperatures->addDateColumn('Date')
            ->addNumberColumn('Max Temp')
            ->addNumberColumn('Mean Temp')
            ->addNumberColumn('Min Temp')
            ->addRows($linhas);

        \Lava::LineChart('Temps', $temperatures, [
            'title' => 'Weather in October',
        ]);

        return view('graficos.linha');
    }
    public function graficoScatter()
    {
        $datatable = \Lava::DataTable();
        $datatable->addNumberColumn('Age');
        $datatable->addNumberColumn('Weight');

        for ($i=0; $i < 30; $i++) {
            $datatable->addRow([rand(20,30), rand(150,250)]);
        }

        \Lava::ScatterChart('AgeWeight', $datatable, [
            'width' => 400,
            'legend' => [
                'position' => 'none'
            ],
            'hAxis' => [
                'title' => 'Age'
            ],
            'vAxis' => [
                'title' => 'Weight'
            ]
        ]);
        return view('graficos.scatter');
    }
}
