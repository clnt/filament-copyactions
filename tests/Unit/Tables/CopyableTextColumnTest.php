<?php

namespace Webbingbrasil\FilamentCopyActions\Tests\Unit\Tables;

use PHPUnit\Framework\Attributes\Test;
use Webbingbrasil\FilamentCopyActions\Tables\CopyableTextColumn;
use Webbingbrasil\FilamentCopyActions\Tests\TestCase;
use Filament\Resources\RelationManagers\RelationManager;

class CopyableTextColumnTest extends TestCase
{
    #[Test]
    public function can_instantiate_copyable_text_column(): void
    {
        $column = CopyableTextColumn::make('name');

        $this->assertInstanceOf(CopyableTextColumn::class, $column);
    }

    #[Test]
    public function has_correct_view(): void
    {
        $column = CopyableTextColumn::make('name');

        $this->assertEquals('filament-copyactions::columns.copyable-text-column', $column->getView());
    }

    #[Test]
    public function has_default_clipboard_icon(): void
    {
        $column = CopyableTextColumn::make('name');

        $this->assertEquals('heroicon-o-clipboard-document', $column->getIcon('test_state'));
    }

    #[Test]
    public function can_set_only_icon_mode(): void
    {
        $column = CopyableTextColumn::make('name');

        $result = $column->onlyIcon();

        $this->assertSame($column, $result);
        $this->assertTrue($column->isOnlyIcon());
    }

    #[Test]
    public function can_disable_only_icon_mode(): void
    {
        $column = CopyableTextColumn::make('name');

        $column->onlyIcon(false);

        $this->assertFalse($column->isOnlyIcon());
    }

    #[Test]
    public function can_use_closure_for_only_icon(): void
    {
        $column = CopyableTextColumn::make('name');

        $column->onlyIcon(fn() => true);

        $this->assertTrue($column->isOnlyIcon());
    }

    #[Test]
    public function can_set_copy_with_description(): void
    {
        $column = CopyableTextColumn::make('name');

        $result = $column->copyWithDescription();

        $this->assertSame($column, $result);
    }

    #[Test]
    public function can_disable_copy_with_description(): void
    {
        $column = CopyableTextColumn::make('name');

        $column->copyWithDescription(false);

        $this->assertInstanceOf(CopyableTextColumn::class, $column);
    }

    #[Test]
    public function can_use_closure_for_copy_with_description(): void
    {
        $column = CopyableTextColumn::make('name');

        $result = $column->copyWithDescription(fn() => true);

        $this->assertSame($column, $result);
    }

    #[Test]
    public function setup_configures_default_behavior(): void
    {
        $column = CopyableTextColumn::make('name');

        $this->assertInstanceOf(CopyableTextColumn::class, $column);
    }
}
