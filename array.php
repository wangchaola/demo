<?php

/**
 * 模拟数组类
 */
class SimpleArray
{
    //数组的内容存储
    private $data;
    //数组容量模拟申请只作为和对比数组元素作用
    private $capacity;
    //数组长度记录
    private $length;

    /**
     * 构造
     * 申请需要构造数组的容量大小
     */
    public function __construct($capacity)
    {
        $capacity = $capacity;
        if($capacity <= 0) {
            return ['code' => -1,'msg' => "构造的数组大小必须大于0"];
        }
        $this->data = array();
        $this->capacity = $capacity;
        $this->length = 0;
    }

    /**
     * 判断数组是否已经等于所申请的大小（是否已经满了）
     */
    private function checkArray()
    {
        if($this->length == $this->capacity) {
            return true;
        }
        return false;
    }

    /**
     * 判断索引index是否超出数组范围
     */
    private function checkArrayOffset($index)
    {
        if($index >= $this->length) {
           return true;
        }
        return false;
    }

    /**
     * 在索引index位置插入值value
     */
    public function insert($index, $value)
    {
        $index = intval($index);
        $value = intval($value);
        if ($index < 0) {
            return ['code' => -1 ,'msg'=>'索引index必须大于等于0' ];
        }

        if ($this->checkArray()) {
            return ['code' => -1 ,'msg'=>'数组空间已满' ];;
        }

        //该需要插入index索引的后面所有数组重新重置
        for ($i = $this->length - 1; $i >= $index; $i--) {
            $this->data[$i + 1] = $this->data[$i];
        }

        $this->data[$index] = $value;
        $this->length++;
        return ['code' => 0 ,'msg'=>'插入成功' ];;
    }

    /**
     * 删除索引index上的值
     */
    public function delete($index)
    {
        $index = intval($index);
        if ($index < 0) {
            return ['code' => -1 ,'msg'=>'索引index必须大于等于0' ];
        }
        if ($this->checkArrayOffset($index)) {
            return ['code' => -1 ,'msg'=>'索引index已经越界' ];
        }

        for ($i = $index; $i < $this->length - 1; $i++) {
            $this->data[$i] = $this->data[$i + 1];
        }
        $this->length--;
        return ['code' => 1 ,'msg'=>'删除成功' ];
    }

    /**
     * 查找索引index的值
     */
    public function find($index)
    {
        $value = 0;
        $index = intval($index);
        if ($index < 0) {
            return ['code' => -1 ,'msg'=>'索引index必须大于等于0' ];
        }
        if ($this->checkOutOfRange($index)) {
            return ['code' => -1 ,'msg'=>'索引index已经越界' ];
        }
        return ['code' => 1 ,'value'=>$this->data[$index] ];
    }

    public function printData()
    {
        $format = "";
        for ($i = 0; $i < $this->length; $i++) {
            echo $i."=>" . $this->data[$i]."\n";
        }
    }
}

$a = new SimpleArray(5);
$a->insert(0,0);
$a->insert(1,1);
$a->insert(2,2);
$a->delete(1);
$a->printData();