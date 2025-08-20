<?php

namespace Webbingbrasil\FilamentCopyActions\Tests\Unit\Forms\Actions;

use PHPUnit\Framework\Attributes\Test;
use Webbingbrasil\FilamentCopyActions\Forms\Actions\CopyAction;
use Webbingbrasil\FilamentCopyActions\Tests\TestCase;

class CopyActionTest extends TestCase
{
    #[Test]
    public function can_instantiate_copy_action(): void
    {
        $action = CopyAction::make('copy');

        $this->assertInstanceOf(CopyAction::class, $action);
    }

    #[Test]
    public function uses_has_copyable_trait(): void
    {
        $action = CopyAction::make('copy');

        $this->assertTrue(method_exists($action, 'copyable'));
        $this->assertTrue(method_exists($action, 'getCopyable'));
    }

    #[Test]
    public function get_copyable_returns_component_state_path_when_no_copyable_set(): void
    {
        $action = CopyAction::make('copy');

        $result = $action->getCopyable();

        $this->assertEquals('', $result);
    }

    #[Test]
    public function get_copyable_uses_custom_copyable_when_set(): void
    {
        $action = CopyAction::make('copy');
        $action->copyable('custom value');

        $result = $action->getCopyable();

        $this->assertEquals('custom value', $result);
    }

    #[Test]
    public function inherits_default_name_from_trait(): void
    {
        $this->assertEquals('copy', CopyAction::getDefaultName());
    }
}
