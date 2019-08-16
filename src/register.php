<?php
/**
 * Created by PhpStorm.
 * User: gongshaoyu
 * Date: 2019/7/8
 * Time: 下午12:08
 */

namespace Game\Sdk;

use XDApp\ServiceReg\Service;

class Register
{
    const EVNIRONMENT_LOCAL   = 'local';
    const EVNIRONMENT_DEV     = 'dev';
    const EVNIRONMENT_PRODUCE = 'produce';

    public $appName;
    public $serviceName;
    public $key;
    public $ip;
    public $port;

    public $environment;

    protected $service;

    /**
     * Register constructor.
     */
    private function __construct() {}

    /**
     * 初始化服务注册
     * @param array $config
     * @param string $env
     * @return bool|static
     */
    static public function instance($config, $env = '')
    {
        try {
            if (!$config['app']) {
                throw new \Exception('请设置ip地址');
            }

            if (!$config['service']) {
                throw new \Exception('请设置ip地址');
            }

            if (!$config['key']) {
                throw new \Exception('请设置ip地址');
            }

            switch ($env) {
                case self::EVNIRONMENT_DEV:
                    $server = $config['webServer']['dev'];
                    break;
                case self::EVNIRONMENT_LOCAL:
                    $server = $config['webServer']['local'];
                    break;
                default:
                    $server = $config['webServer']['default'];
                    break;
            }

            if (!$server['ip']) {
                throw new \Exception('请设置ip地址');
            }

            if (!$server['port']) {
                throw new \Exception('请设置ip端口');
            }

            $service = new self();
            $service->appName     = $config['app'];
            $service->serviceName = $config['service'];
            $service->key         = $config['key'];
            $service->ip          = $server['ip'];
            $service->port        = $server['port'];
            $service->environment = $env;

            return $service;
        } catch (\Exception $exception) {
            Service::warn($exception->getMessage());
            return false;
        }
    }

    /**
     * 链接
     */
    public function connnect()
    {
        $service = Service::factory($this->appName, $this->serviceName, $this->key);
        $service->addServiceByDir(BASE_PATH . 'src/service');

        switch ($this->environment) {
            case self::EVNIRONMENT_DEV:
                $service->connectToDev();
                break;
            case self::EVNIRONMENT_LOCAL:
                $service->connectToLocalDev($this->ip, $this->port);
                break;
            default:
                $service->connectToProduce();
                break;
        }

        $service->info("注册服务：" . $this->ip . ':' . $this->port);
        $this->service = $service;
    }
}