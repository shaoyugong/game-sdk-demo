<?php
/**
 * Created by PhpStorm.
 * User: gongshaoyu
 * Date: 2019/7/9
 * Time: 上午11:15
 */

namespace Game\Sdk;

abstract class BaseService
{
    /**
     * @param $function
     * @param $args
     * @throws \Exception
     */
    public function __call($function, $args)
    {
        $this->validate($function, $args);
        $result = call_user_func_array([$this, $function], $args);
        $this->execute($result);
    }

    /**
     * @param $function
     * @param $args
     * @throws \Exception
     * @throws \ReflectionException
     */
    protected function validate($function, $args)
    {
        if (!method_exists($this, $function)) {
            throw new \Exception($function . ':不存在');
        }

        $reflection = new \ReflectionMethod($this, $function);
        if (!$reflection->isPublic()) {
            throw new \Exception("必须为public方法");
        }

        if ($reflection->isStatic()) {
            throw new \Exception("不能为static方法");
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    abstract protected function execute($data);
}