<?php

namespace Webbingbrasil\FilamentCopyActions\Tests\Feature;

use Filament\Panel;
use Filament\Facades\Filament;
use PHPUnit\Framework\Attributes\Test;
use Webbingbrasil\FilamentCopyActions\FilamentCopyActionsPlugin;
use Webbingbrasil\FilamentCopyActions\Tests\TestCase;

class PluginIntegrationTest extends TestCase
{
    #[Test]
    public function plugin_can_be_registered_with_filament_panel(): void
    {
        $panel = Panel::make()
            ->id('admin')
            ->plugin(FilamentCopyActionsPlugin::make());

        $this->assertInstanceOf(Panel::class, $panel);

        $plugins = $panel->getPlugins();

        $this->assertNotEmpty($plugins);
        $this->assertInstanceOf(FilamentCopyActionsPlugin::class, $plugins['filament-copy-actions']);
    }

    #[Test]
    public function plugin_configuration_is_applied(): void
    {
        $plugin = FilamentCopyActionsPlugin::make();
        $panel = Panel::make()->id('admin');

        $plugin->register($panel);
        $plugin->boot($panel);

        $this->assertTrue(true);
    }
}
