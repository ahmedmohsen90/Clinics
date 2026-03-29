<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class DebtsExport implements FromCollection, WithColumnWidths, WithBatchInserts, WithChunkReading
{
    public $object;

    public function __construct($object)
    {
        $this->object = $object;
    }

    public function collection()
    {
        $data[] = [
            'name' => trans("admin.Name"),
            'amount' => trans("admin.Amount"),
            'status' => trans("admin.Status"),
            'description' => trans("admin.Description"),
            'created_at' => trans("admin.Created At"),
        ];
        foreach ($this->object as $debt) {
            $data[] = [
                "name" => $debt->debtable->name,
                "amount" => number_format($debt->amount,2),
                "status" => $debt->operation == "collected"?trans("admin.Collected"):trans("admin.Entitlements"),
                "description" => $debt->description,
                "created_at" => $debt->created_at,
            ];
        }

        return collect($data);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 30,
            'C' => 30,
            'D' => 30,
            'E' => 30,
            'F' => 30,
        ];
    }
}
