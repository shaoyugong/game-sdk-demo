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
        return ['status' => true, 'message' => 'testteststestsetset'];
    }

    /**
     *
     */
    public function edit($id)
    {
        return 'resend mail:' . $id;
    }

    /**
     *
     */
    public function delete($id) {

    }
};