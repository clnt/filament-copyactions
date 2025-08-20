<?php

namespace Webbingbrasil\FilamentCopyActions\Tests\Unit;

use Exception;
use PHPUnit\Framework\Attributes\Test;
use Webbingbrasil\FilamentCopyActions\FilamentCopyActionsProvider;
use Webbingbrasil\FilamentCopyActions\Tests\TestCase;

class FilamentCopyActionsProviderTest extends TestCase
{
    #[Test]
    public function views_are_registered(): void
    {
        $viewFinder = view()->getFinder();
        $paths = $viewFinder->getPaths();

        $this->assertNotEmpty($paths);
        $this->assertTrue(view()->exists('filament-copyactions::columns.copyable-text-column'));
    }
}
