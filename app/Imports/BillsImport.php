<?php

namespace App\Imports;

use App\Bill;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class BillsImport implements ToModel, WithBatchInserts, WithChunkReading, ShouldQueue
{
    public function model(array $row)
    {
        return new Bill([
            'name' => $row[0],
            'lastname' => $row[1],
            'document' => $row[2],
            'phone' => $row[3],
            'email' => $row[4],
            'address' => $row[5],
            'city' => $row[6],
            'store' => $row[7],
            'article' => $row[8],
            'quantity' => $row[9],
            'price' => $row[10],
            'tax' => $row[11],
            'total' => $row[12],
            
        ]);
    }

    // Numero de datos por archivo a importar
    public function batchSize(): int
    {
        return 1000;
    }

    // Cantidad de datos por archivo en cola
    public function chunkSize(): int
    {
        return 55000;
    }
}