<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index(Request $request)
    {
        // initializes session, if needed
        // display scan app:
        // - scan QR codes:
        //   - if QR bill: display bill info
        //   - if register scanner URI: goto URI
        //   - otherwise: display message of unknown data
        // - display QR code to register new scanner
        // - calls /listen
        //   - displays a message when a new scanner has registered
        //   - displays billing information when a scan was received
    }

    public function logout(Request $request)
    {
        // destroy session
        // redirect to index
    }

    public function registerScanner()
    {
        // register new device
        // redirect to remoteScan
    }

    public function remoteScan()
    {
        // display simple scanner that posts data on scan success, if it is a QR bill
    }

    public function postScan()
    {
        // store scan to session
    }

    public function listen()
    {
        // long poll for new scans and devices
    }
}
