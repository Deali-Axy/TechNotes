## 迭代器模式
1. 迭代器模式，在不需要了解内部实现的前提下，遍历一个聚合对象的内部元素。

2. 相比于传统的编程模式，迭代器模式可以隐藏遍历元素所需的操作。

```php
class AllUser implements \Iterator
{
    protected $ids;
    protected $data = array();
    protected $index;

    function __construct()
    {
        $db = Factory::getDatabase();
        $result = $db->query("select id from user");
        $this->ids = $result->fetch_all(MYSQLI_ASSOC);
    }

    function current()
    {
        $id = $this->ids[$this->index]['id'];
        return Factory::getUser($id);
    }

    function next()
    {
        $this->index ++;
    }

    function valid()
    {
        return $this->index < count($this->ids);
    }

    function rewind()
    {
        $this->index = 0;
    }

    function key()
    {
        return $this->index;
    }
}

//这样就可以直接使用这个类进行迭代

$users=new AllUser();
foreach($users as $user)
{
	echo $user->id;
}
```