<?php
/**
 * Created by PhpStorm.
 * User: gongshaoyu
 * Date: 2019/7/8
 * Time: 下午4:16
 */

namespace Game\Sdk;

use GuzzleHttp\Client;

class HttpService
{
    const METHOD_GET    = "GET";
    const METHOD_POST   = "POST";
    const METHOD_PUT    = "PUT";
    const METHOD_DELETE = "DELETE";

    public $host;
    public $port;
    public $token;
    public $client;

    /**
     *
     */
    static public function instance()
    {
        global $config, $env;

        var_dump($config['gameServer'][$env]);

        $service = new self();
        $service->client = new Client();
        return $service;
    }



    /**
     * 函数验证
     * @param $function
     * @param $args
     * @throws \Exception
     * @throws \ReflectionException
     */
    protected function validate($function, $args)
    {
        parent::validate($function, $args); // TODO: Change the autogenerated stub

        switch ($function) {
            // case 'list':
            // case 'all':
            case 'get':
                $this->method = self::METHOD_GET;
                break;
            // case 'add':
            case 'post':
                $this->method = self::METHOD_POST;
                break;
            // case 'edit':
            case 'put':
                $this->method = self::METHOD_PUT;
                break;
            // case 'remove':
            case 'delete':
                $this->method = self::METHOD_DELETE;
                break;
            default:
                throw new \Exception('非RestfulApi方');
        }

        $this->function = $function;
    }

    /**
     * @param array $joinSign
     * @return string
     */
    protected function uri($joinSign = [])
    {
        global $config, $env;

        $api = $config['gameServer'][$env];
        $uri = $api['ssl'] ? 'https://' :  'http://';
        $uri .= $api['host'] . '/' . self::class . '/' . $this->function;

        if ($joinSign) {

        }

        return $uri;
    }

    protected function sigh()
    {

    }

    /**
     * @param $data
     * @return mixed|void
     * @throws \Exception
     */
    protected function execute($data)
    {
        switch ($this->method) {
            case self::METHOD_GET:

                break;
            case self::METHOD_POST:

                break;
            case self::METHOD_PUT:

                break;
            case self::METHOD_DELETE:

                break;
            default:
                throw new \Exception('非RestfulApi方');
        }

        print_r(123123123);
    }
}