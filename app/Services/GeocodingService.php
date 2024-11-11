<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class GeocodingService
{
    public function getCoordinatesFromAddress($address)
    {
        $client = new Client();
        try {
            $response = $client->get('https://nominatim.openstreetmap.org/search', [
                'query' => [
                    'q' => $address,
                    'format' => 'json',
                    'limit' => 1
                ],
                'headers' => [
                    'User-Agent' => 'peluq/1.0 (spenareyes@gmail.com)'
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            // Agregar registro para ver la respuesta de la API
            Log::info('Respuesta de Nominatim para la dirección ' . $address . ': ' . json_encode($data));

            if (!empty($data)) {
                return $data[0]['lat'] . ',' . $data[0]['lon'];
            } else {
                Log::warning('No se encontraron coordenadas para la dirección: ' . $address);
            }
        } catch (\Exception $e) {
            Log::error('Error al obtener coordenadas para la dirección: ' . $address . ' - ' . $e->getMessage());
        }

        // Valor predeterminado si no se pueden obtener las coordenadas
        return '0.000000,0.000000';
    }

    public function getAddressFromCoordinates($lat, $lng)
    {
        $client = new Client();
        try {
            $response = $client->get('https://nominatim.openstreetmap.org/reverse', [
                'query' => [
                    'lat' => $lat,
                    'lon' => $lng,
                    'format' => 'json'
                ],
                'headers' => [
                    'User-Agent' => 'peluq/1.0 (spenareyes@gmail.com)'
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            Log::info('Respuesta de Nominatim para las coordenadas ' . $lat . ',' . $lng . ': ' . json_encode($data));

            if (!empty($data)) {
                return [
                    'address' => $data['display_name'],
                    'postcode' => $data['address']['postcode'] ?? ''
                ];
            } else {
                Log::warning('No se encontró dirección para las coordenadas: ' . $lat . ',' . $lng);
            }
        } catch (\Exception $e) {
            Log::error('Error al obtener dirección para las coordenadas: ' . $lat . ',' . $lng . ' - ' . $e->getMessage());
        }

        return [
            'address' => '',
            'postcode' => ''
        ];
    }
}
