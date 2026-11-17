<?php

namespace Tests\Feature;

use App\Services\ModuleManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModuleToggleTest extends TestCase
{
    use RefreshDatabase;

    public function test_module_manager_reads_config_defaults(): void
    {
        $modules = app(ModuleManager::class)->all();

        $this->assertTrue($modules->contains(fn (array $m) => ($m['key'] ?? null) === 'overtime_rules'));
        $this->assertTrue(app(ModuleManager::class)->enabled('overtime_rules'));
    }

    public function test_home_page_renders_modules(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('PayComply');
    }
}
