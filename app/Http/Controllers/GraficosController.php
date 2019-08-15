<?php

namespace App\Http\Controllers;

class GraficosController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function graficoArea()
    {

        $population = \Lava::DataTable();

        $population->addDateColumn('Ano')
            ->addNumberColumn('Número de pessoas')
            ->addRow(['2006', 623452])
            ->addRow(['2007', 685034])
            ->addRow(['2008', 716845])
            ->addRow(['2009', 757254])
            ->addRow(['2010', 778034])
            ->addRow(['2011', 792353])
            ->addRow(['2012', 839657])
            ->addRow(['2013', 842367])
            ->addRow(['2014', 873490]);

        \Lava::AreaChart('Populacao', $population, [
            'title' => 'Tamanho da População',
            'legend' => [
                'position' => 'in',
            ],
        ]);
        return view('graficos.area');
    }
}