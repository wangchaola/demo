<?php

class SingleLinkedListNode{

    public $data;//链表节点中的值
    public $next;//链表节点中的指向下一个节点（对象）

    public function __construct($data = null){
        $this->data = $data;
        $this->next = null;
    }
}

class SingleLinkedList{
    public $head;//头节点
    private $length;//链表长度

    //初始化
    public function __construct($head = null){
        if (null == $head) {
            $this->head = new SingleLinkedListNode();
        } else {
            $this->head = $head;
        }
        $this->length = 0;
    }

    /**
     * 获取链表长度
     */
    public function getLength(){
        return $this->length;
    }

    /**
     * 插入数据
     */
    public function insert($data){
        return $this->insertDataAfter($this->head, $data);
    }

    /**
     * 删除节点
     */
    public function delete($node){
        if (null == $node) {
            return false;
        }

        // 获取待删除节点的前置节点
        $preNode = $this->getPreNode($node);
        if (empty($preNode)) {
            return false;
        }
        //修改指向
        $preNode->next = $node->next;
        unset($node);
        $this->length--;
        return true;
    }

    /**
     * 通过索引获取节点
     */
    public function getNodeByIndex($index){
        if ($index >= $this->length) {
            return null;
        }

        $cur = $this->head->next;
        for ($i = 0; $i < $index; ++$i) {
            //遍历获取索引的指向节点
            $cur = $cur->next;
        }

        return $cur;
    }

    /**
     * 获取某个节点的前置节点
     */
    public function getPreNode($node){
        if (null == $node) {
            return false;
        }

        $curNode = $this->head;
        $preNode = $this->head;
        // 遍历找到前置节点 要用全等判断是否是同一个对象
        while ($curNode !== $node) {
            if ($curNode == null) {
                return null;
            }
            $preNode = $curNode;
            $curNode = $curNode->next;
        }

        return $preNode;
    }


 

    /**
     * 在某个节点后插入新的节点 (直接插入数据)
     */
    public function insertDataAfter($originNode, $data){
        // 如果originNode为空，插入失败
        if (null == $originNode) {
            return false;
        }

        // 新建单链表节点
        $newNode = new SingleLinkedListNode();
        // 新节点的数据
        $newNode->data = $data;

        // 新节点的下一个节点为源节点的下一个节点
        $newNode->next = $originNode->next;
        // 在originNode后插入newNode
        $originNode->next = $newNode;
        // 链表长度++
        $this->length++;
        return $newNode;
    }

    /**
     * 在某个节点前插入新的节点
     */
    public function insertDataBefore($originNode, $data){
        // 如果originNode为空，插入失败
        if (null == $originNode) {
            return false;
        }

        // 先找到originNode的前置节点，然后通过insertDataAfter插入
        $preNode = $this->getPreNode($originNode);

        return $this->insertDataAfter($preNode, $data);
    }

    /**
     * 在某个节点后插入新的节点
     */
    public function insertNodeAfter($originNode, $node){
        // 如果originNode为空，插入失败
        if (null == $originNode) {
            return false;
        }

        $node->next = $originNode->next;
        $originNode->next = $node;

        $this->length++;

        return $node;
    }

    /**
     * 打印
     */
    public function printList(){
        if (null == $this->head->next) {
            return false;
        }

        $curNode = $this->head;
        $listLength = $this->getLength();
        while ($curNode->next != null && $listLength--) {
            echo $curNode->next->data . ' -> ';

            $curNode = $curNode->next;
        }
        echo 'NULL' . PHP_EOL;

        return true;
    }


}

    $node0 = new SingleLinkedListNode(1);
    $node1 = new SingleLinkedListNode(2);
    $node2 = new SingleLinkedListNode(3);
    $list = new SingleLinkedList();
    $list->insertNodeAfter($list->head, $node0);
    $list->insertNodeAfter($node0, $node1);
    $list->insertNodeAfter($node1, $node2);
    $list->printList();


