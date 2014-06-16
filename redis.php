$redis = new redis();
$result = $redis->connect('127.0.0.1', 6379);
var_dump($result); //结果：bool(true)


$redis = new redis();  
$redis->connect('127.0.0.1', 6379);  
$redis->set('test',"1111111111111");  
echo $redis->get('test');   //结果：1111111111111  
$redis->delete('test');  
var_dump($redis->get('test'));  //结果：bool(false)  
