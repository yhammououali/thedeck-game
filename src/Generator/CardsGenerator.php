<?php

namespace App\Generator;

final class CardsGenerator
{
    private const VALUES = [2, 3, 4, 5, 6, 7, 8, 9, 10, 'Valet', 'Dame', 'Roi', 'As'];
    private const COLORS = ['Carreau', 'Coeur', 'Pic', 'Trefle'];
    private const CARDS_NUMBER = 10;

    public function generate(): array
    {
        $generatedCards = [];

        $this->mixArray(self::VALUES);
        $this->mixArray(self::COLORS);

        for ($i = 0; $i < self::CARDS_NUMBER; $i++) {
            $randomColor = $this->getRandomColor();
            $randomValue = $this->getRandomValue();

            $generatedCards[] = [
                'color' => $randomColor,
                'value' => $randomValue,
                'cardPath' => $this->getCardFilePath($randomColor, $randomValue),
            ];
        }

        return $generatedCards;
    }

    public function sortCardsByColorsAndValues(array $cards): array
    {
        usort($cards, static function($a, $b) {
            return $a['value'] <=> $b['value'] ?: $a['color'] <=> $b['color'];
        });

        return $cards;
    }

    private function getRandomColor(): string
    {
        return self::COLORS[random_int(0, count(self::COLORS) -1)];
    }

    private function getRandomValue(): int|string
    {
        return self::VALUES[random_int(0, count(self::VALUES) -1)];
    }

    private function getCardFilePath(string $randomColor, int|string $randomValue): string
    {
        return sprintf(
            '%s/%s-%s',
            strtolower($randomColor),
            is_int($randomValue) ? $randomValue : $randomValue[0],
            $randomColor[0]
        );
    }

    private function mixArray(array $elements): void
    {
        shuffle($elements);
    }
}
