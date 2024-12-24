<?php

class RandomNumberNet {
    private array $net = [];

    private array $rowSums;

    private array $colSums;

    private int $maxNumberSize;

    public function __construct(
        private readonly int $width = 5,
        private readonly int $height = 7,
        private readonly int $ceil = 1000
    )
    {
        $this->maxNumberSize = strlen((string)$this->ceil);
    }

    public function generate(): void {
        for ($i = 1; $i <= $this->height; $i++) {
            $this->prepareNetRow($i);

            $this->printRow($this->net[$i]);

            $this->rowSums[$i] = array_sum($this->net[$i]);

            echo "Сумма чисел в строке: " . $this->rowSums[$i] . PHP_EOL;
        }

        foreach ($this->net as $row) {
            foreach ($row as $key => $number) {
                isset($this->colSums[$key]) ? $this->colSums[$key] += $number : $this->colSums[$key] = $number;
            }
        }

        echo '===========================' . PHP_EOL;
        echo "Суммы чисел по столбцам: ";
        $this->printRow($this->colSums);
    }

    private function prepareNetRow(int $row): void {
        while (empty($this->net[$row]) || count($this->net[$row]) < $this->width) {
            $number = rand(1, 1000);
            $isNumberUnique = true;

            if(!isset($this->net[$row])) $this->net[$row] = [];
            foreach ($this->net as $netRow) {
                if (in_array($number, $netRow)) {
                    $isNumberUnique = false;
                }
            }

            if ($isNumberUnique) {
                $this->net[$row][] = $number;
            }
        }
    }

    private function printRow(array &$numbers): void
    {
        $row = implode(' ', array_map(fn($n) => str_pad($n, $this->maxNumberSize, ' ', STR_PAD_LEFT), $numbers)) . PHP_EOL;

        echo  $row;
    }
}

$net = new RandomNumberNet();
$net->generate();
