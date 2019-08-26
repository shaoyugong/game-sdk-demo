<?php
namespace Game\Sdk\Service;

use Game\Sdk\RpcService;

return new class extends RpcService {

    /**
     * @param $id
     * @param $data
     * @param $accessory
     * @return array
     */
    public function add($id, $data, $accessory)
    {
        return ['status' => true, 'message' => $id];
    }

    /**
     * @param $id
     * @param $data
     * @param $accessory
     * @return array
     */
    public function edit($id, $data, $accessory)
    {
        return ['status' => true, 'message' => $id];
    }

    /**
     * @param $id
     * @param $data
     * @param $accessory
     * @return array
     */
    public function delete($id, $data, $accessory) {
        return ['status' => true, 'message' => $id];
    }
};