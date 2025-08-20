<?php

namespace Webbingbrasil\FilamentCopyActions\Tests\Unit;

use Filament\Panel;
use PHPUnit\Framework\Attributes\Test;
use Webbingbrasil\FilamentCopyActions\FilamentCopyActionsPlugin;
use Webbingbrasil\FilamentCopyActions\Tests\TestCase;

class FilamentCopyActionsPluginTest extends TestCase
{
    #[Test]
    public function plugin_has_correct_id(): void
    {
        $plugin = FilamentCopyActionsPlugin::make();

        $this->assertEquals('filament-copy-actions', $plugin->getId());
    }

    #[Test]
    public function plugin_registers_with_panel(): void
    {
        $plugin = FilamentCopyActionsPlugin::make();
        $panel = Panel::make()->id('admin');

        $plugin->register($panel);

        $this->assertTrue(true);
    }

    #[Test]
    public function plugin_boots_with_panel(): void
    {
        $plugin = FilamentCopyActionsPlugin::make();
        $panel = Panel::make()->id('admin');

        $plugin->boot($panel);

        $this->assertTrue(true);
    }
}
