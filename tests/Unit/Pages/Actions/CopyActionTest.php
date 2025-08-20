<?php

namespace Webbingbrasil\FilamentCopyActions\Tests\Unit\Pages\Actions;

use PHPUnit\Framework\Attributes\Test;
use Webbingbrasil\FilamentCopyActions\Pages\Actions\CopyAction;
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
    public function can_set_and_get_copyable_value(): void
    {
        $action = CopyAction::make('copy');
        $action->copyable('test value');

        $result = $action->getCopyable();

        $this->assertEquals('test value', $result);
    }

    #[Test]
    public function inherits_default_name_from_trait(): void
    {
        $this->assertEquals('copy', CopyAction::getDefaultName());
    }

    #[Test]
    public function can_use_closure_for_copyable(): void
    {
        $action = CopyAction::make('copy');
        $action->copyable(fn() => 'dynamic page value');

        $result = $action->getCopyable();

        $this->assertEquals('dynamic page value', $result);
    }
}
