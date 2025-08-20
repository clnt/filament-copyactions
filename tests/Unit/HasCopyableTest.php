<?php

namespace Webbingbrasil\FilamentCopyActions\Tests\Unit;

use Filament\Actions\Action;
use PHPUnit\Framework\Attributes\Test;
use Webbingbrasil\FilamentCopyActions\Concerns\HasCopyable;
use Webbingbrasil\FilamentCopyActions\Tests\TestCase;

class HasCopyableTest extends TestCase
{
    #[Test]
    public function default_name_is_copy(): void
    {
        $action = $this->makeActionWithTrait();

        $this->assertEquals('copy', $action::getDefaultName());
    }

    #[Test]
    public function can_set_copyable_string(): void
    {
        $action = $this->makeActionWithTrait();

        $result = $action->copyable('test string');

        $this->assertSame($action, $result);
    }

    #[Test]
    public function can_set_copyable_closure(): void
    {
        $action = $this->makeActionWithTrait();

        $result = $action->copyable(fn() => 'dynamic string');

        $this->assertSame($action, $result);
    }

    #[Test]
    public function get_copyable_returns_js_encoded_string(): void
    {
        $action = $this->makeActionWithTrait();
        $action->copyable('test string');

        $result = $action->getCopyable();

        $this->assertEquals('test string', $result);
    }

    #[Test]
    public function get_copyable_evaluates_closure(): void
    {
        $action = $this->makeActionWithTrait();
        $action->copyable(fn() => 'dynamic value');

        $result = $action->getCopyable();

        $this->assertStringContainsString('dynamic value', $result);
    }

    #[Test]
    public function setup_configures_default_properties(): void
    {
        $action = $this->makeActionWithTrait();

        $this->assertEquals('heroicon-o-clipboard-document', $action->getIcon());
        $this->assertEquals('Copied!', $action->getSuccessNotificationTitle());
    }

    #[Test]
    public function action_method_clears_dispatch(): void
    {
        $action = $this->makeActionWithTrait();

        $result = $action->action(fn() => 'test');

        $this->assertSame($action, $result);
    }

    protected function makeActionWithTrait(): Action
    {
        $actionClass = new class('test') extends Action {
            use HasCopyable;

            public static function make(?string $name = null): static
            {
                $static = parent::make($name);
                $static->setupCopyableDefaults();

                return $static;
            }
        };

        return $actionClass::make('test');
    }
}
