<?php

class VipReseller 
{
    private $url, $key, $sign, $id;

    public function __construct()
    {
        $this->url = 'https://vip-reseller.co.id';

        $this->key = ''; // Api Key
        $this->sign = ''; // Signature
        $this->id = ''; // Id user
    }

    public function request(string $url, array $data = [])
    {
        $data = array_merge($data, [
            'key' => $this->key,
            'sign' => $this->sign,
        ]);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function profileCheck()
    {
        $act = $this->request('/api/profile');
        if (!isset(json_decode($act, true)['result'])) {
            $response = [
                'status' => false,
                'message' => 'Gagal mengambil data!',
                'data' => [],
            ];
            return $response;
        }
        if (json_decode($act, true)['result'] == false) {
            $response = [
                'status' => false,
                'message' => json_decode($act, true)['message'],
                'data' => [],
            ];
            return $response;
        }
        $response = [
            'status' => true,
            'message' => 'Success',
            'data' => json_decode($act, true)['data'],
        ];
        return $response;
    }
    public function prepaidOrder(string $code, string $target)
    {
        $data = [
            'type' => 'order',
            'service' => $code,
            'data_no' => $target,
        ];
        $act = $this->request('/api/prepaid', $data);
        if (!isset(json_decode($act, true)['result'])) {
            $response = [
                'status' => false,
                'message' => 'Gagal mengambil data!',
                'data' => [],
            ];
            return $response;
        }
        if (json_decode($act, true)['result'] == false) {
            $response = [
                'status' => false,
                'message' => json_decode($act, true)['message'],
                'data' => [],
            ];
            return $response;
        }
        $response = [
            'status' => true,
            'message' => 'Success',
            'data' => json_decode($act, true)['data'],
        ];
        return $response;
    }
    public function prepaidStatus(string $trxservice)
    {
        $data = [
            'type' => 'status',
            'trxid' => $trxservice,
        ];
        $act = $this->request('/api/prepaid', $data);
        if (!isset(json_decode($act, true)['result'])) {
            $response = [
                'status' => false,
                'message' => 'Gagal mengambil data!',
                'data' => [],
            ];
            return $response;
        }
        if (json_decode($act, true)['result'] == false) {
            $response = [
                'status' => false,
                'message' => json_decode($act, true)['message'],
                'data' => [],
            ];
            return $response;
        }
        $response = [
            'status' => true,
            'message' => 'Success',
            'data' => json_decode($act, true)['data'],
        ];
        return $response;
    }
    public function prepaidService(string $type = null, string $value = null)
    {
        if ($type == null && $value == null) {
            $data = [
                'type' => 'services',
            ];
        } else {
            if ($type != null && $value == null) {
                $response = [
                    'status' => false,
                    'message' => 'Value tidak boleh kosong!',
                    'data' => [],
                ];
                return $response;
            } else if ($type == null && $value != null) {
                $response = [
                    'status' => false,
                    'message' => 'Type tidak boleh kosong!',
                    'data' => [],
                ];
                return $response;
            } else {
                $data = [
                    'type' => 'services',
                    'filter_type' => $type,
                    'filter_value' => $value,
                ];
            }
        }
        $act = $this->request('/api/prepaid', $data);
        if (!isset(json_decode($act, true)['result'])) {
            $response = [
                'status' => false,
                'message' => 'Gagal mengambil data!',
                'data' => [],
            ];
            return $response;
        }
        if (json_decode($act, true)['result'] == false) {
            $response = [
                'status' => false,
                'message' => json_decode($act, true)['message'],
                'data' => [],
            ];
            return $response;
        }
        $response = [
            'status' => true,
            'message' => 'Success',
            'data' => json_decode($act, true)['data'],
        ];
        return $response;
    }
    public function postpaidCheck(string $code, string $target)
    {
        $data = [
            'type' => 'inq-pasca',
            'service' => $code,
            'data_no' => $target,
        ];
        $act = $this->request('/api/postpaid', $data);
        if (!isset(json_decode($act, true)['result'])) {
            $response = [
                'status' => false,
                'message' => 'Gagal mengambil data!',
                'data' => [],
            ];
            return $response;
        }
        if (json_decode($act, true)['result'] == false) {
            $response = [
                'status' => false,
                'message' => json_decode($act, true)['message'],
                'data' => [],
            ];
            return $response;
        }
        $response = [
            'status' => true,
            'message' => 'Success',
            'data' => json_decode($act, true)['data'],
        ];
        return $response;
    }
    public function postpaidOrder(string $code, string $target)
    {
        $data = [
            'type' => 'pay-pasca',
            'service' => $code,
            'data_no' => $target,
        ];
        $act = $this->request('/api/postpaid', $data);
        if (!isset(json_decode($act, true)['result'])) {
            $response = [
                'status' => false,
                'message' => 'Gagal mengambil data!',
                'data' => [],
            ];
            return $response;
        }
        if (json_decode($act, true)['result'] == false) {
            $response = [
                'status' => false,
                'message' => json_decode($act, true)['message'],
                'data' => [],
            ];
            return $response;
        }
        $response = [
            'status' => true,
            'message' => 'Success',
            'data' => json_decode($act, true)['data'],
        ];
        return $response;
    }
    public function postpaidStatus(string $trxservice)
    {
        $data = [
            'type' => 'status',
            'trxid' => $trxservice,
        ];
        $act = $this->request('/api/postpaid', $data);
        if (!isset(json_decode($act, true)['result'])) {
            $response = [
                'status' => false,
                'message' => 'Gagal mengambil data!',
                'data' => [],
            ];
            return $response;
        }
        if (json_decode($act, true)['result'] == false) {
            $response = [
                'status' => false,
                'message' => json_decode($act, true)['message'],
                'data' => [],
            ];
            return $response;
        }
        $response = [
            'status' => true,
            'message' => 'Success',
            'data' => json_decode($act, true)['data'],
        ];
        return $response;
    }
    public function postpaidService(string $type = null, string $value = null)
    {
        if ($type == null && $value == null) {
            $data = [
                'type' => 'services',
            ];
        } else {
            if ($type != null && $value == null) {
                $response = [
                    'status' => false,
                    'message' => 'Value tidak boleh kosong!',
                    'data' => [],
                ];
                return $response;
            } else if ($type == null && $value != null) {
                $response = [
                    'status' => false,
                    'message' => 'Type tidak boleh kosong!',
                    'data' => [],
                ];
                return $response;
            } else {
                $data = [
                    'type' => 'services',
                    'filter_type' => $type,
                    'filter_value' => $value,
                ];
            }
        }
        $act = $this->request('/api/postpaid', $data);
        if (!isset(json_decode($act, true)['result'])) {
            $response = [
                'status' => false,
                'message' => 'Gagal mengambil data!',
                'data' => [],
            ];
            return $response;
        }
        if (json_decode($act, true)['result'] == false) {
            $response = [
                'status' => false,
                'message' => json_decode($act, true)['message'],
                'data' => [],
            ];
            return $response;
        }

        $response = [
            'status' => true,
            'message' => 'Success',
            'data' => json_decode($act, true)['data'],
        ];
        return $response;
    }
    // sosial media
    public function sosmedOrder(string $code, string $target, int $qty)
    {
        $data = [
            'type' => 'order',
            'service' => $code,
            'data' => $target,
            'quantity' => $qty,
        ];
        $act = $this->request('/api/social-media', $data);
        if (!isset(json_decode($act, true)['result'])) {
            $response = [
                'status' => false,
                'message' => 'Gagal mengambil data!',
                'data' => [],
            ];
            return $response;
        }
        if (json_decode($act, true)['result'] == false) {
            $response = [
                'status' => false,
                'message' => json_decode($act, true)['message'],
                'data' => [],
            ];
            return $response;
        }
        $response = [
            'status' => true,
            'message' => 'Success',
            'data' => json_decode($act, true)['data'],
        ];
        return $response;
    }
    public function sosmedStatus(string $trxservice)
    {
        $data = [
            'type' => 'status',
            'trxid' => $trxservice,
        ];
        $act = $this->request('/api/social-media', $data);
        if (!isset(json_decode($act, true)['result'])) {
            $response = [
                'status' => false,
                'message' => 'Gagal mengambil data!',
                'data' => [],
            ];
            return $response;
        }
        if (json_decode($act, true)['result'] == false) {
            $response = [
                'status' => false,
                'message' => json_decode($act, true)['message'],
                'data' => [],
            ];
            return $response;
        }
        $response = [
            'status' => true,
            'message' => 'Success',
            'data' => json_decode($act, true)['data'],
        ];
        return $response;
    }
    public function sosmedService(string $type = null, string $value = null)
    {
        if ($type == null && $value == null) {
            $data = [
                'type' => 'services',
            ];
        } else {
            if ($type != null && $value == null) {
                $response = [
                    'status' => false,
                    'message' => 'Value tidak boleh kosong!',
                    'data' => [],
                ];
                return $response;
            } else if ($type == null && $value != null) {
                $response = [
                    'status' => false,
                    'message' => 'Type tidak boleh kosong!',
                    'data' => [],
                ];
                return $response;
            } else {
                $data = [
                    'type' => 'services',
                    'filter_type' => 'category',
                    'filter_value' => $value,
                ];
            }
        }
        $act = $this->request('/api/social-media', $data);
        if (!isset(json_decode($act, true)['result'])) {
            $response = [
                'status' => false,
                'message' => 'Gagal mengambil data!',
                'data' => [],
            ];
            return $response;
        }
        if (json_decode($act, true)['result'] == false) {
            $response = [
                'status' => false,
                'message' => json_decode($act, true)['message'],
                'data' => [],
            ];
            return $response;
        }

        $response = [
            'status' => true,
            'message' => 'Success',
            'data' => json_decode($act, true)['data'],
        ];
        return $response;
    }

    // game & streaming
    public function gamesOrder(string $code, string $target, string $zone = null)
    {
        if ($zone == null) {
            $data = [
                'type' => 'order',
                'service' => $code,
                'data_no' => $target,
            ];
        } else {
            $data = [
                'type' => 'order',
                'service' => $code,
                'data_no' => $target,
                'data_zone' => $zone,
            ];
        }
        $act = $this->request('/api/game-feature', $data);
        if (!isset(json_decode($act, true)['result'])) {
            $response = [
                'status' => false,
                'message' => 'Gagal mengambil data!',
                'data' => [],
            ];
            return $response;
        }
        if (json_decode($act, true)['result'] == false) {
            $response = [
                'status' => false,
                'message' => json_decode($act, true)['message'],
                'data' => [],
            ];
            return $response;
        }
        $response = [
            'status' => true,
            'message' => 'Success',
            'data' => json_decode($act, true)['data'],
        ];
        return $response;
    }
    public function gamesStatus(string $trxservice)
    {
        $data = [
            'type' => 'status',
            'trxid' => $trxservice,
        ];
        $act = $this->request('/api/game-feature', $data);
        if (!isset(json_decode($act, true)['result'])) {
            $response = [
                'status' => false,
                'message' => 'Gagal mengambil data!',
                'data' => [],
            ];
            return $response;
        }
        if (json_decode($act, true)['result'] == false) {
            $response = [
                'status' => false,
                'message' => json_decode($act, true)['message'],
                'data' => [],
            ];
            return $response;
        }
        $response = [
            'status' => true,
            'message' => 'Success',
            'data' => json_decode($act, true)['data'],
        ];
        return $response;
    }
    public function gamesService(string $type = null, string $value = null)
    {
        if ($type == null && $value == null) {
            $data = [
                'type' => 'services',
            ];
        } else {
            if ($type != null && $value == null) {
                $response = [
                    'status' => false,
                    'message' => 'Value tidak boleh kosong!',
                    'data' => [],
                ];
                return $response;
            } else if ($type == null && $value != null) {
                $response = [
                    'status' => false,
                    'message' => 'Type tidak boleh kosong!',
                    'data' => [],
                ];
                return $response;
            } else {
                $data = [
                    'type' => 'services',
                    'filter_type' => 'game',
                    'filter_value' => $value,
                ];
            }
        }
        $act = $this->request('/api/game-feature', $data);
        if (!isset(json_decode($act, true)['result'])) {
            $response = [
                'status' => false,
                'message' => 'Gagal mengambil data!',
                'data' => [],
            ];
            return $response;
        }
        if (json_decode($act, true)['result'] == false) {
            $response = [
                'status' => false,
                'message' => json_decode($act, true)['message'],
                'data' => [],
            ];
            return $response;
        }

        $response = [
            'status' => true,
            'message' => 'Success',
            'data' => json_decode($act, true)['data'],
        ];
        return $response;
    }
    public function nicknameGame(string $code, string $target, string $zone = null)
    {
        if ($zone == null) {
            $data = [
                'type' => 'get-nickname',
                'code' => $code,
                'target' => $target,
            ];
        } else {
            $data = [
                'type' => 'get-nickname',
                'code' => $code,
                'target' => $target,
                'additional_target' => $zone,
            ];
        }
        $act = $this->request('/api/game-feature', $data);
        if (!isset(json_decode($act, true)['result'])) {
            $response = [
                'status' => false,
                'message' => 'Gagal mengambil data!',
                'data' => [],
            ];
            return $response;
        }
        if (json_decode($act, true)['result'] == false) {
            $response = [
                'status' => false,
                'message' => json_decode($act, true)['message'],
                'data' => [],
            ];
            return $response;
        }
        $response = [
            'status' => true,
            'message' => 'Success',
            'data' => json_decode($act, true)['data'],
        ];
        return $response;
    }
}
