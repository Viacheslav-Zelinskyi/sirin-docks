<?php

namespace Tests\Entity;

use BookStack\Entities\Models\Page;
use Tests\TestCase;

class CommentSettingTest extends TestCase
{
    protected $page;

    protected function setUp(): void
    {
        parent::setUp();
        $this->page = Page::query()->first();
    }

    public function test_comment_disable()
    {
        $this->setSettings(['app-disable-comments' => 'true']);
        $this->asAdmin();

        $resp = $this->asAdmin()->get($this->page->getUrl());
        $this->withHtml($resp)->assertElementNotExists('.comments-list');
    }

    public function test_comment_enable()
    {
        $this->setSettings(['app-disable-comments' => 'false']);
        $this->asAdmin();

        $resp = $this->asAdmin()->get($this->page->getUrl());
        $this->withHtml($resp)->assertElementExists('.comments-list');
    }
}
