<?php

namespace Tests\Unit\Model;

use App\Models\Contact;
use PHPUnit\Framework\TestCase;
use Tests\Unit\ModelTestCase;

class ContactTest extends ModelTestCase
{
    protected $contact;

    public function initModel()
    {
        return new Contact();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'first_name',
            'last_name',
            'email',
            'title',
            'content',
        ];
        $this->runConfigurationAssertions(
            $this->model,
            [
                'table' => 'contacts',
                'fillable' => $fillable,
            ],
        );
    }
}
