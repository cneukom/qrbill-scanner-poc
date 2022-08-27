<?php

namespace Tests\Feature;

use App\Models\Device;
use App\Models\RemoteScan;
use App\Models\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppRoutesTest extends TestCase
{
    use RefreshDatabase;

    private function requestSession(): Session
    {
        $response = $this->get(route('index'));

        $response->assertStatus(200);
        $session = Session::query()->first();
        $response->assertSessionHas('sessionId', $session->id);
        $response->assertViewHas('token', $session->token);
        return $session;
    }

    private function registerScanner(string $token): Device
    {
        $response = $this->get(route('registerScanner', $token));

        $response->assertRedirect();
        $device = Device::query()->first();
        $response->assertSessionHas('deviceId', $device->id);
        return $device;
    }

    private function postScan($scanData = ['message' => 'Hello there!'])
    {
        $response = $this->post(route('scans'), ['content' => $scanData]);

        $response->assertOk();
    }

    public function testIndexRouteIsRoot()
    {
        $this->assertEquals('/', route('index', [], false));
    }

    public function testIndexRoute()
    {
        $this->requestSession();
    }

    public function testLogout()
    {
        $this->requestSession();

        $response = $this->post(route('logout'));

        $response->assertRedirect();
        $this->assertDatabaseCount(Session::class, 0);
    }

    public function testListen()
    {
        $this->requestSession();

        $response = $this->get(route('listen'));

        $response->assertOk();
        $response->assertExactJson([]);
    }

    public function testRegisterScanner()
    {
        $session = $this->requestSession();
        $this->flushSession();

        $this->registerScanner($session->token);
    }

    public function testRegisterScannerAndListen()
    {
        $session = $this->requestSession();
        $this->flushSession();
        $this->registerScanner($session->token);
        $this->flushSession();

        $this->session(['sessionId' => $session->id]);
        $response = $this->get(route('listen'));

        $response->assertOk();
        $response->assertJson([
            'type' => 'device',
            'data' => [],
        ]);
    }

    public function testScan()
    {
        $session = $this->requestSession();
        $this->flushSession();
        $device = $this->registerScanner($session->token);

        $response = $this->get(route('scan'));

        $response->assertOk();
        $response->assertSessionHas('deviceId', $device->id);
    }

    public function testScans()
    {
        $session = $this->requestSession();
        $this->flushSession();
        $this->registerScanner($session->token);

        $this->postScan();

        $this->assertDatabaseHas(RemoteScan::class, array_merge(['session_id' => $session->id]));
    }

    public function testScanAndListen()
    {
        $session = $this->requestSession();
        $this->flushSession();
        $this->registerScanner($session->token);
        $this->get(route('listen')); // pop device notification from queue
        $scanData = ['data' => 'test'];
        $this->postScan($scanData);

        $this->session(['sessionId' => $session->id]);
        $response = $this->get(route('listen'));

        $response->assertOk();
        $response->assertJson([
            'type' => 'scan',
            'data' => [
                'content' => $scanData,
            ],
        ]);
    }
}
