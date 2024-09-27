<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProxyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $client = new Client();
        
        $targetUrl = 'http://localhost/mukul/chandigarhonline/' . $request->getRequestUri(); // Replace with your API endpoint

        $response = $client->request(
            $request->method(),
            $targetUrl,
            [
                'headers' => $request->headers->all(),
                'body' => $request->getContent(),
            ]
        );

        return response($response->getBody()->getContents(), $response->getStatusCode())
            ->withHeaders($response->getHeaders());
    }
}
