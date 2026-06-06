<?php

namespace App\Console\Commands;

use App\Models\Occupation;
use App\Models\OccupationSkill;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportSkills extends Command
{
    protected $signature = 'skills:import {path : Path to the .xlsx file}';

    protected $description = 'Import UK SSC occupations and core-skill importance (wide format) into MySQL';

    private string $idColumn    = 'SUG ID';
    private string $titleColumn = 'SUG Title';
    private int $scaleMax = 5;

    public function handle(): int
    {
        $path = $this->argument('path');

        if (! file_exists($path)) {
            $this->error("File not found: {$path}");
            return self::FAILURE;
        }

        $this->info('Reading spreadsheet...');
        $sheet = IOFactory::load($path)->getActiveSheet();
        $rows  = $sheet->toArray(null, true, true, false);

        $headers = array_map(fn ($h) => trim((string) $h), array_shift($rows));

        if (! in_array($this->idColumn, $headers, true) || ! in_array($this->titleColumn, $headers, true)) {
            $this->error("Could not find '{$this->idColumn}' and '{$this->titleColumn}'. Headers: " . implode(' | ', $headers));
            return self::FAILURE;
        }

        $skillColumns = array_values(array_filter(
            $headers,
            fn ($h) => $h !== '' && $h !== $this->idColumn && $h !== $this->titleColumn
        ));

        $this->info('Found ' . count($skillColumns) . ' skill columns: ' . implode(', ', $skillColumns));

        $occupations = 0;
        $links       = 0;
        $skipped     = 0;

        foreach ($rows as $row) {
            $record = array_combine($headers, $row);

            $code  = trim((string) ($record[$this->idColumn] ?? ''));
            $title = trim((string) ($record[$this->titleColumn] ?? ''));

            if ($title === '') {
                $skipped++;
                continue;
            }

            $occupation = $code !== ''
                ? Occupation::updateOrCreate(['code' => $code], ['title' => $title])
                : Occupation::firstOrCreate(['title' => $title]);

            $occupations++;

            foreach ($skillColumns as $col) {
                $raw = $record[$col] ?? null;

                if ($raw === null || $raw === '') {
                    continue;
                }

                $importance = (int) round(((float) $raw / $this->scaleMax) * 100);

                OccupationSkill::updateOrCreate(
                    [
                        'occupation_id'   => $occupation->id,
                        'core_skill_slug' => Str::slug($col),
                    ],
                    ['importance' => $importance]
                );

                $links++;
            }
        }

        $this->info("Done. {$occupations} occupations, {$links} skill links imported, {$skipped} rows skipped.");
        return self::SUCCESS;
    }
}
