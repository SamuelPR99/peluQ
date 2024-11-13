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
            // Simplificar la dirección eliminando detalles específicos
            $simplifiedAddress = $this->simplifyAddress($address);

            $response = $client->get('https://nominatim.openstreetmap.org/search', [
                'query' => [
                    'q' => $simplifiedAddress,
                    'format' => 'json',
                    'limit' => 1
                ],
                'headers' => [
                    'User-Agent' => 'peluq/1.0 (spenareyes@gmail.com)'
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            Log::info('Respuesta de Nominatim para la dirección ' . $simplifiedAddress . ': ' . json_encode($data));

            if (!empty($data)) {
                return $data[0]['lat'] . ',' . $data[0]['lon'];
            } else {
                Log::warning('No se encontraron coordenadas para la dirección: ' . $simplifiedAddress);
            }
        } catch (\Exception $e) {
            Log::error('Error al obtener coordenadas para la dirección: ' . $simplifiedAddress . ' - ' . $e->getMessage());
        }

        return '0.000000,0.000000';
    }

    private function simplifyAddress($address)
    {
        // Implementar lógica para simplificar la dirección
        // Por ejemplo, eliminar números de calle y detalles específicos
        return preg_replace('/\d+/', '', $address);
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
