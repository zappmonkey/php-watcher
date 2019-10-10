<?php declare(strict_types=1);

namespace seregazhuk\PhpWatcher\Screen;

final class Spinner
{
    private const FRAMES = ['⠏', '⠛', '⠹', '⢸', '⣰', '⣤', '⣆', '⡇'];
    private const COLORS = [
        196,
        196,
        202,
        202,
        208,
        208,
        214,
        214,
        220,
        220,
        226,
        226,
        190,
        190,
        154,
        154,
        118,
        118,
        82,
        82,
        46,
        46,
        47,
        47,
        48,
        48,
        49,
        49,
        50,
        50,
        51,
        51,
        45,
        45,
        39,
        39,
        33,
        33,
        27,
        27,
        56,
        56,
        57,
        57,
        93,
        93,
        129,
        129,
        165,
        165,
        201,
        201,
        200,
        200,
        199,
        199,
        198,
        198,
        197,
        197
    ];

    private $currentFrameIndex = 0;
    private $currentColorIndex = 0;

    public function spin(): void
    {
        $this->output();
        $this->increment();
        $this->hideCursor();
    }

    public function interval(): float
    {
        return 1/10;
    }

    public function erase(): void
    {
        echo "\033[1K";
    }

    private function currentColor(): string
    {
        return '38;5;' . self::COLORS[$this->currentColorIndex]. 'm';
    }

    private function currentFrame(): string
    {
        return self::FRAMES[$this->currentFrameIndex];
    }

    private function output(): void
    {
        echo "\e[{$this->currentColor()}{$this->currentFrame()}\e[0m\r";
    }

    private function hideCursor(): void
    {
        echo "\033[?25l";
    }

    private function increment(): void
    {
        $this->currentFrameIndex ++;
        if ($this->currentFrameIndex === count(self::FRAMES)) {
            $this->currentFrameIndex = 0;
        }

        $this->currentColorIndex ++;
        if ($this->currentColorIndex === count(self::COLORS)) {
            $this->currentColorIndex = 0;
        }
    }
}
