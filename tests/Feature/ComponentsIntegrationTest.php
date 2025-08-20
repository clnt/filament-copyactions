<?php

namespace Webbingbrasil\FilamentCopyActions\Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Webbingbrasil\FilamentCopyActions\Forms\Actions\CopyAction as FormCopyAction;
use Webbingbrasil\FilamentCopyActions\Pages\Actions\CopyAction as PageCopyAction;
use Webbingbrasil\FilamentCopyActions\Tables\Actions\CopyAction as TableCopyAction;
use Webbingbrasil\FilamentCopyActions\Tables\CopyableTextColumn;
use Webbingbrasil\FilamentCopyActions\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;

class ComponentsIntegrationTest extends TestCase
{
    #[Test]
    public function form_copy_action_can_be_created_and_configured(): void
    {
        $action = FormCopyAction::make('copy-form-field')
            ->copyable('Form field value');

        $this->assertEquals('copy-form-field', $action->getName());
        $this->assertEquals('Form field value', $action->getCopyable());
    }

    #[Test]
    public function page_copy_action_can_be_created_and_configured(): void
    {
        $action = PageCopyAction::make('copy-page-data')
            ->copyable('Page data value');

        $this->assertEquals('copy-page-data', $action->getName());
        $this->assertEquals('Page data value', $action->getCopyable());
    }

    #[Test]
    public function table_copy_action_can_be_created_and_configured(): void
    {
        $action = TableCopyAction::make('copy-record')
            ->copyable(fn($record) => $record->name ?? 'default');

        $this->assertEquals('copy-record', $action->getName());

        $record = new class extends Model {
            protected $fillable = ['name'];

            public function __construct(array $attributes = [])
            {
                parent::__construct($attributes);
                $this->setAttribute('name', 'Test Record');
            }
        };

        $action->record($record);

        $result = $action->getCopyable();
        $this->assertEquals('Test Record', $result);
    }

    #[Test]
    public function copyable_text_column_integrates_with_table(): void
    {
        $column = CopyableTextColumn::make('email')
            ->onlyIcon()
            ->copyWithDescription();

        $this->assertInstanceOf(CopyableTextColumn::class, $column);
        $this->assertEquals('email', $column->getName());
    }

    #[Test]
    public function all_copy_actions_use_same_trait_methods(): void
    {
        $formAction = FormCopyAction::make('test');
        $pageAction = PageCopyAction::make('test');
        $tableAction = TableCopyAction::make('test');

        $this->assertTrue(method_exists($formAction, 'copyable'));
        $this->assertTrue(method_exists($formAction, 'getCopyable'));

        $this->assertTrue(method_exists($pageAction, 'copyable'));
        $this->assertTrue(method_exists($pageAction, 'getCopyable'));

        $this->assertTrue(method_exists($tableAction, 'copyable'));
        $this->assertTrue(method_exists($tableAction, 'getCopyable'));
    }

    #[Test]
    public function all_copy_actions_have_consistent_default_names(): void
    {
        $this->assertEquals('copy', FormCopyAction::getDefaultName());
        $this->assertEquals('copy', PageCopyAction::getDefaultName());
        $this->assertEquals('copy', TableCopyAction::getDefaultName());
    }
}
