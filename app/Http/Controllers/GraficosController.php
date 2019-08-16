<?php

namespace App\Http\Controllers;

use App\Area;
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

        $votes->addStringColumn('Food Poll')
            ->addNumberColumn('Likes')
            ->addNumberColumn('Unklikes');
            $array = array('Tacos', 'Salad', 'Pizza', 'Apples', 'Fish', 'Paçoca');
            foreach($array as $item)
            {
                $likes = rand(1, 5000);
                $unlikes = 5000 - $likes;
                $votes->addRow([$item, $likes, $unlikes]);
            }

        \Lava::BarChart('Votes', $votes);

        return view('graficos.barra');
    }

    public function graficoCalendario()
    {
        $sales = \Lava::DataTable();

        $sales->addDateColumn('Date')
            ->addNumberColumn('Orders');

        foreach (range(1, 12) as $month) {
            for ($a = 0; $a < 20; $a++) {
                $day = rand(1, 30);
                $sales->addRow(["2014-${month}-${day}", rand(0, 100)]);
            }
        }

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
                'colors' => ['black', 'green'],
            ],
        ]);
        return view('graficos.calendario');
    }

    public function graficoColuna()
    {
        $finances = \Lava::DataTable();

        $finances->addDateColumn('Year')
            ->addNumberColumn('Sales')
            ->addNumberColumn('Expenses')
            ->setDateTimeFormat('Y')
            ->addRow(['2004', 1000, 400])
            ->addRow(['2005', 1170, 460])
            ->addRow(['2006', 660, 1120])
            ->addRow(['2007', 1030, 54]);

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

        $finances->addDateColumn('Year')
            ->addNumberColumn('Sales')
            ->addNumberColumn('Expenses')
            ->addNumberColumn('Net Worth')
            ->addRow(['2009-1-1', 1100, 490, 1324])
            ->addRow(['2010-1-1', 1000, 400, 1524])
            ->addRow(['2011-1-1', 1400, 450, 1351])
            ->addRow(['2012-1-1', 1250, 600, 1243])
            ->addRow(['2013-1-1', 1100, 550, 1462]);

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

        $reasons->addStringColumn('Reasons')
            ->addNumberColumn('Percent')
            ->addRow(['Check Reviews', 5])
            ->addRow(['Watch Trailers', 2])
            ->addRow(['See Actors Other Work', 4])
            ->addRow(['Settle Argument', 89]);

        \Lava::DonutChart('IMDB', $reasons, [
            'title' => 'Reasons I visit IMDB',
        ]);
        return view('graficos.donut');
    }
    public function graficoGauge()
    {
        $temps = \Lava::DataTable();

        $temps->addStringColumn('Type')
            ->addNumberColumn('Value')
            ->addRow(['CPU', rand(0, 100)])
            ->addRow(['Case', rand(0, 100)])
            ->addRow(['Graphics', rand(0, 100)]);

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

        $popularity->addStringColumn('Country')
                ->addNumberColumn('Popularity')
                ->addRow(array('Germany', 200))
                ->addRow(array('United States', 300))
                ->addRow(array('Brazil', 400))
                ->addRow(array('Canada', 500))
                ->addRow(array('France', 600))
                ->addRow(array('RU', 700));

        \Lava::GeoChart('Popularity', $popularity);
        return view('graficos.geo');

    }
    public function graficoPizza()
    {
        $reasons = \Lava::DataTable();

        $reasons->addStringColumn('Reasons')
            ->addNumberColumn('Percent')
            ->addRow(['Check Reviews', 5])
            ->addRow(['Watch Trailers', 2])
            ->addRow(['See Actors Other Work', 4])
            ->addRow(['Settle Argument', 89]);

        \Lava::PieChart('IMDB', $reasons, [
            'title' => 'Reasons I visit IMDB',
            'is3D' => true,
            'slices' => [
                ['offset' => 0.2],
                ['offset' => 0.25],
                ['offset' => 0.3],
            ],
        ]);

        return view('graficos.pizza');

    }
    public function graficoLinha()
    {
        $temperatures = \Lava::DataTable();

        $temperatures->addDateColumn('Date')
            ->addNumberColumn('Max Temp')
            ->addNumberColumn('Mean Temp')
            ->addNumberColumn('Min Temp')
            ->addRow(['2014-10-1', 67, 65, 62])
            ->addRow(['2014-10-2', 68, 65, 61])
            ->addRow(['2014-10-3', 68, 62, 55])
            ->addRow(['2014-10-4', 72, 62, 52])
            ->addRow(['2014-10-5', 61, 54, 47])
            ->addRow(['2014-10-6', 70, 58, 45])
            ->addRow(['2014-10-7', 74, 70, 65])
            ->addRow(['2014-10-8', 75, 69, 62])
            ->addRow(['2014-10-9', 69, 63, 56])
            ->addRow(['2014-10-10', 64, 58, 52])
            ->addRow(['2014-10-11', 59, 55, 50])
            ->addRow(['2014-10-12', 65, 56, 46])
            ->addRow(['2014-10-13', 66, 56, 46])
            ->addRow(['2014-10-14', 75, 70, 64])
            ->addRow(['2014-10-15', 76, 72, 68])
            ->addRow(['2014-10-16', 71, 66, 60])
            ->addRow(['2014-10-17', 72, 66, 60])
            ->addRow(['2014-10-18', 63, 62, 62]);

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