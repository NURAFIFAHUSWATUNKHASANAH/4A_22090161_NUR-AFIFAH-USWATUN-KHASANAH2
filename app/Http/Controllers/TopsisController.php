<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Kriteria;

class TopsisController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();

        // Step 1: Create the decision matrix
        $decisionMatrix = [];
        foreach ($alternatifs as $alt) {
            $decisionMatrix[] = [
                'nip' => $alt->nip,
                'nama' => $alt->nama,
                'values' => [$alt->c1, $alt->c2, $alt->c3, $alt->c4, $alt->c5]
            ];
        }

        // Step 2: Normalize the decision matrix
        $normalizedMatrix = $this->normalize($decisionMatrix);

        // Step 3: Create the weighted normalized decision matrix
        $weights = $kriterias->pluck('bobot')->toArray();
        $weightedMatrix = $this->applyWeights($normalizedMatrix, $weights);

        // Step 4: Determine the ideal and negative-ideal solutions
        list($idealSolution, $negativeIdealSolution) = $this->determineIdealSolutions($weightedMatrix, $kriterias);

        // Step 5: Calculate the distances to the ideal and negative-ideal solutions
        $distances = $this->calculateDistances($weightedMatrix, $idealSolution, $negativeIdealSolution);

        // Step 6: Calculate the relative closeness to the ideal solution
        $relativeCloseness = $this->calculateRelativeCloseness($distances);

        // Step 7: Prepare results for view
        $normalizedResults = $this->prepareResults($alternatifs, $normalizedMatrix);
        $weightedResults = $this->prepareResults($alternatifs, $weightedMatrix);
        $rankedResults = $this->prepareRankingResults($alternatifs, $relativeCloseness, $distances);

        // Pass data to the view
        return view('topsis.index', [
            'normalizedResults' => $normalizedResults,
            'weightedResults' => $weightedResults,
            'idealPositive' => $idealSolution,
            'idealNegative' => $negativeIdealSolution,
            'distances' => $rankedResults,
            'rankedResults' => $rankedResults,
        ]);
    }
    
    private function normalize($matrix)
    {
        $transposed = array_map(null, ...array_column($matrix, 'values'));
        $normalized = [];

        foreach ($transposed as $index => $column) {
            $sum = array_reduce($column, fn($carry, $item) => $carry + pow($item, 2), 0);
            $denominator = sqrt($sum);

            foreach ($column as $rowIndex => $value) {
                $normalized[$rowIndex]['values'][$index] = $value / $denominator;
            }
        }

        foreach ($matrix as $index => $row) {
            $normalized[$index]['nip'] = $row['nip'];
            $normalized[$index]['nama'] = $row['nama'];
        }

        return $normalized;
    }

    private function applyWeights($matrix, $weights)
    {
        $weighted = [];

        foreach ($matrix as $index => $row) {
            foreach ($row['values'] as $key => $value) {
                $weighted[$index]['values'][$key] = $value * $weights[$key];
            }
            $weighted[$index]['nip'] = $row['nip'];
            $weighted[$index]['nama'] = $row['nama'];
        }

        return $weighted;
    }

    private function determineIdealSolutions($matrix, $kriterias)
    {
        $transposed = array_map(null, ...array_column($matrix, 'values'));
        $idealSolution = [];
        $negativeIdealSolution = [];

        foreach ($transposed as $index => $column) {
            $criteria = $kriterias[$index];
            if ($criteria->atribut == 'benefit') {
                $idealSolution['values'][$index] = max($column);
                $negativeIdealSolution['values'][$index] = min($column);
            } else { // $criteria->atribut == 'cost'
                $idealSolution['values'][$index] = min($column);
                $negativeIdealSolution['values'][$index] = max($column);
            }
        }

        return [(object) $idealSolution, (object) $negativeIdealSolution];
    }

    private function calculateDistances($matrix, $idealSolution, $negativeIdealSolution)
    {
        $distances = [];

        foreach ($matrix as $index => $row) {
            $positiveDistance = 0;
            $negativeDistance = 0;

            foreach ($row['values'] as $key => $value) {
                $positiveDistance += pow($value - $idealSolution->values[$key], 2);
                $negativeDistance += pow($value - $negativeIdealSolution->values[$key], 2);
            }

            $distances[$index] = [
                'positive' => sqrt($positiveDistance),
                'negative' => sqrt($negativeDistance),
            ];
        }

        return $distances;
    }

    private function calculateRelativeCloseness($distances)
    {
        $relativeCloseness = [];

        foreach ($distances as $distance) {
            $relativeCloseness[] = $distance['negative'] / ($distance['positive'] + $distance['negative']);
        }

        return $relativeCloseness;
    }

    private function prepareResults($alternatifs, $matrix)
    {
        $results = [];
        foreach ($alternatifs as $index => $alt) {
            $results[] = (object) [
                'nip' => $alt->nip,
                'nama' => $alt->nama,
                'c1' => $matrix[$index]['values'][0],
                'c2' => $matrix[$index]['values'][1],
                'c3' => $matrix[$index]['values'][2],
                'c4' => $matrix[$index]['values'][3],
                'c5' => $matrix[$index]['values'][4],
            ];
        }
        return $results;
    }

    private function prepareRankingResults($alternatifs, $relativeCloseness, $distances)
    {
        $results = [];
        foreach ($alternatifs as $index => $alt) {
            $results[] = (object) [
                'nip' => $alt->nip,
                'nama' => $alt->nama,
                'jarak_positif' => $distances[$index]['positive'],
                'jarak_negatif' => $distances[$index]['negative'],
                'nilai_preferensi' => $relativeCloseness[$index],
            ];
        }
        usort($results, function ($a, $b) {
            return $b->nilai_preferensi <=> $a->nilai_preferensi;
        });

        // Assign ranking based on the sorted results
        $ranking = 1;
        foreach ($results as $result) {
            $result->ranking = $ranking;
            $ranking++;
        }

        return $results;
    }

    public function ranking()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();

        // Step 1: Create the decision matrix
        $decisionMatrix = [];
        foreach ($alternatifs as $alt) {
            $decisionMatrix[] = [
                'nip' => $alt->nip,
                'nama' => $alt->nama,
                'values' => [$alt->c1, $alt->c2, $alt->c3, $alt->c4, $alt->c5]
            ];
        }

        // Step 2: Normalize the decision matrix
        $normalizedMatrix = $this->normalize($decisionMatrix);

        // Step 3: Create the weighted normalized decision matrix
        $weights = $kriterias->pluck('bobot')->toArray();
        $weightedMatrix = $this->applyWeights($normalizedMatrix, $weights);

        // Step 4: Determine the ideal and negative-ideal solutions
        list($idealSolution, $negativeIdealSolution) = $this->determineIdealSolutions($weightedMatrix, $kriterias);

        // Step 5: Calculate the distances to the ideal and negative-ideal solutions
        $distances = $this->calculateDistances($weightedMatrix, $idealSolution, $negativeIdealSolution);

        // Step 6: Calculate the relative closeness to the ideal solution
        $relativeCloseness = $this->calculateRelativeCloseness($distances);

        // Step 7: Prepare ranking results
        $rankedResults = $this->prepareRankingResults($alternatifs, $relativeCloseness, $distances);

        // Pass data to the view
        return view('topsis.ranking', [
            'rankedResults' => $rankedResults,
        ]);
    }
}
