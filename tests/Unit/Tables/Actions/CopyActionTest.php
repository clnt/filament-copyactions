<?php

namespace Webbingbrasil\FilamentCopyActions\Tests\Unit\Tables\Actions;

use PHPUnit\Framework\Attributes\Test;
use Webbingbrasil\FilamentCopyActions\Tables\Actions\CopyAction;
use Webbingbrasil\FilamentCopyActions\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;

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
        $action->copyable('table record value');

        $result = $action->getCopyable();

        $this->assertStringContainsString('table record value', $result);
    }

    #[Test]
    public function inherits_default_name_from_trait(): void
    {
        $this->assertEquals('copy', CopyAction::getDefaultName());
    }

    #[Test]
    public function can_use_closure_with_record_data(): void
    {
        $action = CopyAction::make('copy');
        $action->copyable(fn($record) => "Record ID: {$record->id}");

        $record = new class extends Model {
            protected $fillable = ['id'];

            public function __construct(array $attributes = [])
            {
                parent::__construct($attributes);
                $this->setAttribute('id', 123);
            }
        };

        $action->record($record);

        $result = $action->getCopyable();

        $this->assertEquals('Record ID: 123', $result);
    }
}
