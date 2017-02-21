<?php

namespace CashMachine\Test;

use CashMachine\Controllers\NotesTransaction;
use GuzzleHttp\Client;

use Mockery as m;
use PHPUnit_Framework_TestCase;

class CashMachineTest extends PHPUnit_Framework_Testcase
{
    private $notesTransaction;
    protected $client;

    public function setUp()
    {
        $this->notesTransaction = new NotesTransaction();
        $this->client = new Client([
            'base_uri' => 'http://cash-machine.dev/'
        ]);
    }

    public function testApplicationRun()
    {
        $response = $this->client->get('/');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testWithdrawEmptyEntry()
    {
        $expectedCash = $this->notesTransaction->get();

        $this->assertEquals($expectedCash['notes'], []);
    }

    /**
     * @expectedException CashMachine\Exceptions\NoteUnavailableException
     */
    public function testInvalidWithdrawEntry()
    {
        $this->notesTransaction->get(125.00);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNoteUnavailable()
    {
        $this->notesTransaction->get(-130.00);
    }

    public function testMinmumCashWithdraw()
    {
        $expectedCash = $this->notesTransaction->get(30.00);
        $this->assertEquals($expectedCash['notes'], [20, 10]);

        $expectedCash = $this->notesTransaction->get(80.00);
        $this->assertEquals($expectedCash['notes'], [50, 20, 10]);

        $expectedCash = $this->notesTransaction->get(380.00);
        $this->assertEquals($expectedCash['notes'], [100, 100, 100, 50, 20, 10]);
    }

}
