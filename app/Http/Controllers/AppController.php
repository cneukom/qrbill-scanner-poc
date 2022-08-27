<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\RemoteScan;
use App\Models\Session;
use Illuminate\Contracts\Session\Session as SessionStore;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AppController extends Controller
{
    private function initializeSession(SessionStore $sessionStore): Session
    {
        if ($sessionStore->has('sessionId')) {
            $session = Session::find($sessionStore->get('sessionId'));
            if ($session) {
                return $session;
            }
        }

        $session = Session::create([
            'token' => \Str::random(48),
        ]);
        $sessionStore->put('sessionId', $session->id);
        return $session;
    }

    public function index(Request $request)
    {
        $store   = $request->session();
        $session = $this->initializeSession($store);

        return view('index', [
            'token' => $session->token,
        ]);
    }

    public function logout(Request $request)
    {
        $session = $this->initializeSession($request->session());
        $request->session()->forget('sessionId');
        $session->delete();
        return redirect(route('index'));
    }

    public function registerScanner(Request $request, $token)
    {
        $session = Session::whereToken($token)->firstOrFail();

        $device = Device::create([
            'session_id' => $session->id,
        ]);
        $request->session()->put('deviceId', $device->id);

        return redirect(route('scan'));
    }

    private function resolveDevice(SessionStore $sessionStore): Device
    {
        if (!$sessionStore->has('deviceId')) {
            throw new AccessDeniedHttpException();
        }

        $device = Device::find($sessionStore->get('deviceId'));
        if (!$device) {
            throw new AccessDeniedHttpException();
        }
        return $device;
    }

    public function remoteScan(Request $request)
    {
        $device = $this->resolveDevice($request->session());

        // display simple scanner that posts data on scan success, if it is a QR bill
        return view('remoteScan', [
            'device' => $device,
        ]);
    }

    public function postScan(Request $request)
    {
        $device = $this->resolveDevice($request->session());

        RemoteScan::create([
            'content'    => json_encode($request->post('content')),
            'session_id' => $device->session_id,
        ]);

        return (object) [];
    }

    public function listen(Request $request)
    {
        $store = $request->session();
        if (!$store->has('sessionId')) {
            throw new AccessDeniedHttpException();
        }

        $sessionId = $store->get('sessionId');
        $attempts  = config('app.poll.attempts');
        $breakMs   = config('app.poll.break_ms');
        for ($attempt = 0; $attempt < $attempts; ++$attempt) {
            $scan = RemoteScan::unseen()->where('session_id', $sessionId)->first();
            if ($scan) {
                $scan->update(['seen_at' => now()]);
                return [
                    'type' => 'scan',
                    'data' => [
                        'created_at' => $scan->created_at,
                        'content'    => json_decode($scan->content),
                    ],
                ];
            }

            $device = Device::unseen()->where('session_id', $sessionId)->first();
            if ($device) {
                $device->update(['seen_at' => now()]);
                return [
                    'type' => 'device',
                    'data' => $device->only(['created_at']),
                ];
            }

            usleep(1000 * $breakMs);
        }
        return (object) [];
    }
}
