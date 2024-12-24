<?php

class NumberLadder {
    public function __construct(private readonly int $ceil = 100, private readonly string $space = '*')
    {
        //
    }

    public function generate(): void
    {
        $currentRowNumber = 1;

        $width = strlen((string)$this->ceil);

        $numbers = [];

        for ($i = 1; $i <= $this->ceil; $i++) {
            if (count($numbers) >= $currentRowNumber) {
                $this->printRow($numbers, $width, $currentRowNumber);

                $currentRowNumber ++;

                $numbers = [$i];
            } else {
                $numbers[] = $i;
            }
        }

        if (!empty($numbers)) {
            while (count($numbers) < $currentRowNumber) {
                $numbers[] = $this->space;
            }
            $this->printRow($numbers, $width, $currentRowNumber);
        }
    }

    private function printRow(array &$numbers, int $width): void
    {
        $row = implode(' ', array_map(fn($n) => str_pad($n, $width, ' ', STR_PAD_LEFT), $numbers)) . PHP_EOL;

        echo  $row;
    }
}

$ladder = new NumberLadder();
$ladder->generate();
